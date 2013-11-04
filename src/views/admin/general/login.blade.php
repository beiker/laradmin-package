@extends('laradmin::admin.master')

@section('content')
  <div class="jumbotron col-md-6 col-md-offset-4">
    <div class="center-block" style="text-align: center;">
      <h2>{{ trans(Conf::langPath().'messages.admin-auth-title') }}</h2>
    </div>

    {{ Util::alert(array('errors'=>$errors)) }}

    <form class="form-horizontal" action="{{ URL::route('admin.create.login') }}" method="POST" role="form">

      {{ Form::token() }}

      <div class="form-group">
        <div class="col-sm-12 col-md-12">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-user"></i></span>
            <input type="text" name="user" class="form-control input-lg" id="inputEmail3" placeholder="{{ trans(Conf::langPath().'messages.admin-auth-text-user') }}" autofocus>
          </div>
        </div>
      </div><!--/form-group -->

      <div class="form-group">
        <div class="col-sm-12 col-md-12">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-key"></i></span>
            <input type="password" name="password" class="form-control input-lg" id="password" placeholder="******">
            <span class="input-group-addon">
              <label><input type="checkbox" class="uniform" id="showPassword">Show</label>
            </span>
          </div>
        </div>
      </div><!--/form-group -->

      <div class="form-group">
        <div class="col-xs-6 col-sm-6 col-md-6">
          <button type="submit" class="btn btn-primary btn-lg btn-block">{{ trans(Conf::langPath().'messages.admin-auth-title') }}</button>
        </div><!--/col -->
        <div class="col-xs-6 col-sm-6 col-sm-6">
          <span class="input-group-addon" style="border: none;">
            <label><input type="checkbox" name="remember" class="uniform"/>{{ trans(Conf::langPath().'messages.admin-auth-remember') }}</label>
          </span>
        </div>
      </div><!--/form-group -->

      <div class="form-group">

      </div><!--/form-group -->
    </form>

  </div><!--/span-->
@stop