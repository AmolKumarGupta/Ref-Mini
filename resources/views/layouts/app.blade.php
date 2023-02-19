<!DOCTYPE html>

@if (\Request::is('rtl'))
  <html dir="rtl" lang="ar">
@else
  <html lang="en" >
@endif

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="keywords" content="cms, refmini, laravel" />
  <meta name="description" content="A personal cms" />
  <meta name="twitter:card" content="website" />
  <meta name="twitter:site" content="" />
  <meta name="twitter:title" content="{{ env('APP_NAME') }}" />
  <meta name="twitter:description" content="A personal CMS" />
  <meta name="twitter:image" content="" />
  <meta property="og:title" content="{{ env('APP_NAME') }}" />
  <meta property="og:type" content="article" />
  <meta property="og:url" content="{{ asset('/') }}" />
  <meta property="og:image" content="" />
  <meta property="og:description" content="A personal CMS" />

  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('public/assets/img/logo.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('public/assets/img/logo.png') }}">
  <title>{{ env('APP_NAME') }}</title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('public/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('public/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{ asset('public/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('public/assets/css/soft-ui-dashboard.css?v=1.0.3') }}" rel="stylesheet" />
  <link href="{{ asset('public/css/app.css') }}" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-gray-100 {{ (\Request::is('rtl') ? 'rtl' : (Request::is('virtual-reality') ? 'virtual-reality' : '')) }} ">
  @auth
    @yield('auth')
  @endauth
  @guest
    @yield('guest')
  @endguest

  @if(session()->has('success'))
    <div x-data="{ show: true}"
        x-init="setTimeout(() => show = false, 4000)"
        x-show="show"
        class="position-fixed bg-success rounded right-3 text-sm py-2 px-4">
      <p class="m-0">{{ session('success')}}</p>
    </div>
  @endif
    <!--   Core JS Files   -->
  <script src="{{ asset('public/assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('public/assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('public/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('public/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('public/assets/js/plugins/fullcalendar.min.js') }}"></script>
  <script src="{{ asset('public/assets/js/plugins/chartjs.min.js') }}"></script>
  @stack('rtl')
  @stack('dashboard')
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>

  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('public/assets/js/soft-ui-dashboard.min.js?v=1.0.3') }}"></script>
</body>

</html>
