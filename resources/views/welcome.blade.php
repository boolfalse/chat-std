<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
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
                font-size: 12px;
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
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                    {{--<button onclick="send();">Send</button>--}}
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Documentation</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>

        <script src="{{ asset('js/autobahn.min.js') }}"></script>
        {{--https://raw.githubusercontent.com/crossbario/autobahn-js/master/lib/autobahn.js--}}
        <script>
            var conn = new ab.connect("ws://localhost:8080",
            function (session) {
                session.subscribe('onNewData', function (topic, data) {
                    console.info("New Data. topic_id: " + topic);
                    console.log(data.data);
                })
            },
            function (code, reason, detail) {
                console.warn("webSocket connection closed. Code=" + code + "; Reason=" + reason + "; Detail=" + detail);
            },
                {
                    'maxRetries': 60,
                    'retryDelay': 86400*1000,
                    'skipSubprotocolCheck': true
                });
        </script>

        {{--<script>--}}
            {{--var conn = new WebSocket("ws://localhost:8080");--}}
            {{--conn.onopen = function (event) {--}}
                {{--console.log("Connection Established!!!");--}}
            {{--};--}}
            {{--conn.onmessage = function (p1) {--}}
                {{--console.log("Received data: " + p1.data);--}}
            {{--};--}}
            {{--function send() {--}}
                {{--var data = "Data for send " + Math.random();--}}
                {{--conn.send(data);--}}
                {{--console.log("Has been sent data: " + data);--}}
            {{--}--}}
        {{--</script>--}}

    </body>
</html>
