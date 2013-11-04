<?php namespace Beiker\Laradmin\Privilege;

use Beiker\Laradmin\Storage\User\UserRepositoryInterface;

class MenuConstructor {

  /**
   * Construct.
   *
   * @param Beiker\Laradmin\Storage\User\UserRepositoryInterface $user
   */
  function __construct(UserRepositoryInterface $user)
  {
    $this->user = $user;
  }

  /**
   * builds the menu from the admin panel based on the privileges of
   * the user logged.
   *
   * @param  integer $submenuId
   * @param  boolean $first
   * @return string
   */
  public function make($submenuId = 0, $first = true)
  {
    $menu = '';

    $parents = $this->user->userPrivParents(\Session::get('id'), $submenuId);

    foreach($parents as $parent)
    {
      $totalChilds = $parent->childs()->where('show_menu', 1)->get()->count();

      $link_tar = ($parent->target_blank === 1) ? ' target="_blank"': '';

      if ($totalChilds > 0)
      {
        $name = $parent->use_lang == 1 ? trans(\Conf::langPath().$parent->lang) : $parent->name;

        $menu .= '
          <li data-parent="true">
            <a href="'.\URL::to(\Util::getUrlLang('admin/'.$parent->url_action)).'" '.$link_tar.'><i class="fa fa-'.$parent->url_icon.'"></i> '.$name.'</a>
              <ul class="nav">';
                  $menu .= $this->make($parent->id, false).'
              </ul>
          </li>';
      }
      else
      {
        $name = $parent->use_lang == 1 ? trans(\Conf::langPath().$parent->lang) : $parent->name;

        $menu .= '
          <li>
            <a href="'.\URL::to(\Util::getUrlLang('admin/'.$parent->url_action)).'"><i class="fa fa-'.$parent->url_icon.'"></i> '.$name.'</a>
          </li>';
      }
    }

    return $menu;
  }
}
