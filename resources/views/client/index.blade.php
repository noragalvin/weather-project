@extends('client.app')

@section('content')

<div class="hero" data-bg-image="https://previews.123rf.com/images/_ig0rzh_/_ig0rzh_1501/_ig0rzh_150100029/35596644-weather-forecast-concept-background-variety-weather-conditions-bright-sun-and-blue-sky-dark-stormy-s.jpg">
    <div class="container">
        <form action="/" class="find-location" id="header-search" autocomplete="off">
            <input autocomplete="off" type="text" class="search-input" name="search" placeholder="Find your location...">
            <!-- <input type="submit" value="Find"> -->
            <div id="result">
            </div>
        </form>
    </div>
</div>
<div class="forecast-table">
    <div class="container main-daily">
        <div class="forecast-container">
            @foreach($weathers_daily as $key => $daily)

            <!-- TODO: print current  -->
            @if($key == 0)

            <div class="today forecast">
                <div class="forecast-header">
                    <div class="day">{{ getWeekday($daily->datetime) }}</div>
                    <div class="date">{{ $daily->datetime }}</div>
                </div> <!-- .forecast-header -->
                <div class="forecast-content">
                    <div class="isToday">
                        <div class="location">Ha Noi</div>
                        <div class="degree">
                            <div class="num">{{ $daily->temp }}<sup>o</sup>C</div>
                            <div class="forecast-icon">
                                <img src="{{ asset('client/images/icons/icon-1.svg') }}" alt="" width=90>
                            </div>
                        </div>
                        <span><img src="images/icon-umberella.png" alt="">{{ $daily->rh }}%</span>
                        <span><img src="images/icon-wind.png" alt="">{{ $daily->wind_dir }}km/h</span>
                        <!-- <span><img src="images/icon-compass.png" alt="">East</span> -->
                    </div>
                    <div class="notToday">
                        <div class="forecast-icon">
                            <img src="{{ asset('client/images/icons/icon-3.svg') }}" alt="" width=48>
                        </div>
                        <div class="degree">{{ $daily->temp }}<sup>o</sup>C</div>
                    </div>
                </div>
                <div class="hourly">
                    @foreach($daily->hourly as $keyHourly => $hourly)
                        <div class="hourly-item"  data-toggle="modal" data-target="#hourly{{$hourly->id}}">
                            <div class="hourly-title">
                                <p>{{ $hourly->hour }}</p>
                            </div>
                            <div class="hourly-content">
                                <h2>{{ $hourly->temp }}<sup>o</sup>C</h2>
                            </div>
                            <div class="hourly-footer d-flex justify-content-center align-items-center flex-column">
                                <img src="https://www.weatherbit.io/static/img/icons/{{ $hourly->weather_json->icon }}.png" /></img>
                                <button class="btn btn-secondary mt-2">Xem</button>
                            </div>
                        </div>

                        <!-- The Modal -->
                        <div class="modal" id="hourly{{$hourly->id}}" style="color: #000">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Giờ: {{ $hourly->hour }}</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">

                                    <img src="https://www.weatherbit.io/static/img/icons/{{ $hourly->weather_json->icon }}.png" /></img>
                                    <p>Độ ẩm tương đối: {{ $hourly->rh }}%</p>
                                    <p>Tốc độ gió: {{ $hourly->wind_spd }}m/s</p>
                                    <p>Áp suất: {{ $hourly->press }}</p>
                                    <p>Tầm nhìn xa: {{ $hourly->vis}}km</p>
                                    <p>Mực nước biển: {{ $hourly->slp }}mb</p>
                                    <p>Thời điểm: {{ $hourly->pod == "d"  ? 'Ngày' : 'Đêm' }}</p>
                                    <p>Điểm sương: {{ $hourly->dewpt }} C</p>
                                    <p>Hướng gió: {{ $hourly->wind_dir }} độ</p>
                                    <p>Nhiệt độ: {{ $hourly->temp }} C</p>
                                    <p>Lượng mây: {{ $hourly->clouds }} %</p>
                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>

                                </div>
                            </div>
                        </div>

                    @endforeach
                </div>
            </div>

            @else
            <div class="forecast">
                <div class="forecast-header">
                    <div class="day">{{ getWeekday($daily->datetime) }}</div>
                    <div class="date">{{ $daily->datetime }}</div>
                </div> <!-- .forecast-header -->
                <div class="forecast-content">
                    <div class="isToday">
                        <div class="location">Ha Noi</div>
                        <div class="degree">
                            <div class="num">{{ $daily->temp }}<sup>o</sup>C</div>
                            <div class="forecast-icon">
                                <img src="{{ asset('client/images/icons/icon-1.svg') }}" alt="" width=90>
                            </div>
                        </div>
                        <span><img src="images/icon-umberella.png" alt="">{{ $daily->rh }}%</span>
                        <span><img src="images/icon-wind.png" alt="">{{ $daily->wind_dir }}km/h</span>
                        <!-- <span><img src="images/icon-compass.png" alt="">East</span> -->
                    </div>
                    <div class="notToday">
                        <div class="forecast-icon">
                            <img src="{{ asset('client/images/icons/icon-3.svg') }}" alt="" width=48>
                        </div>
                        <div class="degree">{{ $daily->temp }}<sup>o</sup>C</div>
                    </div>
                </div>
                <div class="hourly">
                    @foreach($daily->hourly as $hourly)
                        <div class="hourly-item"  data-toggle="modal" data-target="#hourly{{$hourly->id}}">
                            <div class="hourly-title">
                                <p>{{ $hourly->hour }}</p>
                            </div>
                            <div class="hourly-content">
                                <h2>{{ $hourly->temp }}<sup>o</sup>C</h2>
                            </div>
                            <div class="hourly-footer">
                                <img src="https://www.weatherbit.io/static/img/icons/{{ $hourly->weather_json->icon }}.png" /></img>
                            </div>
                        </div>

                        <!-- The Modal -->
                        <div class="modal" id="hourly{{$hourly->id}}" style="color: #000">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Giờ: {{ $hourly->hour }}</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">

                                    <img src="https://www.weatherbit.io/static/img/icons/{{ $hourly->weather_json->icon }}.png" /></img>
                                    <p>Độ ẩm tương đối: {{ $hourly->rh }}%</p>
                                    <p>Tốc độ gió: {{ $hourly->wind_spd }}m/s</p>
                                    <p>Áp suất: {{ $hourly->press }}</p>
                                    <p>Tầm nhìn xa: {{ $hourly->vis}}km</p>
                                    <p>Mực nước biển: {{ $hourly->slp }}mb</p>
                                    <p>Thời điểm: {{ $hourly->pod == "d"  ? 'Ngày' : 'Đêm' }}</p>
                                    <p>Điểm sương: {{ $hourly->dewpt }} C</p>
                                    <p>Hướng gió: {{ $hourly->wind_dir }} độ</p>
                                    <p>Nhiệt độ: {{ $hourly->temp }} C</p>
                                    <p>Lượng mây: {{ $hourly->clouds }} %</p>
                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif



            @endforeach
        </div>

    </div>
</div>
<div>
    <h1>Thông tin thời tiết vùng miền ngày {{ date('d-m') }}</h1>
</div>
{!! $khituongthuyvan !!}
@endsection

@push("scripts")
<script type="text/javascript">
   $('#header-search').on('keyup', function() {
       var search = $(this).find('.search-input').val();
       if (search == '') {
        $("#result").hide()
       } else {
           axios.get('/search', {
               params: {
                search: search
               }
           })
           .then(res => {
               let html = "";
               res.data.result.forEach(e => {
                html += `<p>${e.name}</p>`;
               });
               console.log(html);
               $("#result").show();
               $("#result").html(html);

           }).catch(err => {
               console.log({err: err})
           });
       };
   });

   $(".forecast").click(function(e) {
       e.preventDefault();
       $('.forecast').removeClass('today');
    $(this).addClass("today");
   })
</script>
@endpush
