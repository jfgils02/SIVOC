<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SIVOC</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body class="img-responsive" style="background-image: url({{asset('storage/img/background.jfif')}}); opacity: 0.6;">
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links" >
                    @auth
                        <a href="{{ url('/home') }}" style="color: white; font-size:15px;">Home</a>
                    @else
                    <a href="{{ route('login') }}" style="color: white; font-size:15px;"><button>Login</button></a>

                        @if (Route::has('register'))
                            <!--<a href="{{ route('register') }}">Register</a> -->
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content" style="margin-top: 150px;">
                <!-- <div class="title m-b-md">
                    <img src="{{asset('storage/img/SIVOC_logo.png')}}" class="img-fluid" alt="Responsive image">
                </div> -->

                <div class="links">
                    <a href="{{asset('storage/Documents/welcome/MISION.pdf')}}" target="_blank" style="color: white; font-size:12px;"><button> <b>Misión</b></button></a>
                    <a href="{{asset('storage/Documents/welcome/VISION.pdf')}}" target="_blank" style="color: white; font-size:12px;"><button><b>Visión</b></button></a>
                    <a href="{{asset('storage/Documents/welcome/POLITICA DE CALIDAD.pdf')}}" target="_blank" style="color: white; font-size:12px;"><button><b>Politica de Calidad</b></button></a>
                    <a href="{{asset('storage/Documents/welcome/MAPA DE PROCESOS.pdf')}}" target="_blank" style="color: white; font-size:12px;"><button><b>Mapa de procesos</b></button></a>
                    <a href="{{asset('storage/Documents/welcome/POLITICAS SIVOC.pdf')}}" target="_blank" style="color: white; font-size:12px;"><button><b>Políticas SIVOC</b></button></a>
                    <a href="{{asset('storage/Documents/welcome/INFORMATE DEL COVID-19.pdf')}}" target="_blank" style="color: white; font-size:12px;"><button><b>COVID 19</b></button></a>
                    <a href="{{asset('storage/Documents/welcome/BRIGADA DE EMERGENCIA.pdf')}}" target="_blank" style="color: white; font-size:12px;"><button><b>Brigadad de Emergencia</b></button></a>
                    <a href="{{asset('storage/Documents/welcome/PROXIMOS EVENTOS.pdf')}}" target="_blank" style="color: white; font-size:12px;"><button><b>Próximos eventos</b></button></a>
                </div>
            </div>
        </div>
    </body>
</html>
