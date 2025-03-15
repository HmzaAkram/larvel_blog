<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- Basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <title>@yield('title', 'Default Title')</title>

      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">

      <!-- Stylesheets -->
      <link rel="stylesheet" type="text/css" href="/front/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="/front/css/style.css">
      <link rel="stylesheet" href="css/responsive.css">
      <link rel="icon" href="/front/images/fevicon.png" type="image/gif" />
      <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <link rel="stylesheet" href="css/owl.carousel.min.css">
      <link rel="stylesheet" href="css/owl.theme.default.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
   </head>
   <body>

      <!-- Header Section -->
      @include('front.partials.header')

      <!-- Main Content -->
      <div class="content">
         @yield('content')
      </div>

      <!-- Footer Section -->
      @include('front.partials.footer')

      <!-- Javascript Files -->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="js/jquery-3.0.0.min.js"></script>
      <script src="js/plugin.js"></script>
      <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="js/custom.js"></script>
      <script src="js/owl.carousel.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>

   </body>
</html>
