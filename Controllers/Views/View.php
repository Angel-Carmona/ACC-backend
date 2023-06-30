<?php

namespace Controllers\Views;

use App\Globals\Globals;
use Controllers\User\User;
use Models\Dbstruct\Dbstruct;
use Controllers\Session\Session;

class View extends Globals
{
    protected static $view;

    public function __construct($uri)
    {
        Session::start();
        self::$view = $uri;
        self::Template();
    }

    public static function Template(): void
    {
        new Dbstruct();
        User::login();
        User::newUser();
        User::setPassword();
        if(isset($_GET['logout'])) {
            Session::destroySession();
            header('Location: '.parent::URL);
        }

        self::$view = str_replace(
            ['.php' , '.html' , '?'.$_SERVER['QUERY_STRING']],
            '',
            self::$view
        );

        define('TEMPLATE_DIRECTORY', parent::TEMPLATE_DIRECTORY);
        if (self::AddDataTablesAssets()) {
            define('ADD_CUSTOM_CSS', 1);
        } else {
            define('ADD_CUSTOM_CSS', 0);
        }
        if(isset($_SESSION[Session::SESSION_FIELD]) && $_SESSION[Session::SESSION_FIELD]['usergroup'] == 1) {
            if(!defined('CLIENT')) {
                define('CLIENT', false);
            }
        } else {
            if(!defined('CLIENT')) {
                define('CLIENT', true);
            }
        }
        if(self::Condition()) {
            if(self::SessionValid()) {
                require_once parent::HEADER;
                require_once parent::DASHBOARD;
                require_once parent::FOOTER;
            } else {
                require_once parent::LOGIN;
            }
        } else {
            if(self::SessionValid()) {
                if(file_exists(parent::COMPONENTS.self::$view.'.php')) {
                    require_once parent::HEADER;
                    require_once parent::COMPONENTS.self::$view.'.php';
                    require_once parent::FOOTER;
                } elseif(file_exists(parent::FRONT.self::$view.'.php')) {
                    require_once parent::HEADER;
                    require_once parent::FRONT.self::$view.'.php';
                    require_once parent::FOOTER;
                } else {
                    require_once parent::P404;
                }
            } else {
                require_once parent::LOGIN;
            }
        }
        exit();
    }

    public static function AddDataTablesAssets(): bool
    {
        return (strpos(self::$view, 'coa') !== false)
        ||
        (strpos(self::$view, 'catastros') !== false)
        ||
        (strpos(self::$view, 'usuarios') !== false)
        ||
        (strpos(self::$view, 'buscar') !== false)
        ||
        (strpos(self::$view, 'bancos') !== false);
    }
    public static function Condition(): bool
    {
        return (strlen(self::$view) == 0  || self::$view == '/' || self::$view == 'index');
    }
    public static function getHeader(): void
    {
        require_once parent::HEADER;
    }
    public static function getFooter(): void
    {
        require_once parent::FOOTER;
    }

    public static function SessionValid(): bool
    {
        return isset($_SESSION[Session::SESSION_FIELD]);
    }

}
