<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>@yield('title') &mdash; Coffee Shop</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('backend/dist/assets/modules/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/dist/assets/modules/fontawesome/css/all.min.css') }}">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('backend/dist/assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/dist/assets/css/components.css') }}">
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        @yield('content')
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="{{ asset('backend/dist/assets/modules/jquery.min.js') }}"></script>
  <script src="{{ asset('backend/dist/assets/modules/popper.js') }}"></script>
  <script src="{{ asset('backend/dist/assets/modules/tooltip.js') }}"></script>
  <script src="{{ asset('backend/dist/assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('backend/dist/assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
  <script src="{{ asset('backend/dist/assets/modules/moment.min.js') }}"></script>
  <script src="{{ asset('backend/dist/assets/js/stisla.js') }}"></script>
  <script src="{{ asset('backend/dist/assets/js/scripts.js') }}"></script>
  <script src="{{ asset('backend/dist/assets/js/custom.js') }}"></script>
</body>
</html>