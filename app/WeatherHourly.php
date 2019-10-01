<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WeatherHourly extends Model
{
    protected $table = 'weather_hourly';

    protected $fillable = [
        'city_id', 'weather_daily_id'
    ];
}
