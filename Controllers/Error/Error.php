<?php

namespace Controllers\Error;

class Error
{

    public function __construct(){
        // Set user-defined error handler function
        set_error_handler("self::myErrorHandler");
        set_exception_handler("self::myException");
    }
    function myErrorHandler($errno, $errstr, $errfile, $errline)
    {
        define("ErrorJson" , json_encode([
            "errno" => $errno,
            "errstr" => $errstr,
            "errfile" => $errfile,
            "errline" => $errline
        ]));
        die(require_once __DIR__ . '/../assets/error_templates/error.php');
    }
     // A user-defined exception handler function
     function myException($exception)
     {
         echo "<b>Error:</b> ", $exception->getMessage();
     }
}
