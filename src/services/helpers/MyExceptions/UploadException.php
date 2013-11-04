<?php namespace Helpers\MyException;

class UploadException extends \Exception {}

\App::error(function(UploadException $e, $code, $fromConsole)
{
    if ( $fromConsole )
    {
        return 'Error '.$code.': '.$e->getMessage()."\n";
    }

    return '<h1>Error '.$code.'</h1><p>'.$e->getMessage().'</p>';

});