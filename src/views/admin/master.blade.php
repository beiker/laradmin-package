<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="es" class="no-js"> <!--<![endif]-->
<head>
  <title>{{ $title }}</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="description" content="{{ $title }}">

  <!-- Styles -->
  @foreach(Laradmin::getStyles() as $style)
    {{ HTML::style($style) }}
  @endforeach
  <!--/Styles -->

 <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
    <script src="../../assets/js/html5shiv.js"></script>
    <script src="../../assets/js/respond.min.js"></script>
  <![endif]-->

  <script type="text/javascript" charset="UTF-8">
    var base_url = "{{ URL::to('/').'/' }}";
  </script>
</head>
<body>

  <header class="navbar navbar-inverse navbar-fixed-top" role="banner">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a href="{{ URL::to(Util::getUrlLang('admin/home')); }}" class="navbar-brand">{{ Config::get('laradmin::config.name') }}</a>
      </div> <!--/navbar-header -->
      <nav class="collapse navbar-collapse bs-navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-flag"></i> {{ Util::getActualLang() }}<b class="caret"></b></a>
              <ul class="dropdown-menu">
                @foreach (Config::get('laradmin::lang.valid_langs') as $lang)
                  <li><a href="{{ URL::to(Util::setUrlLang($lang)) }}">{{ $lang }}</a></li>
                @endforeach
              </ul>
            </li><!--/langs -->

            @if(Auth::check())
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{ Auth::user()->user }} <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <!-- <li><a href="#">Perfil</a></li>
                  <li class="divider"></li> -->
                  <li><a href="{{ URL::to(Util::getUrlLang('admin/logout')) }}">{{ trans(Conf::langPath().'messages.admin-user-options-sign-out') }}</a></li>
                </ul>
              </li>
            @endif
          </ul> <!--/ul.nav -->
      </nav> <!--/ navbar-collapse -->
    </div> <!--/container -->
  </header> <!--/navbar -->

  <div class="navbar">
  </div>

  <div id="content" class="container">
    <div class="row">
      <!--[if lt IE 7]>
        <div class="alert alert-info">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <p>Usted está usando un navegador desactualizado. <a href="http://browsehappy.com/">Actualice su navegador</a> o <a href="http://www.google.com/chromeframe/?redirect=true">instale Google Chrome Frame</a> para experimentar mejor este sitio.</p>
        </div>
      <![endif]-->

      @if (Auth::check())
        <div class="col-md-2">
          <div class="row">
            {{ $menu }}
          </div><!--/row -->
        </div><!--/col-md-3 -->
      @endif

      <div class="col-md-10">
        <div class="row">
          @yield('content')
        </div><!--/row-->
      </div><!--/col-md-9 -->

    </div> <!--/row-->
  </div><!--/container-->

  <div class="clear"></div>

  @foreach(Laradmin::getScripts() as $script)
    {{ HTML::script($script) }}
  @endforeach

  @include('laradmin::admin.common._noty')
  @include('laradmin::admin.common._alertbs')

</body>
</html>