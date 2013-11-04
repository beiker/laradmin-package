
    <div class="col-md-12">
      <div class="bs-sidebar hidden-print" role="complementary" data-spy="affix" data-offset-top="50" style="">
        <ul class="nav bs-sidenav menu-options" style="">
          <li>
            <a href="{{ URL::route('admin.dashboard') }}"><i class="fa fa-home"></i> {{ trans(Conf::langPath().'menu.menu-title') }}</a>
          </li>

          {{ $menu->make() }}

        </ul>
      </div> <!--/bs-sidebar -->
    </div><!--/col-md-12 -->

  <!-- <noscript>
    <div class="alert alert-block span10">
      <h4 class="alert-heading">Warning!</h4>
      <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
    </div>
  </noscript> -->