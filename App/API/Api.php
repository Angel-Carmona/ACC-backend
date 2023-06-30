<?php

namespace App\API;

require_once __DIR__ . '/../../vendor/autoload.php';

use Controllers\User\User;
use Models\Database\Database;
use Controllers\Session\Session;

interface databaseInterface
{
    public static function getMethod(): string;
    public static function setHeaders(): void;
    public static function getData($consulta): array;
    public static function getQueryString(): object;
    public static function Auth($tr): string|bool;
    public static function Upload(): bool|string;
    public static function setValues($tabla, $data, $primaria): bool;
    public static function getUserByEmail($email): bool;
    public static function insertValues($tabla, $data, $primaria): bool;
}


class API extends Database implements databaseInterface
{
    final public static function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    final public static function setHeaders(): void
    {
        Session::start();
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods:POST");
        header("Allow: POST");
        header('Content-Type: application/json; charset=utf-8');
    }

    final public static function getQueryString(): object
    {
        $vars = (object) [  "vars" => [] ];
        if (isset($_SERVER['QUERY_STRING'])) {
            $queryString = str_replace('&&', '&', $_SERVER['QUERY_STRING']);
            $queryString = explode('&', $queryString);
            for ($i = 0; $i < count($queryString); $i++) {
                $params = explode('=', $queryString[$i]);
                if (isset($params[1])) {
                    $vars->vars[] = [
                        "name" => $params[0],
                        "value" => $params[1]
                    ];
                }
            }
        }
        return $vars;
    }

    final public static function setValues($tabla, $data, $primaria): bool
    {
        $quqery = "UPDATE `$tabla` SET ";
        $id = 0;
        foreach ($data as $key => $datos) {
            if (!in_array($datos->name, ["editar", "insertar", "eliminar"])) {
                if ($datos->name !== $primaria) {
                    $quqery .= "`$datos->name` = '$datos->value' ,";
                } else {
                    $id = $datos->value;
                }
            }
        }
        $quqery = substr($quqery, 0, strlen($quqery) - 1);
        $quqery .= " WHERE `$primaria` = $id;";
        return User::setValues($quqery);
    }

    final public static function insertValues($tabla, $data, $primaria): bool
    {
        $quqery = "INSERT INTO `$tabla` SET `$primaria` = NULL, ";
        foreach ($data as $key => $datos) {
            if (!in_array($datos->name, ["editar", "insertar", "eliminar"])) {
                if ($datos->name !== $primaria) {
                    $quqery .= "`$datos->name` = '$datos->value' ,";
                }
            }
        }
        $quqery = substr($quqery, 0, strlen($quqery) - 1) . ';';
        return User::insertValues($quqery);
    }

    final public static function getUserByEmail($email): bool
    {
        return User::getUserByEmail($email);
    }
    final public static function getData($consulta):array
    {
        return parent::query($consulta);
    }

    final public static function Auth($tr): string|bool
    {
        $string = Database::query("SELECT token FROM tokens WHERE token = '$tr'; ");
        $tr = false;
        if ($string->num_rows > 0) {
            $tr = true;
        }
        return $tr;
    }

    final public static function Upload(): bool|string
    {
        if (isset($_FILES['files'])) {
            $uploads = [
                "success" => [],
                "error" => [],
            ];
            foreach ($_FILES['files']['name'] as $k => $f) {

                $fileTemporal = $_FILES['files']['tmp_name'][$k];

                if (!is_uploaded_file($fileTemporal)) {
                    continue;
                }

                $filename = str_replace(
                    [" ", "/"],
                    ['_', ''],
                    $_FILES['files']['name'][$k]
                );

                $path_to_file = __DIR__ . '/../../assets/img/' . $filename;

                if (file_exists($path_to_file)) {
                    $path_to_file = str_replace('assets/img/', 'assets/img/' . uniqid('COPY'), $path_to_file);
                }

                $upload = move_uploaded_file($fileTemporal, $path_to_file);
                if ($upload) {
                    $uploads['success'][] = $upload;
                } else {
                    $uploads['error'][] = $upload;
                }
            }
            die(json_encode([
                "response" => $uploads
            ]));
        }
        return false;
    }
}
