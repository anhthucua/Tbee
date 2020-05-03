<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <title>@yield('title', 'Trang cá nhân')</title>

  @yield('include-more', '')
  <link href="{{ asset('css/requires.css') }}" rel="stylesheet">
  <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
  <script src="{{ asset('js/requires.js') }}" defer></script>
  <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body class="page-user @yield('classname', '')">
  @yield('top-header', View::make('user.top-header'))
  <div class="d-flex">
    @yield('sidebar', View::make('user.sidebar'))
    <div class="col-md-9">
      @yield('content', 'Hello')
    </div>
  </div>
  @yield('footer', View::make('includes.footer'))
</body>
</html>