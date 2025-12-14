<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>@yield('title') &mdash; Coffee Shop</title>
  <link rel="icon" type="image/png" href="{{ asset('backend/dist/assets/img/stisla-fill.png') }}">

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('backend/dist/assets/modules/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/dist/assets/modules/fontawesome/css/all.min.css') }}">

  <!-- CSS Libraries -->
  @stack('css-libraries')

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('backend/dist/assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/dist/assets/css/components.css') }}">
  
  <!-- Custom CSS -->
  @stack('styles')
</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      
      <!-- Navbar -->
      @include('partials.navbar')

      <!-- Sidebar -->
      @include('partials.sidebar')

      <!-- Main Content -->
      <div class="main-content">
        @include('components.alert')
        @yield('content')
      </div>

      <!-- Footer -->
      @include('partials.footer')
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="{{ asset('backend/dist/assets/modules/jquery.min.js') }}"></script>
  <script src="{{ asset('backend/dist/assets/modules/popper.js') }}"></script>
  <script src="{{ asset('backend/dist/assets/modules/tooltip.js') }}"></script>
  <script src="{{ asset('backend/dist/assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('backend/dist/assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
  <script src="{{ asset('backend/dist/assets/modules/moment.min.js') }}"></script>
  <script src="{{ asset('backend/dist/assets/js/stisla.js') }}"></script>
  
  <!-- JS Libraries -->
  @stack('js-libraries')
  
  <!-- Template JS File -->
  <script src="{{ asset('backend/dist/assets/js/scripts.js') }}"></script>
  <script src="{{ asset('backend/dist/assets/js/custom.js') }}"></script>

  <!-- Custom Scripts -->
  @stack('scripts')
</body>
</html>