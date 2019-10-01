<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WeatherDaily;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $weathers_daily = WeatherDaily::orderBy('datetime', 'desc')->where('city_id', 1581130)->limit(7)->get();
        return view('client.index', compact("weathers_daily"));
    }
}
