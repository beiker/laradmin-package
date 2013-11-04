<?php namespace Validators;

/*
 |  Clase Abstracta que realiza las validaciones de formularios,
 |  Hecha para no tener que duplicar codigo y mantenerlo DRY.
 |
 |  Tambien para no colocar en los controladores las validaciones
 |  de los formularios.
 |
 |  Se tiene que crear una clase que extienda esta clase e indicar las
 |  reglas.
 |
 |
 |  NOTA: SI SE USARA ESTA CLASE POR PRIMERA VEZ EN UN PROYECTO SE TIENE
 |        QUE AGREGAR EN EL JSON DE COMPOSER
 |
 |         app/services
 */
abstract class Validator {

  /**
   * Almacena los input del formulario ya sea Input::all() o parametros
   * especificos indicados mediante un array pasado desde el contructor
   * de la clase que extienda esta clase.
   * @var array
   */
  protected $attributes;

  /**
   * Mensajes personalizados para mostrar en las validaciones.
   * @var array
   */
  protected $messages;

  /**
   * Almacena los errores en caso de existir.
   * @var string
   */
  public $errors;

  /**
   * Almacena las reglas(rules) a validar para los fields.
   * @var array
   */
  private $rules = array();

  /**
   * Almacena los nombres descriptivos para los fields a validar :)
   * @var array
   */
  private $friendly_names = array();

  /**
   * Constructor de la Clase. Recibe un parametro(attributes) que son
   * los POST del formularo, si no se le indica ningun entonces attributes
   * sera igual a Input::all()
   *
   * @param array $attributes [Array con los atributos(POST) a validar]
   *
   * @return void
   */
  public function __construct($attributes = null, $messages = 'Messages.php')
  {
    $this->attributes = $attributes ? $attributes : \Input::all();
  }

  /**
   * Realiza las validaciones de con la Clase Validator de Laravel pasandole
   * los atributes y la reglas($rules) que se especifiquen en la clase que
   * extienda esta clase.
   *
   * Si existe algun error en la validacion entonces los errores se almacenan
   * en la variable $errors.
   *
   * @return boolean [Si paso o no la validacion]
   */
  public function passes()
  {
    foreach (static::$rules as $key => $rule)
    {
      $this->rules[$key] = $rule['rules'];
    }

    $validation = \Validator::make($this->attributes, $this->rules);

    if ($validation->passes()) return true;

    $this->errors = $validation->errors();

    return false;
  }

}