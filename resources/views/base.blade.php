<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <title>@yield('title', config('app.name', 'Laravel'))</title>

  @yield('include-more', '')
  <link href="{{ asset('css/requires.css') }}" rel="stylesheet">
  <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
  <script src="{{ asset('js/requires.js') }}" defer></script>
  <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body class="@yield('classname', '')">
  @yield('top-header', View::make('includes.top-header'))
  @yield('header', View::make('includes.header'))
  @yield('content', 'Hello')
  @yield('footer', View::make('includes.footer'))
  {{-- @yield('chat', View::make('includes.chat')) --}}
</body>
</html>