<?php

/*
 | -------------------------------------------------------------------------
 | Muestra input para realizar filtro.
 | -------------------------------------------------------------------------
 */
Form::macro('filtro', function($config = array())
{
  $config = array_merge(array(
    'withBtn'  => true,
    'name'        => 'filtro',
    'class'       => 'input-large',
    'icon'        => 'search',
    'value'       => '',
    'placeholder' => '',
    'attrs'       => '',
    'classGroup' => ''
  ), (array)$config);

  if (Input::has($config['name']))
    $config['value'] = Input::get($config['name']);

  return
    '<div class="input-group '.$config['classGroup'].'">
      <span class="input-group-addon"><i class="fa fa-'.$config['icon'].'"></i></span>
      <input type="text" name="'.$config['name'].'" class="form-control '.$config['class'].'" id="'.$config['name'].'"
        value="'.$config['value'].'" placeholder="'.$config['placeholder'].'" '.$config['attrs'].'> ' .
      ($config['withBtn'] ? '<span class="input-group-btn"><button class="btn btn-default">'.trans(Conf::langPath().'messages.search').'</button></span>' : '') .
    '</div>';
});

/*
 | -------------------------------------------------------------------------
 | Muestra inputs para realizar filtro por fechas.
 | -------------------------------------------------------------------------
 */
Form::macro('dates', function($config=array())
{
  $config = array_merge(array(
    'withBtn'  => true,
  ), (array)$config);

  return
  '<div class="input-prepend">
    <span class="add-on"><i class="icon-calendar"></i></span>
    <input type="text" name="fechaini" class="input-medium" id="fechaini"
      value="" placeholder="">
  </div>

  <div class="input-prepend">
    <span class="add-on"><i class="icon-calendar"></i></span>
    <input type="text" name="fechaend" class="input-medium" id="fechaend"
      value="" placeholder="">
  </div>' .
  ($config['withBtn'] ? '<button class="btn">Buscar</button>' : '');
});

/*
 | -------------------------------------------------------------------------
 | Muestra un select.
 | -------------------------------------------------------------------------
 */
Form::macro('myselect', function($config=array())
{
  $config = array_merge(array(
    'text'    => 'Status',
    'name'    => 'status',
    'id'      => 'status',
    'withBtn' => true,
    'options' => array(
      array('t' => 'TODOS', 'a' => 'ACTIVOS', 'i' => 'INACTIVOS'),
      't'
    ),
  ), (array)$config);

  $options = '';

  if (Input::has($config['name'])) $getSelected = Input::get($config['name']);

  foreach ($config['options'][0] as $value => $text)
  {
    $selected = (isset($getSelected))
      ?
        ($getSelected === $value) ? ' selected' : ''
      :
        $config['options'][1] === $value ? ' selected' : ''
      ;

    $options .= '<option value="'.$value.'"'.$selected.'>'.$text.'</option>';
  }

  return
  '<div class="input-prepend input-append">
    <span class="add-on"><i class="icon_type-search"></i> '.$config['text'].'</span>
    <select name="'.$config['name'].'" id="'.$config['id'].'">
    '.$options.'
    </select>' .
    ($config['withBtn'] ? '<button class="btn">Buscar</button>' : '').'</div>';
});