@extends('laradmin::admin.master')

@section('content')
  <div id="content" class="col-md-12">
    @include('laradmin::admin.common._breadcrumb')

    @include(Config::get('laradmin::config.dashboard'))

  </div>
@stop