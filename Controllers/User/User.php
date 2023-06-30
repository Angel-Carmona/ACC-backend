<?php

namespace Controllers\User;

use App\Globals\Globals;
use Models\Database\Database;
use Controllers\System\System;
use Controllers\Session\Session;

class User extends Database
{
    private const TABLE = 'users';

    public function __construct()
    {
    }
    public static function login()
    {

        if(isset($_POST['logear'])) {

            Session::destroySession();

            Session::start();

            $username = (isset($_POST['username']) ? strip_tags($_POST['username']) : null);
            $email = (isset($_POST['email']) ? strip_tags($_POST['email']) : "");

            $typeLogin = (int) json_decode(System::getTypeLogin());

            if($typeLogin == 1) {

                $login = self::query("SELECT * FROM ".self::TABLE." WHERE username='".$username."' AND user_email='".$email."' ");

            } elseif($typeLogin == 2) {

                $login = self::query("SELECT * FROM ".self::TABLE." WHERE username='".$username."'  ");

            } elseif($typeLogin == 3) {

                $login = self::query("SELECT * FROM ".self::TABLE." WHERE user_email='".$email."' ");

            } else {

                $login = self::query("SELECT * FROM ".self::TABLE." WHERE username='".$username."' AND user_email='".$email."' ");
            }

            if($login->num_rows > 0) {

                $exito = null;

                $hash = $login->fetch_assoc();

                if($hash['user_status'] == 0) {
                    $_SESSION[Session::SESSION_ERROR] = "No tienes permiso para aceder.";
                    return 4;
                }

                if(password_verify($_POST['password'], $hash['password'])) {
                    $exito = true;
                }

                if(is_null($exito)) {
                    if(md5($_POST['password']) == $hash['password']) {
                        $exito = true;
                    }
                }

                if(is_null($exito)) {
                    $_SESSION[Session::SESSION_ERROR] = "Las credenciales son incorectas";
                    return 1;
                }

                $_SESSION[Session::SESSION_FIELD] = $hash;
                self::updateLastLogin();
                unset($_SESSION[Session::SESSION_ERROR]);
            } else {
                return 0;
            }
        }
    }
    public static function getCurretnUser()
    {
        Session::start();
        $login = self::query(
            "SELECT * FROM ".self::TABLE." 
            WHERE username='".$_SESSION[Session::SESSION_FIELD]['username']."' 
            AND 
            user_email='".$_SESSION[Session::SESSION_FIELD]['user_email']."' "
        );
        $_SESSION[Session::SESSION_FIELD] = $login->fetch_assoc();
    }

    public static function getUserID()
    {
        Session::start();
        return $_SESSION[Session::SESSION_FIELD]['user_id'];
    }
    public static function getUserByEmail($email)
    {
        $login = parent::query("SELECT * FROM ".self::TABLE." WHERE user_email='".$email."' ");
        return  $login->num_rows > 0 ? true : false;
    }


    public static function newUser()
    {
        if(isset($_POST['registrar'])) {
            $username = strip_tags($_POST['username']);
            $user_email = strip_tags($_POST['email']);
            $password = self::setPasswordHash($_POST['password']);
            $empresa = strip_tags($_POST['empresa']);
            if(!self::is_email_exists($user_email) && !self::is_username_exists($username)) {
                $query = "INSERT INTO users SET 
                    username = '$username', 
                    user_email = '$user_email', 
                    user_status = 1 , 
                    usergroup = 2, 
                    password = '$password', 
                    empresa = '$empresa' ,
                    date_created = '".date('Y-m-d H:i:s')."'
                ";
                if(parent::query($query)) {
                    header("Location: ".Globals::URL . '?regOk=1');
                } else {
                    header("Location: ".Globals::URL . '?regko=2');
                }
            } else {
                header("Location: ".Globals::URL . '?regko=3');
            }
        }
    }

    public static function setPasswordHash($rpas): string
    {
        return password_hash($rpas, PASSWORD_DEFAULT);
    }


    public static function setPassword()
    {

        if(isset($_POST['setPassword']) && $_POST['setPassword'] == Session::SESSION_TOKEN) {
            $password =  strip_tags($_POST['password']);
            $passwordOld = $_POST['password_old'];
            $user_id =  $_POST['user_id'];

            $response = parent::query("SELECT password WHERE user_id=" .  $user_id);

            if($response->num_rows > 0) {

                $response = $response->fetch_assoc();

                if(password_verify($passwordOld, $response[0]->password) || md5($passwordOld) == $response[0]->password) {

                    parent::query("UPDATE user SET password = '".password_hash($password, PASSWORD_DEFAULT)."' WHERE user_id=" . $user_id);

                    self::getCurretnUser();

                    return [ 'status' => "success" , "mensaje" => "Contraseña cambiada correctamente"];
                }

                return [ 'status' => "danger" , "mensaje" => "Error al guardar la contraseña"];
            }
        }
    }

    public static function updateLastLogin()
    {
        return self::query(
            "UPDATE ".self::TABLE." 
            SET 
            last_login='".date('Y-m-d H:i:s')."' 
            WHERE 
            user_id='".$_SESSION[Session::SESSION_FIELD]['user_id']."' "
        );
    }
    public static function is_email_exists($email)
    {
        return self::query(
            "SELECT user_email FROM ".self::TABLE." WHERE user_email='".$email."' "
        );
    }
    public static function is_username_exists($username)
    {
        return self::query(
            "SELECT username FROM ".self::TABLE." WHERE username='".$username."' "
        );
    }
    public static function setValues($query)
    {
        return self::query(
            $query
        );
    }

    public static function insertValues($query)
    {
        return self::query(
            $query
        );
    }

    public static function getUsers()
    {
        $res = [];
        $datos = self::query("SELECT * FROM ".self::TABLE." ");
        if($datos->num_rows > 0) {
            while($row = $datos->fetch_assoc()) {
                $res[] = $row;
            }
        }
        return $res;
    }

    public static function getUsergroups()
    {
        $res = [];
        $datos = self::query("SELECT * FROM usergroup");
        if($datos->num_rows > 0) {
            while($row = $datos->fetch_assoc()) {
                $res[] = $row;
            }
        }
        return $res;
    }

    public static function getMyUser()
    {
        $res = [];
        $datos = self::query("SELECT * FROM users WHERE user_id ='".$_SESSION[Session::SESSION_FIELD]['user_id']."' ");
        if($datos->num_rows > 0) {
            while($row = $datos->fetch_assoc()) {
                $res[] = $row;
            }
        }
        return $res;
    }
    
    public static function getToken($getToken)
    {
        $res = [];
        $resultados = false;
        $datos = self::query('SELECT * FROM tokens tk , users us WHERE tk.user_id = us.user_id  AND  tk.token ="'.$getToken.'"');
        if($datos->num_rows > 0) {
            while($row = $datos->fetch_assoc()) {
                $res[] = $row;
            }
            $resultados = $res;
        }
        return  $resultados;
    }


    public static function getdata($query)
    {
       $res = [];
        $datos = self::query($query);
        if($datos->num_rows > 0) {
            while($row = $datos->fetch_assoc()) {
                $res[] = $row;
            }
        }
        return $res;
    }
}
