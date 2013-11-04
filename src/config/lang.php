<?php

return array(

  // Si el key default es true entonces significa que Laradmin usara los archivos
  // lang por default del paquete, si es false entonces utilizara los que estan
  // en app/lang/en y app/lang/es. Si se quiere agregar otro lang entonces
  // se tendria que crear la carpeta en app/lang/ y en el key valid_lang de abajo
  // agregarlo.
  'default' => true,

  // Contiene los lenguages que seran usados en Laradmin, por default estan
  // en => ingles, es => español. Si se requiere de otro lang entonces agregarlo
  // ejemplo:   ['en', 'es', 'it']
  // El primer lang del array es el que sera cargado por default, asi que si
  // quieres que por el español sea el por default coloca "es" en la primera
  // posicion del array.
  'valid_langs' => ['en', 'es']

);