<?php namespace Libs;

/**
 * Realiza el upload de un archivo.
 *
 * @package Libs
 * @author oscaralcantars
 **/
class Upload {

  /**
   * Nombre del archivo.
   * @var String
   */
  private $filename;

  /**
   * Path donde se guardara el archivo.
   * @var String
   */
  private $destinationPath;

  /**
   * Nombre del input que se envia desde el formulario.
   * @var String
   */
  private $inputFileName;

  /**
   * Booleano que indica si se generara un nombre random para el archivo.
   * @var boolean
   */
  public $encrypt_name = false;

  /**
   * Obj \Input::file
   * @var Obj
   */
  private $file;

  /**
   * Constructor.
   * @param String $filename
   * @param String $destinationPath
   */
  public function __construct($filename=null, $destinationPath=null)
  {
    $this->filename        = $filename;
    $this->destinationPath = $destinationPath;
  }

  /**
   * Realiza el upload del archivo al server.
   *
   * @return String
   */
  public function doUpload()
  {
    // Si es null el nombre del input del formulario lanza una excepcion.
    if (is_null($this->inputFileName))
      throw new MyException\UploadException("Error Upload: inputFileName no puede ser null.");

    // Asigna el input file.
    $this->file = \Input::file($this->inputFileName);

    // Si es null la ruta donde se guardara el archivo lanza una excepcion.
    if (is_null($this->destinationPath))
      throw new MyException\UploadException("Error Upload: destinationPath no puede ser null.");

    // Si el atributo encrypt_name es true entonces genera un nombre random
    // para el archivo junto con su formato.
    if ($this->encrypt_name) $this->filename = $this->encrypt_name();

    // Si el nombre del archivo es null y no se especifico que se
    // generara uno aleatorio, entonces asigna el nombre original del archivo.
    else if (is_null($this->filename)) $this->filename = $this->file->getClientOriginalName();

    // Realiza el upload del achivo.
    $this->file->move($this->destinationPath, $this->filename);

    // Retorna la ruta real del archivo junto con su nombre.
    return $this->getRealPath();
  }

  /**
   * Genera un nombre random para el archivo.
   *
   * @return String
   */
  private function encrypt_name()
  {
    return $this->gen_uuid() . '.' . $this->getFormat();
  }

  /**
   * Obtiene el formato del archivo a subir.
   *
   * @return String
   */
  private function getFormat()
  {
    $ext = explode('.', $this->file->getClientOriginalName());
    return $ext[1];
  }

  /*
   |-------------------------------------------------------------------------
   |  SETTERS && GETTERS
   |-------------------------------------------------------------------------
   */

  /**
   * Asigna el nombre del input que se envia del formulario.
   *
   * @param String
   */
  public function setInputFile($name = null)
  {
    $this->inputFileName = $name;
  }

  /**
   * Asigna el nombre con el que se guardara el archivo.
   *
   * @param String
   */
  public function setFilename($filename = null)
  {
    $this->filename = $filename;
  }

  /**
   * Asigna el path donde se guardara el archivo.
   *
   * @param String
   */
  public function setDestinationPath($path = null)
  {
    $this->destinationPath = $path;
  }

  /**
   * Obtiene la ruta real del archivo apartir del atributo destinationPath.
   *
   * @return String
   */
  public function getRealPath()
  {
    return $this->destinationPath . '/' . $this->filename;
  }

  /*
   |-------------------------------------------------------------------------
   |  HELPERS
   |-------------------------------------------------------------------------
   */

  /**
   * Elimina un archivo del Sistema de archivos.
   *
   * @param  String $path
   * @return void
   */
  public static function delete($path)
  {
    unlink($path);
  }

  /**
   * Genera una cadena aleatoria.
   *
   * '%04x%04x-%04x-%04x-%04x-%04x%04x%04x'
   *
   * @return String
   */
  public static function gen_uuid() {

    return sprintf( '%04x%04x%04x%04x%04x%04x%04x%04x',
        // 32 bits for "time_low"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

        // 16 bits for "time_mid"
        mt_rand( 0, 0xffff ),

        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
        mt_rand( 0, 0x0fff ) | 0x4000,

        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        mt_rand( 0, 0x3fff ) | 0x8000,

        // 48 bits for "node"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
    );
}

}