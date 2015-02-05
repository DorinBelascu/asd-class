<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ASD Class</title>

    <!-- Bootstrap -->
    {{HTML::style('css/bootstrap.min.css')}}
    {{HTML::style('css/jasny-bootstrap.min.css')}}
    {{HTML::style('css/asdclass.css')}}

    @yield('css')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container">

      @include('includes.nav.~navigation')

      <!-- Main component for a primary marketing message or call to action -->

      @yield('content')

    </div> <!-- /container -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    {{HTML::script('js/jquery.min.js')}}
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    {{HTML::script('js/bootstrap.min.js')}}
    {{HTML::script('js/jasny-bootstrap.min.js')}}
    @yield('js')
  </body>
</html>