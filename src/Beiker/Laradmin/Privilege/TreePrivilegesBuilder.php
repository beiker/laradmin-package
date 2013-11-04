<?php namespace Beiker\Laradmin\Privilege;

use Beiker\Laradmin\Storage\Privilege\PrivilegeRepositoryInterface;

class TreePrivilegesBuilder {

  /**
   * Constructor.
   *
   * @return void
   */
  function __construct(PrivilegeRepositoryInterface $privilege)
  {
    $this->privilege = $privilege;
  }

  public function get($parentMenuId = 0, $first = true, $type = null, $showp = false)
  {
    $txt   = "";
    $bande = true;

    $parents = $this->privilege->byParent($parentMenuId);

    $txt .= $first? '<ul class="treeview">': '<ul>';

    foreach($parents as $parent)
    {
      $totalChilds = $parent->childs->count();

      if($type != null && ! is_array($type))
      {
        $set_nombre = 'privileges';
        $set_val = $type == $parent->id ? 'checked="checked"': '';

        $tipo_obj = 'radio';
      }
      else
      {
        $set_nombre = 'privileges[]';

        if(is_array($type))
        {
          $set_val = array_search($parent->id, $type) !== false ? 'checked="checked"': '';
        }
        else
        {
          $set_val = $parent->id == $type ? 'checked="checked"': '' ;
        }

        $tipo_obj = 'checkbox';

      }

      if($bande === true && $first === true && $showp === true)
      {
        $txt .= '<li><label style="font-size:11px;">
                  <input type="'.$tipo_obj.'" name="'.$set_nombre.'" value="0" '.$set_val.($parent->padre_id == 0 ? ' checked="checked"' : '').'> '.trans(\Conf::langPath().'messages.parent').'</label>
                </li>';

        $bande = false;
      }

      $name = $parent->use_lang ? trans(\Conf::langPath().$parent->lang) : $parent->name;

      if($totalChilds > 0)
      {
        $txt .= '<li><label style="font-size:11px;">
                  <input type="'.$tipo_obj.'" name="'.$set_nombre.'" value="'.$parent->id.'" '.$set_val.'> '.$name.'</label>
                  <ul>'.$this->get($parent->id, false, $type).'</ul>
                </li>';
      }
      else
      {
        $txt .= '<li><label style="font-size:11px;">
                  <input type="'.$tipo_obj.'" name="'.$set_nombre.'" value="'.$parent->id.'" '.$set_val.'> '.$name.'</label>
                </li>';
      }

    }
    $txt .= '</ul>';

    return $txt;
  }

}
