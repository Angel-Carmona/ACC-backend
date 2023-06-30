<?php

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
    echo "<b>Error:</b> " . $exception->getMessage();
    die();
}

set_error_handler("myErrorHandler");
set_exception_handler("myException");

use Models\Database\Database;
use Controllers\Views\View;
use Controllers\Session\Session;

require_once __DIR__ . '/../vendor/autoload.php';

Session::start();

if(!defined('DB')) {
    define('DB', (new Database()));
}

$uri = explode('/', $_SERVER['REQUEST_URI']);
$uri = end($uri);

if(!defined('VIEW')) {
    define('VIEW', (new View(($uri))));
}
