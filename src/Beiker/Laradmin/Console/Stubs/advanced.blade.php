@extends('laradmin::admin.master')

@section('content')
  <div id="content" class="col-md-12">
    @include('laradmin::admin.common._breadcrumb')

    <!-- Unicamente es necesario usar el metodo showAlert cuando se quiera mostrar una alerta de bootstrap -->
    {{ Laradmin::showAlert(array('errors' => $errors, 'type' => 'alert-info')) }}

    <div class="panel panel-default">
      <!-- Default panel contents -->
      <div class="panel-heading">
        <div class="pull-left"><i class="fa fa-user"></i> {{ $title }}</div>
        <div class="pull-right">
          <div class="btn-group" style="margin-top: -8px;">
            {{ $linkGenerator->generate('users/create', array(
                'btn_type'  => 'btn-primary btn-sm',
                'attrs'     => array('style'=>''),
                'text_link' => 'hidden-tablet',
                'show_text' => false,
              )) }}
            {{ $linkGenerator->generate('users', array(
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
      </div><!--/panel-body -->

      <div class="table-responsive">
        <table class="table table-astriped table-hover table-condensed">
          <thead>
            <tr>
                <th>{{ trans('laradmin/messages.table-header-name'); }}</th>
                <th>{{ trans('laradmin/messages.table-header-user'); }}</th>
                <th>{{ trans('laradmin/messages.table-header-email'); }}</th>
                <th>{{ trans('laradmin/messages.table-header-type'); }}</th>
                <th>{{ trans('laradmin/messages.table-header-status'); }}</th>
                <th>{{ trans('laradmin/messages.table-header-created-at'); }}</th>
                <th>{{ trans('laradmin/messages.table-header-actions'); }}</th>
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
                      $msgModal = trans('laradmin/messages.admin-user-index-modal-softdelete');
                    ?>
                    <span class="label label-success">On</span>
                  @else
                    <?php
                      $action = 'users/restore';
                      $msgModal = trans('laradmin/messages.admin-user-index-modal-restore');
                      ?>
                    <span class="label label-warning">Off</span>
                  @endif
                </td>
                <td>{{ $user->created_at }}</td>
                <td class="center">

                  <div class="btn-group">
                    {{ $linkGenerator->generate('examples/message1', array(
                      'btn_type'  => 'btn-primary',
                      'params'    => array($user->id),
                      'attrs'     => array('onclick' => "msb.confirm('Estas seguro de ver el mensaje tipo 1?', 'Mensaje', this); return false;"),
                      'show_text' => true,
                      'tooltip'   => false
                    )) }}

                    {{ $linkGenerator->generate('examples/message2', array(
                      'btn_type'  => 'btn-default',
                      'params'    => array($user->id),
                      'attrs'     => array('onclick' => "msb.confirm('Estas seguro de ver el mensaje tipo 2?', 'Mensaje', this); return false;"),
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
          <!-- http://getbootstrap.com/components/#pagination -->
          {{ Laradmin::renderPag($users, 'pagination-lg') }}
      </div><!--/center-block -->

    </div><!--/panel -->
  </div><!--/col-md-12 -->
@stop