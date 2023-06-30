<?php

namespace App\Globals;

class Globals
{
    protected const HOST = "localhost";
    protected const HOSTDB = "localhost";
    protected const FOLDER = "excel/";
    protected const DB_USERNAME = "root";
    protected const DB_PASSWORD = "";
    public const HOME_PATH = __DIR__ . "/../../";
    protected const DB_DATABASE_NAME = "php_importarexcel";
    public const URL = "http://" . self::HOST . '/' . self::FOLDER;
    public const API_URL = "http://" . self::HOST . '/' . self::FOLDER . "App/API/index.php";
    public const TEMPLATE_URL = self::URL . "Controllers/Views/";
    public const TEMPLATE_DIRECTORY = self::URL . "Controllers/Views/Templates/";
    public const FOOTER = self::HOME_PATH.'Controllers/Views/Templates/Base/footer.php';
    public const HEADER= self::HOME_PATH.'Controllers/Views/Templates/Base/header.php';
    public const LOGIN = self::HOME_PATH.'Controllers/Views/login.php';
    public const P404 = self::HOME_PATH.'assets/error_templates/404.php';
    public const COMPONENTS = self::HOME_PATH.'Controllers/Views/Templates/Components/';
    public const FRONT = self::HOME_PATH.'Controllers/Views/Templates/Front/';
    public const DASHBOARD = self::HOME_PATH.'Controllers/Views/dashboard.php';
    public const LOGO = "http://" . self::HOST . '/' . self::FOLDER . 'Controllers/Views/Templates/Login/assets/img/logo.webp';
}
