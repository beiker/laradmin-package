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
            {{ $linkGenerator->generate('privileges/create', array(
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
        <form action="{{ URL::route('privileges.index') }}" method="GET" class="form-inline" role="form">

          {{ Form::filtro(array(
            'withBtn'     => false,
            'name'        => 'filter',
            'placeholder' => trans(Conf::langPath().'messages.admin-privilege-index-search-placeholder'),
            'classGroup'  => 'col-xs-12 col-sm-5 col-md-5'
            ))
          }}

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
              <th>{{ trans(Conf::langPath().'messages.table-header-name') }}</th>
              <th>{{ trans(Conf::langPath().'messages.table-header-url-action') }}</th>
              <th>{{ trans(Conf::langPath().'messages.table-header-show-menu') }}</th>
              <th>{{ trans(Conf::langPath().'messages.table-header-lang') }}</th>
              <th>{{ trans(Conf::langPath().'messages.table-header-created-at') }}</th>
              <th>{{ trans(Conf::langPath().'messages.table-header-actions') }}</th>
            </tr>
          </thead>
          <tbody>
            @foreach($privileges as $priv)
              <tr>
                <td>{{ '<i class="icon-'.$priv->url_icon.'"></i> '.($priv->use_lang == 1 ? $priv->lang_name : $priv->name) }}</td>
                <td>{{ $priv->url_action }}</td>
                <td>{{ $priv->show_menu == 1 ? '<i class="fa fa-check fa-2x"></i>' : '<i class="fa fa-times fa-2x"></i>' }}</td>
                <td>{{ $priv->lang }}</td>
                <td>{{ $priv->created_at }}</td>
                <td class="center">

                  <div class="btn-group">
                    {{ $linkGenerator->generate('privileges/edit', array(
                      'btn_type'  => 'btn-primary',
                      'params'    => array($priv->id),
                      'attrs'     => array(),
                      'text_link' => 'hidden-tablet',
                      'show_text' => false,
                    )) }}

                    {{ $linkGenerator->generate('privileges/delete', array(
                      'btn_type'  => 'btn-primary',
                      'params'    => array($priv->id),
                      'attrs'     => array('onclick' => "msb.confirm('".trans(Conf::langPath().'messages.admin-privilege-index-modal-delete')."', '".trans(Conf::langPath().'messages.privileges')."', this); return false;"),
                      'text_link' => 'hidden-tablet',
                      'show_text' => false,
                    )) }}

                    @if( ! $priv->trashed())
                      {{ $linkGenerator->generate('privileges/softdelete', array(
                        'btn_type'  => 'btn-primary',
                        'params'    => array($priv->id),
                        'icon_type' => 'icon-white',
                        'attrs'     => array('onclick' => "msb.confirm('".trans(Conf::langPath().'messages.admin-privilege-index-modal-softdelete')."', '".trans(Conf::langPath().'messages.privileges')."', this); return false;"),
                        'text_link' => 'hidden-tablet',
                        'show_text' => false,
                      )) }}
                    @else
                      {{ $linkGenerator->generate('privileges/restore', array(
                        'btn_type'  => 'btn-primary',
                        'params'    => array($priv->id),
                        'icon_type' => 'icon-white',
                        'attrs'     => array('onclick' => "msb.confirm('".trans(Conf::langPath().'messages.admin-privilege-index-modal-restore')."', '".trans(Conf::langPath().'messages.privileges')."', this); return false;"),
                        'text_link' => 'hidden-tablet',
                        'show_text' => false,
                      )) }}
                    @endif
                  </div><!--/btn-group -->
                </td>
              </tr>
            @endforeach
          </tbody>
        </table><!--/table -->
      </div><!--/table-responsive -->

      <div class="text-center">
      {{ Pagination::make($privileges) }}
      </div><!--/center-block -->

    </div><!--/panel -->
  </div><!--/col-md-12 -->
@stop