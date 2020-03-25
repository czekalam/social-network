<style>
    .container {
        padding-top:40px;
    }
    .mc-weather {
        padding: 20px;
        width: 100%;
    }
    .mc-weather__wrapper {
        display: flex;
        justify-content: center;
    }
    .mc-weather__wrapper,.mc-weather__wrapper ul {
        list-style: none;
    }
    .mc-position-top {
        background: #fff;
        width:100%;
    }
    body header {
        position: relative;
    }
</style>
<div class="mc-position-top">
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('dashboard')}}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('friends')}}">Friends</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href={{route('users')}}>Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn" href={{route('account')}}>Account</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn" href={{route('scissors')}}>Scissors game</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn" href={{route('bird')}}>Bird game</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn" href={{route('logout')}}>Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <div id="mc-weather" class="mc-weather">
        <ul class="mc-weather__wrapper"></ul>
        <script>
            function day(day) {
                switch(day){
                    case 0: return "Sunday"; break;
                    case 1: return "Monday"; break;
                    case 2: return "Thursday"; break;
                    case 3: return "Wednesday"; break;
                    case 4: return "Thursday"; break;
                    case 5: return "Friday"; break;
                    case 6: return "Saturday"; break;
                }
            }
            function cloud(result) {
                if (result < 33) {
                    return '<i class="fas fa-sun"></i>';
                }
                else if (result< 66) {
                    return '<i class="fas fa-cloud-sun"></i>';
                }
                else if (result <= 100) {
                    return '<i class="fas fa-cloud"></i>';
                }
                else {
                    return '';
                }
            }
            function wind(wind) {
                if (wind === 0) {
                    return 'N';
                }
                else if (wind < 90) {
                    return 'NE'
                }
                else if (wind === 90) {
                    return 'E';
                }
                else if (wind < 180) {
                    return 'SE';
                }
                else if (wind === 180) {
                    return 'S';
                }
                else if (wind < 270) {
                    return 'SW';
                }
                else if (wind === 270) {
                    return 'W';
                }
                else if (wind < 360) {
                    return 'NW'
                }
            }
            $( document ).ready(function() {
                jQuery.ajax({
                    url: "http://api.openweathermap.org/data/2.5/forecast?q=gdansk&appid=10eef0d5859a79e048209ecd86701ac1",
                    context: document.body
                }).done(function(data,status,xhr) {
                    data.list.forEach(function(item) {
                        
                        if(item.dt_txt.substr(11)=="15:00:00"){
                            $(".mc-weather__wrapper")
                                .append($("<li>")
                                    .append($("<ul>")
                                        .append($("<li>").append(day(new Date(item.dt_txt).getDay())))
                                        .append($("<li>").append(cloud(item.clouds.all)))
                                        .append($("<li>").append(item.weather[0].description))
                                        .append($("<li>").append("Temperature "+Math.round(item.main.temp - 273.15)+"°C"))
                                        .append($("<li>").append("Wind "+item.wind.speed+" m/s"))
                                        .append($("<li>").append("Wind direction "+wind(item.wind.deg)))
                                    )
                                );
                        }
                    });
                });
            });
        </script>
    </div>
</div>