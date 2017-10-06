<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->

    <link href="https://fonts.googleapis.com/css?family=Lato|Open+Sans" rel="stylesheet">   
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.13/semantic.min.css">    
    <link rel="stylesheet" type="text/css" href="{{ mix('css/app.css') }}">

</head>
<body>
    <div>
        @include("_header2")
        <div class="wrap-sidebar">
            <div class="ui sidebar vertical left inverted menu">
                <a href="#" class="item">Monday</a>
                <a href="#" class="item">Wednesdey</a>
                <a href="#" class="item">Monday</a>
                <a href="#" class="item">Thursday</a>
                <a href="#" class="item">Friday</a>
                <a href="#" class="item">Saturday</a>
                <a href="#" class="item">Sunday</a>
            </div>
            <div class="ui basic icon menu">
                <a class="item" id="toggle">
                    <i class="sidebar icon"></i>
                    Menu
                </a>
            </div>
        </div>
        @yield('content')
    </div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.13/semantic.js"></script>
    <script type="text/javascript" src="{{ mix('js/app.js') }}"></script>

    <script type="text/javascript">
        $('#toggle').click(function(){
            $('.ui.sidebar').sidebar('toggle');
        });         
    </script>

    @stack('javascript')
</body>
</html>
