<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title text-center" id="notification" style="margin-top: 100px; margin-left:200px">
                    Laravelx
                </div>
            </div>
        </div>
    </body>
    <script src="{{ asset('js/app.js') }}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script> --}}
    <script>
        window.laravel_echo_port = '{{env("LARAVEL_ECHO_PORT")}}';
    </script>
    <script src="//{{ Request::getHost() }}:{{env("LARAVEL_ECHO_PORT")}}/socket.io/socket.io.js"></script>
    <script src="{{ url('js/laravel-echo-setup.js') }}" type="text/javascript"></script>

    {{-- <script type="text/javascript">
        // window.Echo.channel('users')
        var i = 0;
        window.Echo.channel('userslist').listen('UserListUpdated', (data) => {
            console.log(data);
           i++;
        //  $("notification").append('<div class = "alert alert-success">'+i+'.'+data.data+'</div');

            var div = document.createElement('div');
            div.className = 'alert alert-success';
            div.innerHTML = i + '. ' + data.users[i].name;
            document.getElementById('notification').appendChild(div);
        });
    </script> --}}

    <script type="text/javascript">
        window.Echo.channel('userslist').listen('UserListUpdated', (data) => {
            console.log(data);
            var users = data.users;
            var html = '';
            for (var i = 0; i < users.length; i++) {
                var user = users[i];
                html += (i + 1) + '. <b>Name:</b> '  + user.name + '  <b>Email:</b>' + user.email + '<br>';
            }
            document.getElementById('notification').innerHTML = html;
        });
    </script>

</html>
