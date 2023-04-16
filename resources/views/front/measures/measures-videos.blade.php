    <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ $htmlClasses ?? null }}">
<head>
    @include('front.layouts.partials.analytics')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    @yield('meta-description')

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') {{ config('app.name', 'Marina Racewear') }}</title>
    <link rel="icon" type="image/x-icon" href="/images/favicon.svg">

    @include('front.measures.partials.scriptsAndStylesMeasures')
</head>

<body class=" bg-black font-sans w-full">
<div id="app">
    <div class="wrapper" style=" height: 100vh;
  width: 100vw;
  position: relative;
  height: -webkit-fill-available;
  max-height: -webkit-fill-available">

        @include('front.measures.partials.header')

        {{--Enviem un formulari que crida el procediment saveMeasures--}}
        <form method="POST" action="{{route('measures-videos.save')}}" onkeydown="return event.key != 'Enter';">
        @csrf
        {{--Fitxer que conté la x-data: Inicialització de variables javascript mitjançant caché i funcions alpine--}}
        @include ('front.measures.partials.initialCacheData')

        @include('front.measures.partials.frontPage')

        @include('front.measures.partials.videosCostillar')

        @include('front.measures.partials.videosSinCostillar')

        @include('front.measures.partials.lastPage')

        {{--div tanca el div obert a initialCacheData, està OK--}}
    </div>
    </form>
</div>
<script src="{{ asset('dist/front/js/app.js') }}"></script>
@stack('extra_js')
</body>
</html>

@section('title', __('seo.measures-videos-title') . ' - ')

@section('meta-description')
    <meta name="description" content="{{ __('seo.measures-videos-description') }}"/>
@endsection

