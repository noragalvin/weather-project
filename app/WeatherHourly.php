<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class WeatherHourly extends Model
{
    protected $table = 'weather_hourly';

    protected $fillable = [
        'city_id', 'weather_daily_id'
    ];

    public function getWeatherJsonAttribute() {
        return json_decode($this->weather);
    }

    public function getHourAttribute() {
        return Carbon::parse($this->datetime)->format('H:i');
    }
}
