<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime;
use DatePeriod;
use DateInterval;
use App\City;
use DB;
use GuzzleHttp\Client;
use App\WeatherDaily;

class CrawlController extends BaseController
{
    

    public function crawl(Request $request)
    {
        $type = $request->type;
        switch($type) {
            case "daily":
                $this->crawlDaily($request);
                break;
            case "hourly":
                $this->crawlHourly($request);
                break;
            default:
                $this->badRequest("Does not support type");
        }
        $this->success("Success: " + $request->type);
    }

    public function crawlDaily(Request $request)
    {
        // Default cities ID
        // HN, HCM, ĐN, Nghệ An, Lào Cai
        $defaultCitiesID = [1581130, 1566083, 1905468, 1559969, 1562412];

        $datetime = Carbon::now()->toDateTimeString();

        $tenDaysAgo = Carbon::now()->subDays(10);
        $now = Carbon::now();
        // dd($tenDaysAgo);

        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($tenDaysAgo, $interval, $now);

        foreach($defaultCitiesID as $key => $city_id) {
            // dd($period->end);
            foreach ($period as $index => $dt) {
                $date_time_start = $dt->toDateTimeString();
                $date_time_e = $dt->modify('+1 day');
                $date_time_end = $date_time_e->toDateTimeString();

                if($index == 9) {
                    $date_time_end = $period->end->format('Y-m-d H:i:s');
                }

                $date_start = explode(" ", $date_time_start)[0];
                $date_end = explode(" ", $date_time_end)[0];

                // var_dump($date_start);
                // var_dump($date_end);
                
                $query_params = [
                    'city_id' => $city_id,
                    'start_date' => $date_start,
                    'end_date' => $date_end,
                    'key' => config("app.weatherbit_api_key")
                ];

                $this->fetchWeatherAPI($query_params, 'daily');
            }
        }
        return $this->success('success');
    }

    private function crawlHourly(Request $request)
    {
    }

    public function crawlCity() {
        try {
            ini_set('memory_limit', '-1');
            
            $path = public_path() . "/city.list.json/city.list.json";
            
            $json = json_decode(file_get_contents($path), true); 
           
            // Delete old cities
            DB::delete('delete from cities');

            $insert_data = [];

            foreach($json as $c) {

                $data = [
                    'city_id' => $c['id'],
                    'name' => $c['name'],
                    'country' => $c['country'],
                    'coord' => json_encode($c['coord'])
                ];
            
                $insert_data[] = $data;

                // $city = City::create([
                //     'city_id' => $c['id'],
                //     'name' => $c['name'],
                //     'country' => $c['country'],
                //     'coord' => json_encode($c['coord'])
                // ]);
            }

            $insert_data = collect($insert_data); // Make a collection to use the chunk method

            // it will chunk the dataset in smaller collections containing 500 values each. 
            // Play with the value to get best result
            $chunks = $insert_data->chunk(500);

            foreach ($chunks as $chunk)
            {
                DB::table('cities')->insert($chunk->toArray());
            }

            return $this->success('success');
        } catch(Exception $e) {
            return $this->internalServer($e);
        }
    }

    private function fetchWeatherAPI($query_params, $type) {
        // dd(config('app.weatherbit_domain'));
        $url = config('app.weatherbit_domain') . "/v2.0/history/" . $type;
        // Make HTTP Request
        $client = new Client();
        // $client->getClient()->setDefaultOption('verify', false);

        $res = $client->request("GET", $url, [
            'query' => $query_params,
            'verify' => false,
        ]);

        if ($res->getStatusCode() == 200) { // 200 OK
            $response_data = $res->getBody()->getContents();
            $data_json = json_decode($response_data);
            // dd($data_json->city_id);
            $weather_daily = WeatherDaily::where("city_id", $data_json->city_id)->where("datetime", $data_json->data[0]->datetime)->first();
            if($weather_daily) {
                return;
            }
            $weather_daily = new WeatherDaily();
            $weather_daily->city_id = $data_json->city_id;
            $weather_daily->rh = $data_json->data[0]->rh;
            $weather_daily->max_wind_spd = $data_json->data[0]->max_wind_spd;
            $weather_daily->wind_gust_spd = $data_json->data[0]->wind_gust_spd;
            $weather_daily->clouds = $data_json->data[0]->clouds;
            $weather_daily->precip_gpm = $data_json->data[0]->precip_gpm;
            $weather_daily->wind_spd = $data_json->data[0]->wind_spd;
            $weather_daily->slp = $data_json->data[0]->slp;
            $weather_daily->temp = $data_json->data[0]->temp;
            $weather_daily->pres = $data_json->data[0]->pres;
            $weather_daily->dewpt = $data_json->data[0]->dewpt;
            $weather_daily->precip = $data_json->data[0]->precip;
            $weather_daily->wind_dir = $data_json->data[0]->wind_dir;
            $weather_daily->max_temp = $data_json->data[0]->max_temp;
            $weather_daily->min_temp = $data_json->data[0]->min_temp;
            $weather_daily->max_wind_dir = $data_json->data[0]->max_wind_dir;
            $weather_daily->snow = $data_json->data[0]->snow;
            $weather_daily->datetime = $data_json->data[0]->datetime;
            $weather_daily->save();
        }
    }
}
