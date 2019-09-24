<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeatherDailyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weather_daily', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("city_id");
            // $table->foreign('city_id')->references('id')->on('cities');
            $table->integer("rh");
            $table->double("max_wind_spd");
            $table->double("wind_gust_spd");
            $table->integer("clouds");
            $table->integer("precip_gpm");
            $table->double("wind_spd");
            $table->double("slp");
            $table->double("temp");
            $table->double("pres");
            $table->double("dewpt");
            $table->integer("precip");
            $table->integer("wind_dir");
            $table->integer("max_temp");
            $table->integer("min_temp");
            $table->integer("max_wind_dir");
            $table->integer("snow");
            $table->date("datetime");
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
        Schema::dropIfExists('weather_daily');
    }
}
