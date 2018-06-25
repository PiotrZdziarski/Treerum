<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{asset('storage/images/logo.png')}}" >

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/bootstrap.min.js') }}" defer></script>
    <script src="{{ asset('js/myownscripts.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&amp;subset=latin-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=latin-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Courgette" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700,700i&amp;subset=latin-ext" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/default.css') }}" rel="stylesheet">
    <link href="{{ asset('css/myown.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" media="screen">
</head>
<body>
        <main class="py-4">
            @yield('content')
        </main>
        <footer style="border-bottom: 1px solid lightgray;">
            <div class="container">
                <div class="row" style="text-align:center;">
                        <ul class="socialicons">
                            <li><a target="_blank" href="https://www.facebook.com/profile.php?id=100007072909482"><i class="fa fa-facebook-square"></i></a></li>
                            <li><a target="_blank" href="https://plus.google.com/u/1/114869168099549108892"><i class="fa fa-google-plus"></i></a></li>
                            <li><a target="_blank" href="https://github.com/PiotrZdziarski"><i class="fa fa-github"></i></a></li>
                        </ul>
                </div>
            </div>
        </footer>

        <footer>
            <div class="container" style="height: 60px;">
                <div class="row" style="margin-left:auto;margin-right:auto;text-align:center;">
                    <div><a href="{{url('/')}}"><img src="{{asset('storage/images/logo.jpg')}}" alt="" style="margin-right: 10px;" /></a>Copyrights 2018, Piotr Zdziarski</div>
                </div>
            </div>
        </footer>


        @if(session('status'))
          <div class="alert alert-warning alert-dismissible col-lg-3 col-md-4 col-sm-8 col-lg-6 col-xs-10 alertmain" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" style="color:black;">&times;</span></button>
            {{session('status')}}
          </div>
          @php
            session()->forget('status');
          @endphp
        @endif


        <!--FOR POLL VOTE -->
        <div class="alert alert-warning alert-dismissible col-lg-3 col-md-4 col-sm-8 col-lg-6 col-xs-10 alertmain alertaftervote" role="alert" style="display:none;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" style="color:black;">&times;</span></button>
            Voted succesfully!
        </div>

        <!-- NEEDED FOR BACKERCHACKER -->
        <input id="backbuttonstate" type="text" value="0" style="display:none;" />

</body>
</html>
