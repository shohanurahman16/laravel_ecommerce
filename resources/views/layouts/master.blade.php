<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        @yield('title','Laravel Ecommerce') | Laravel Ecommerce
    </title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>

<div class="wrapper">
    {{--Navigation Starts here--}}
    @include('partials.nav')
    {{--Navigation ends here--}}


    {{--Sidebar+Content--}}
        @yield('sidebar-content')
    {{--Sidebar+Content Ends--}}

<div class="mt-2">
    @yield('content')
</div>

    {{--footer Starts here--}}
    @include('partials.footer')
    {{--footer ends here--}}


</div>

{{--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>--}}
{{--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>--}}


<script src="{{asset('js/jquery-3.3.1.slim.min.js')}}"  crossorigin="anonymous"></script>
<script src="{{asset('js/popper.min.js')}}"  crossorigin="anonymous"></script>
<script src="{{asset('js/bootstrap.min.js')}}" crossorigin="anonymous"></script>
    @yield('scripts')
</body>
</html>