<?php

namespace Controllers\Session;

class Session
{
    public const SESSION_FIELD = 'opens';
    public const SESSION_ERROR = 'error';
    public const SESSION_TOKEN = '$rtreogy659y54hmb05hh9j04m0i4hm04inb0in';

    public static function start()
    {
        if(session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

    }

    public function setAttribute($attribute, $value)
    {
        if (session_status() === PHP_SESSION_ACTIVE
            && is_string($attribute)) {
            $_SESSION[$attribute] = $value;
        }
    }

    public function getAttribute($attribute)
    {
        if (session_status() === PHP_SESSION_ACTIVE
            && is_string($attribute)
            && isset($_SESSION[$attribute])) {
            return $_SESSION[$attribute];
        }
        return null;
    }

    public function deleteAttribute($attribute)
    {
        if (session_status() === PHP_SESSION_ACTIVE
            && is_string($attribute)
            && isset($_SESSION[$attribute])) {
            unset($_SESSION[$attribute]);
        }
    }

    public static function destroySession(): bool
    {

        return session_destroy();
    }
}
