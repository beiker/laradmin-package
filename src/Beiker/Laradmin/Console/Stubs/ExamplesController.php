<?php

// La clase Beiker\Laradmin\Privilege\LinkPrivilegeGenerator es la encargada
// de generar el link de un privilegio(url), si un usuario no tiene el
// privilegio de esa url entonces no lo genera.
use Beiker\Laradmin\Privilege\LinkPrivilegeGenerator;

class ExamplesController extends BaseController {

  /**
   * Constructor.
   *
   * @param LinkPrivilegeGenerator $linkGenerator [description]
   */
  public function __construct(LinkPrivilegeGenerator $linkGenerator)
  {
    $this->linkGenerator = $linkGenerator;
  }

  /**
   * admin/ o admin/index
   *
   * @return void
   */
  public function getIndex()
  {
    return View::make('admin.examples.basic')
      ->with('title', 'Basic Example');
  }

  /**
   * admin/advanced
   *
   * Este ejemplo muestra un listado de los usuarios.
   *
   * @return void
   */
  public function getAdvanced()
  {
    // De esta manera podrias incluir tus js.
    $myScripts = array(
      Laradmin::jsDir().'admin/msgbox.js',
    );

    // De esta manera podrias incluir tus css.
    $myStyles = array(
      'public/path/to/you/css.css'
    );

    // Titulo que aparecera en el box-header y tag <title>
    $title = 'Advanced Example';

    // Obtenemos los usuarios.
    $query = User::orderBy('name');

    // Laradmin::paginate es un metodo para paginar que laradmin trae incluido.
    $users = Laradmin::paginate($query, 1)['items'];

    // $this->linkGenerator es la clase encargada de generar los links
    // de los privilegios.
    $linkGenerator = $this->linkGenerator;

    // Con el metodo styles() o scripts() de Laradmin puedes cargar tambien
    // tus css y js.
    Laradmin::styles($myStyles);
    Laradmin::scripts($myScripts);

    return View::make('admin.examples.advanced')
      ->with(compact('title', 'users', 'linkGenerator'));
  }

  /**
   * admin/message1
   *
   * Este tipo muestra una notificacion usando el plugin noty.js
   *
   * @param  string $id
   * @return void
   */
  public function getMessage1($id)
  {
    // Para mostrar una mensaje con este tipo de alerta se debe pasar
    // a la vista la variable "noty" como se muestra a continuacion:
    $noty = Laradmin::alert('Usuario con Id ' . $id, 'error');

    return Redirect::to('admin/examples/advanced')->with(compact('noty'));

    // Si quisieras mostra errores de validacion con el noty entonces unicamente
    // haz el redirect con el metodo withErrors() de Laravel
    // $validator = Validator::make(
    //   array(
    //     'name'     => 'Laradmin',
    //     'password' => 'pass',
    //     'email'    => 'oscar.alcantars@gmail.com'
    //   ),
    //   array(
    //     'name'     => 'required|max:4',
    //     'password' => 'required|min:8',
    //     'email'    => 'required|email|unique:users,email'
    //   )
    // );

    // if ($validator->fails())
    // {
    //   return Redirect::to('admin/examples/advanced')
    //     ->withErrors($validator->errors());
    // }
  }

  /**
   * Este tipo muestra el alerta de bootstrap.
   *
   * @param  string $id
   * @return void
   */
  public function getMessage2($id)
  {
    // Si quieres mostrar una alerta del tipo bootstrap se deber pasar la
    // variable "alertbs".
    $alertbs = Laradmin::alert('Usuario con Id ' . $id);

    return Redirect::to('admin/examples/advanced')
      ->with(compact('alertbs'));

    // Si quisieras mostrar errores de validacion entonces pasa la variable
    // "alertbs" como "true" y usando el metodo withErrors() de Laravel
    // Ejemplo:

    // $validator = Validator::make(
    //   array(
    //     'name'     => 'Laradmin',
    //     'password' => 'pass',
    //     'email'    => 'oscar.alcantars@gmail.com'
    //   ),
    //   array(
    //     'name'     => 'required|max:4',
    //     'password' => 'required|min:8',
    //     'email'    => 'required|email|unique:users,email'
    //   )
    // );

    // $alertbs = true;

    // if ($validator->fails())
    // {
    //   return Redirect::to('admin/examples/advanced')
    //     ->withErrors($validator->errors())
    //     ->with(compact('alertbs'));
    // }
  }
}