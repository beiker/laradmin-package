@extends('laradmin::admin.master')

@section('content')
  <div id="content" class="col-md-12">
    @include('laradmin::admin.common._breadcrumb')

    <div class="panel panel-default">
      <!-- Default panel contents -->
      <div class="panel-heading">
        <div class="pull-left"><i class="fa fa-lock"></i> {{ $title }}</div>
        <div class="pull-right">
          <div class="btn-group" style="margin-top: -8px;">
            {{ $linkGenerator->generate('users/create', array(
                'btn_type'  => 'btn-primary btn-sm',
                'attrs'     => array('style'=>''),
                'text_link' => 'hidden-tablet',
                'show_text' => false,
              )) }}
          </div><!--/btn-group -->
        </div><!--/pull-right -->
        <div class="clear">&nbsp</div>
      </div><!--/panel-heading -->
      <div class="panel-body">
        <form action="{{ URL::route('users.index') }}" method="GET" class="form-inline" role="form">

          {{ Form::filtro(array(
            'withBtn'     => false,
            'name'        => 'filter',
            'placeholder' => trans(Conf::langPath().'messages.admin-user-index-search-placeholder'),
            'classGroup'  => 'col-xs-12 col-sm-5 col-md-5'
           )) }}

          <div class="col-xs-12 col-sm-5 col-md-5">
            <select name="status" class="form-control">
              <option value="t" {{ (Input::get('status') === 't' || Input::get('status') === '' || ! Input::has('status') ? 'selected' : '' ) }}>{{ trans(Conf::langPath().'messages.filter-all') }}</option>
              <option value="d" {{ (Input::get('status') === 'd' ? 'selected' : '' ) }}>{{ trans(Conf::langPath().'messages.filter-disabled') }}</option>
              <option value="e" {{ (Input::get('status') === 'e' ? 'selected' : '' ) }}>{{ trans(Conf::langPath().'messages.filter-enabled') }}</option>
            </select>
          </div>

          <div class="col-xs-12 col-sm-2 col-md-2">
            <button type="submit" class="btn btn-default">{{ trans(Conf::langPath().'messages.search') }}</button>
          </div>
        </form>
      </div><!--/panel-body -->

      <div class="table-responsive">
        <table class="table table-astriped table-hover table-condensed">
          <thead>
            <tr>
              <th>{{ trans(Conf::langPath().'messages.table-header-name'); }}</th>
              <th>{{ trans(Conf::langPath().'messages.table-header-user'); }}</th>
              <th>{{ trans(Conf::langPath().'messages.table-header-email'); }}</th>
              <th>{{ trans(Conf::langPath().'messages.table-header-type'); }}</th>
              <th>{{ trans(Conf::langPath().'messages.table-header-status'); }}</th>
              <th>{{ trans(Conf::langPath().'messages.table-header-created-at'); }}</th>
              <th>{{ trans(Conf::langPath().'messages.table-header-actions'); }}</th>
            </tr>
          </thead>
          <tbody>
            @foreach($users as $user)
              <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->user }}</td>
                <td>{{ $user->email }}</td>
                <td><span class="label label-info">{{ $user->type }}</span></td>
                <td>
                  @if ( ! $user->trashed())
                    <?php
                      $action = 'users/softdelete';
                      $msgModal = trans(Conf::langPath().'messages.admin-user-index-modal-softdelete');
                    ?>
                    <span class="label label-success">On</span>
                  @else
                    <?php
                      $action = 'users/restore';
                      $msgModal = trans(Conf::langPath().'messages.admin-user-index-modal-restore');
                      ?>
                    <span class="label label-warning">Off</span>
                  @endif
                </td>
                <td>{{ $user->created_at }}</td>
                <td class="center">

                  <div class="btn-group">
                    {{ $linkGenerator->generate('users/edit', array(
                      'btn_type'  => 'btn-primary',
                      'params'    => array($user->id),
                      'icon_type' => 'icon-white',
                      'attrs'     => array(),
                      'text_link' => 'hidden-tablet',
                      'show_text' => false,
                    )) }}

                    {{ $linkGenerator->generate('users/delete', array(
                      'btn_type'  => 'btn-primary',
                      'params'    => array($user->id),
                      'icon_type' => 'icon-white',
                      'attrs'     => array('onclick' => "msb.confirm('".trans(Conf::langPath().'messages.admin-user-index-modal-delete')."', '".trans(Conf::langPath().'messages.users')."', this); return false;"),
                      'text_link' => 'hidden-tablet',
                      'show_text' => false,
                    )) }}

                    {{ $linkGenerator->generate($action, array(
                      'btn_type'  => 'btn-primary',
                      'params'    => array($user->id),
                      'icon_type' => 'icon-white',
                      'attrs'     => array('onclick' => "msb.confirm('".$msgModal."', '".trans(Conf::langPath().'messages.users')."', this); return false;"),
                      'text_link' => 'hidden-tablet',
                      'show_text' => false,
                    )) }}
                  </div><!--/btn-group -->
                </td>
              </tr>
            @endforeach
          </tbody>
        </table><!--/table -->
      </div><!--/table-responsive -->

      <div class="text-center">
      {{ Pagination::make($users) }}
      </div><!--/center-block -->

    </div><!--/panel -->
  </div><!--/col-md-12 -->
@stop