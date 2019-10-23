@extends('client.app')

@section('content')

<div class="hero" data-bg-image="{{ asset('client/images/banner.png') }}">
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
<main class="main-content">
    <div class="fullwidth-block">
        <div class="container">
            <h2 class="section-title">Live cameras</h2>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="live-camera">
                        <figure class="live-camera-cover"><img src="images/live-camera-1.jpg" alt=""></figure>
                        <h3 class="location">New York</h3>
                        <small class="date">8 oct, 8:00AM</small>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="live-camera">
                        <figure class="live-camera-cover"><img src="images/live-camera-2.jpg" alt=""></figure>
                        <h3 class="location">Los Angeles</h3>
                        <small class="date">8 oct, 8:00AM</small>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="live-camera">
                        <figure class="live-camera-cover"><img src="images/live-camera-3.jpg" alt=""></figure>
                        <h3 class="location">Chicago</h3>
                        <small class="date">8 oct, 8:00AM</small>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="live-camera">
                        <figure class="live-camera-cover"><img src="images/live-camera-4.jpg" alt=""></figure>
                        <h3 class="location">London</h3>
                        <small class="date">8 oct, 8:00AM</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="fullwidth-block" data-bg-color="#262936">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="news">
                        <div class="date">06.10</div>
                        <h3><a href="#">Doloremque laudantium totam sequi </a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo saepe assumenda dolorem modi, expedita voluptatum ducimus necessitatibus. Asperiores quod reprehenderit necessitatibus harum, mollitia, odit et consequatur maxime nisi amet doloremque.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="news">
                        <div class="date">06.10</div>
                        <h3><a href="#">Doloremque laudantium totam sequi </a></h3>
                        <p>Nobis architecto consequatur ab, ea, eum autem aperiam accusantium placeat vitae facere explicabo temporibus minus distinctio cum optio quis, dignissimos eius aspernatur fuga. Praesentium totam, corrupti beatae amet expedita veritatis.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="news">
                        <div class="date">06.10</div>
                        <h3><a href="#">Doloremque laudantium totam sequi </a></h3>
                        <p>Enim impedit officiis placeat qui recusandae doloremque possimus, iusto blanditiis, quam optio delectus maiores. Possimus rerum, velit cum natus eos. Cumque pariatur beatae asperiores, esse libero quas ad dolorem. Voluptates.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main> <!-- .main-content -->

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
