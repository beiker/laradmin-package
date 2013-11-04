@extends('laradmin::admin.master')

@section('content')
  <div id="content" class="col-md-12">
    @include('laradmin::admin.common._breadcrumb')

    <div class="panel panel-default">
      <!-- Default panel contents -->
      <div class="panel-heading">
        <div class="pull-left"><i class="fa fa-lock"></i> {{ $title }}</div>
        <div class="pull-right">
          <div class="btn-group" style="margin-top: -7px;">
            {{ $linkGenerator->generate('privileges', array(
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

      <form action="{{ URL::route('privileges.store') }}" method="POST" class="form-horizontal" role="form">
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
              <label for="url_action" class="col-sm-2 control-label">{{ trans(Conf::langPath().'messages.admin-privilege-create-url-action') }}</label>
              <div class="col-sm-10">
                <input type="text" name="url_action" value="{{ Input::old('url_action') }}" class="form-control" id="url_action" placeholder="">
                <span class="help-block">{{ trans(Conf::langPath().'messages.required') }}</span>
              </div>
            </div><!--/form-group -->

            <div class="form-group">
              <label for="url_icon" class="col-sm-2 control-label">{{ trans(Conf::langPath().'messages.admin-privilege-create-icon') }}</label>
              <div class="col-sm-10">
                <input type="text" name="url_icon" value="{{ Input::old('url_icon') }}" class="form-control" id="url_icon" placeholder="">
                <span class="help-block"><a href="http://fortawesome.github.io/Font-Awesome/icons/" class="link" target="_BLANK">{{ trans(Conf::langPath().'messages.admin-privilege-create-show-icons') }}</a></span>
              </div>
            </div><!--/form-group -->

            <div class="form-group">
              <label for="show_menu" class="col-sm-2 control-label">{{ trans(Conf::langPath().'messages.admin-privilege-create-show-in-menu') }}</label>
              <div class="col-sm-10">
                <input type="checkbox" name="show_menu" class="uniform" id="show_menu" value="1" {{ Input::old('show_menu') ? 'checked' : ''}}>
              </div>
            </div><!--/form-group -->

            <div class="form-group">
              <label for="target_blank" class="col-sm-2 control-label">Target Blank</label>
              <div class="col-sm-10">
                <input type="checkbox" name="target_blank" class="uniform" id="target_blank" value="1" {{ Input::old('target_blank') ? 'checked' : ''}}>
              </div>
            </div><!--/form-group -->

            <div class="form-group">
              <label for="lang" class="col-sm-2 control-label">{{ trans(Conf::langPath().'messages.admin-privilege-create-lang') }}</label>
              <div class="col-sm-10">
                <input type="text" name="lang" value="{{ Input::old('lang') }}" class="form-control" id="lang" placeholder="">
              </div>
            </div><!--/form-group -->

            <div class="form-group">
              <label for="use_lang" class="col-sm-2 control-label">{{ trans(Conf::langPath().'messages.admin-privilege-create-use-lang') }}</label>
              <div class="col-sm-10">
                <input type="checkbox" name="use_lang" class="uniform" id="use_lang" value="1" {{ Input::old('use_lang') ? 'checked' : ''}}>
              </div>
            </div><!--/form-group -->
          </div><!--/col-sm-6 -->

          <div class="col-sm-6">
            <div class="form-group">
              <label class="col-sm-1 control-label">{{ trans(Conf::langPath().'messages.admin-privilege-create-other-actions') }}</label>
              <div class="col-sm-10 col-sm-offset-1 text-center">
                <div class="btn-group btn-group-sm" data-toggle="buttons-checkbox">
                  <button type="button" class="btn btn-primary" id="btnCreate" data-check="checkCreate">{{ trans(Conf::langPath().'messages.add') }}</button>
                  <button type="button" class="btn btn-primary" id="btnStore" data-check="checkStore">{{ trans(Conf::langPath().'messages.save') }}</button>
                  <button type="button" class="btn btn-primary" id="btnShow" data-check="checkShow">{{ trans(Conf::langPath().'messages.show') }}</button>
                  <button type="button" class="btn btn-primary" id="btnEdit" data-check="checkEdit">{{ trans(Conf::langPath().'messages.edit') }}</button>
                  <button type="button" class="btn btn-primary" id="btnUpdate" data-check="checkUpdate">{{ trans(Conf::langPath().'messages.update') }}</button>
                </div><br><br>
                <div class="btn-group btn-group-sm" data-toggle="buttons-checkbox">
                  <button type="button" class="btn btn-primary" id="btnDelete" data-check="checkDelete">{{ trans(Conf::langPath().'messages.delete') }}</button>
                  <button type="button" class="btn btn-primary" id="btnSoftdelete" data-check="checkSoftdelete">{{ trans(Conf::langPath().'messages.deactivate') }}</button>
                  <button type="button" class="btn btn-primary" id="btnRestore" data-check="checkRestore">{{ trans(Conf::langPath().'messages.activate') }}</button>
                </div>
                  <input type="checkbox" name="extra_actions[]" value="create" id="checkCreate" style="display: none;">
                  <input type="checkbox" name="extra_actions[]" value="store" id="checkStore" style="display: none;">
                  <input type="checkbox" name="extra_actions[]" value="show" id="checkShow" style="display: none;">
                  <input type="checkbox" name="extra_actions[]" value="edit" id="checkEdit" style="display: none;">
                  <input type="checkbox" name="extra_actions[]" value="update" id="checkUpdate" style="display: none;">
                  <input type="checkbox" name="extra_actions[]" value="delete" id="checkDelete" style="display: none;">
                  <input type="checkbox" name="extra_actions[]" value="softdelete" id="checkSoftdelete" style="display: none;">
                  <input type="checkbox" name="extra_actions[]" value="restore" id="checkRestore" style="display: none;">
              </div><!--/col-sm-10 -->
            </div><!--/form-group -->

            <div class="form-group">
              <label for="lang" class="col-sm-1 control-label">{{ trans(Conf::langPath().'messages.privileges') }}</label>
              <div class="col-sm-9 col-sm-offset-1">
                <div style="max-height: 300px; overflow-y: auto; border:1px #ddd solid;">
                  {{ $treePrivileges->get(0, true, 'radio', true) }}
                </div>
              </div>
            </div><!--/form-group -->

          </div><!--/col-sm-6 -->
        </div><!--/row -->

        <div class="form-group">
          <div class="col-xs-12 col-sm-offset-5 col-sm-3">
            <button type="submit" class="btn btn-default">{{ trans(Conf::langPath().'messages.save') }}</button>
            <a href="{{ URL::route('privileges.index') }}" class="btn btn-warning">{{ trans(Conf::langPath().'messages.cancel') }}</a>
          </div>
        </div><!--/form-group -->
      </form>
    </div><!--/panel -->
  </div><!--/col-md-12 -->
@stop