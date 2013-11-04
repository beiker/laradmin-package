@extends('laradmin::admin.master')

@section('content')
  <div id="content" class="col-md-12">
    @include('laradmin::admin.common._breadcrumb')

    <div class="panel panel-default">
      <!-- Default panel contents -->
      <div class="panel-heading">
        <div class="pull-left"><i class="fa fa-user"></i> Some Icon and Title</div>
        <div class="pull-right">
          <div class="btn-group btn-group-xs">
            <button type="button" class="btn btn-default ">button 1</button>
            <button type="button" class="btn btn-default ">button 2</button>
            <button type="button" class="btn btn-default ">button 3</button>
          </div><!--/btn-group -->
        </div><!--/pull-right -->
        <div class="clear">&nbsp</div>
      </div><!--/panel-heading -->
      <div class="panel-body">
        Panel Body  <a href="http://getbootstrap.com/components/#panels" target="_blank">BOOTSTRAP 3 PANEL DOCS</a>
      </div><!--/panel-body -->

      <div class="well text-center">
        <h1>Your Content HERE (table, form etc)</h1>
      </div>

    </div><!--/panel -->
  </div><!--/col-md-12 -->
@stop