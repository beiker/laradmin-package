<?php namespace Beiker\Laradmin\Privilege;

use Beiker\Laradmin\Storage\Privilege\PrivilegeRepositoryInterface;
use Beiker\Laradmin\User\UserHasPrivilege;

class LinkPrivilegeGenerator {

  /**
   * Construct.
   *
   * @param Beiker\Laradmin\Storage\Privilege\PrivilegeRepositoryInterface $privilege
   * @param Beiker\Laradmin\User\UserHasPrivilege $userHasPrivilege
   */
  function __construct(PrivilegeRepositoryInterface $privilege,
                       UserHasPrivilege $userHasPrivilege)
  {
    $this->privilege        = $privilege;
    $this->userHasPrivilege = $userHasPrivilege;
  }

  /**
   * Link Generator for privileges
   *
   * @param  string  $urlOrId
   * @param  array   $config
   * @param  boolean $onlyLink
   * @return string
   */
  public function generate($urlOrId, $config = array(), $onlyLink = false)
  {
    $html = '';

    $this->userHasPrivilege->setUrlOrId($urlOrId);
    $this->userHasPrivilege->setReturnInfo(true);
    $this->userHasPrivilege->setUserId(\Session::get('id'));
    $priv = $this->userHasPrivilege->has();

    if(is_object($priv))
    {
      $conf = array(
        'params'    => '',
        'btn_type'  => '',
        'icon_type' => 'icon-white',
        'attrs'     => array(),
        'text_link' => 'hidden-tablet',
        'show_text' => true,
        'tooltip'   => true,
      );

      $conf = array_merge($conf, $config);

      $attrs = '';
      foreach ($conf['attrs'] as $key => $value)
      {
        $attrs .= $key.'="'.$value.'" ';
      }

      $name = $priv->use_lang == 1 ? trans(\Conf::langPath().$priv->lang) : $priv->name;

      $html = ($onlyLink)
        ?
          \URL::to(\Util::getUrlLang('admin/'.$priv->url_action))
        :
          '<a class="btn '.$conf['btn_type'].'" href="'.\URL::to(\Util::getUrlLang('admin/'.$priv->url_action), $conf['params']).'" '.$attrs.' title="'.$name.'" '.($conf['tooltip'] ? 'rel="tooltip" data-toggle="tooltip"' : '').'">
          <i class="fa fa-'.$priv->url_icon.' '.$conf['icon_type'].'"></i> <span class="'.$conf['text_link'].'">'.($conf['show_text'] ? $name : '').'</span></a>';
    }

    return $html;
  }

}
