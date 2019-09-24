<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeatherHourlyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weather_hourly', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("city_id");
            // $table->foreign('city_id')->references('id')->on('cities');
            $table->unsignedBigInteger("weather_daily_id");
            $table->foreign('weather_daily_id')->references('id')->on('weather_daily');
            $table->integer("rh");
            $table->double("wind_spd");
            $table->double("vis");
            $table->double("slp");
            $table->string("pod");
            $table->double("pres");
            $table->double("dewpt");
            $table->integer("snow");
            $table->integer("wind_dir");
            $table->string("weather");
            $table->double("app_temp");
            $table->double("temp");
            $table->integer("precip");
            $table->integer("clouds");
            $table->datetime("datetime");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weather_hourly');
    }
}
