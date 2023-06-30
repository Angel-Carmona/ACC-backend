<?php
use Models\Database\Database;
use Controllers\Views\View;
use Controllers\Session\Session;

require_once __DIR__ . '/../vendor/autoload.php';

function myErrorHandler($errno, $errstr, $errfile, $errline)
{
    define("ErrorJson", json_encode([
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
    die("<b>Error:</b> " . $exception->getMessage());
}
set_error_handler("myErrorHandler");
set_exception_handler("myException");

Session::start();

if(!defined('DB')) {
    define('DB', 
        new Database()
    );
}

$uri = explode('/', $_SERVER['REQUEST_URI']);
if(!defined('VIEW')) {
    define('VIEW', 
        new View(
            end($uri)
        )
    );
}
