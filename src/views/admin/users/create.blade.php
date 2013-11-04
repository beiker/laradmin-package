@extends('laradmin::admin.master')

@section('content')
  <div id="content" class="col-md-12">
    @include('laradmin::admin.common._breadcrumb')

    <div class="panel panel-default">
      <!-- Default panel contents -->
      <div class="panel-heading">
        <div class="pull-left"><i class="fa fa-user"></i> {{ $title }}</div>
        <div class="pull-right">
          <div class="btn-group" style="margin-top: -7px;">
            {{ $linkGenerator->generate('users', array(
                'btn_type'  => 'btn-primary btn-sm',
                'attrs'     => array(),
                'text_link' => 'hidden-tablet',
                'show_text' => false,
              )) }}
          </div><!--/btn-group -->
        </div><!--/pull-right -->
        <div class="clear">&nbsp</div>
      </div><!--/panel-heading -->
      <div class="panel-body">
      </div><!--/panel-body -->

      <form action="{{ URL::route('users.store') }}" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data">
        {{ Form::token() }}
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="name" class="col-sm-2 control-label">{{ trans(Conf::langPath().'messages.name') }}</label>
              <div class="col-sm-10">
                <input type="text" name="name" value="{{ Input::old('name') }}" class="form-control" id="name" placeholder="">
                <span class="help-block">{{ trans(Conf::langPath().'messages.required') }}</span>
              </div>
            </div><!--/form-group -->

            <div class="form-group">
              <label for="user" class="col-sm-2 control-label">{{ trans(Conf::langPath().'messages.user') }}</label>
              <div class="col-sm-10">
                <input type="text" name="user" value="{{ Input::old('user') }}" class="form-control" id="user" placeholder="">
                <span class="help-block">{{ trans(Conf::langPath().'messages.required') }}</span>
              </div>
            </div><!--/form-group -->

            <div class="form-group">
              <label for="password" class="col-sm-2 control-label">{{ trans(Conf::langPath().'messages.password') }}</label>
              <div class="col-sm-10">
                <input type="password" name="password" value="{{ Input::old('password') }}" class="form-control" id="password" placeholder="******">
                <span class="help-block">{{ trans(Conf::langPath().'messages.required'); }}, min:6</span>
              </div>
            </div><!--/form-group -->

            <div class="form-group">
              <label for="email" class="col-sm-2 control-label">{{ trans(Conf::langPath().'messages.email') }}</label>
              <div class="col-sm-10">
                <input type="email" name="email" value="{{ Input::old('email') }}" class="form-control" id="email" placeholder="email@gmail.com">
              </div>
            </div><!--/form-group -->

            <div class="form-group">
              <label for="type" class="col-sm-2 control-label">{{ trans(Conf::langPath().'messages.type') }}</label>
              <div class="col-sm-10">
                <div class="btn-group" data-toggle="buttons">
                  <label class="btn btn-info">
                    <input type="radio" name="type" value="admin"> {{ trans(Conf::langPath().'messages.admin'); }}
                  </label>
                  <label class="btn btn-info">
                    <input type="radio" name="type" value="user"> {{ trans(Conf::langPath().'messages.user'); }}
                  </label>
                </div>
              </div>
            </div><!--/form-group -->
          </div><!--/col-sm-6 -->

          <div class="col-sm-6">
            <div class="form-group">
              <label for="avatar" class="col-sm-2 control-label">{{ trans(Conf::langPath().'messages.image').' / '.trans(Conf::langPath().'messages.avatar'); }}</label>
              <div class="col-sm-10">
                {{ Form::file('avatar') }}
              </div>
            </div><!--/form-group -->

            <div class="form-group">
              <label for="lang" class="col-sm-1 control-label">{{ trans(Conf::langPath().'messages.privileges') }}</label>
              <div class="col-sm-9 col-sm-offset-1">
                <div style="max-height: 250px; overflow-y: auto; border:1px #ddd solid;">
                  {{ $treePrivileges->get(0, true, false, false) }}
                </div>
              </div>
            </div><!--/form-group -->

          </div><!--/col-sm-6 -->
        </div><!--/row -->

        <div class="form-group">
          <div class="col-xs-12 col-sm-offset-5 col-sm-3">
            <button type="submit" class="btn btn-default">{{ trans(Conf::langPath().'messages.save') }}</button>
            <a href="{{ URL::route('users.index') }}" class="btn btn-warning">{{ trans(Conf::langPath().'messages.cancel') }}</a>
          </div>
        </div><!--/form-group -->
      </form>
    </div><!--/panel -->
  </div><!--/col-md-12 -->
@stop