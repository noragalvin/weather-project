<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WeatherDaily;
use App\City;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $weathers_daily = WeatherDaily::orderBy('datetime', 'desc')->where('city_id', 1581130)->limit(7)->get();

        return view('client.index', compact("weathers_daily"));
    }

    public function search(Request $request) {
        if($request->search) {
            $data = City::where('name', 'like', '%'. $request->search . '%')->get();
            // foreach ($data as $key => $value) {
            //     echo $value->name;
            //     echo '<br>';
            // }
            return response()->json([
                "result" => $data
            ]);
        }
    }
}
