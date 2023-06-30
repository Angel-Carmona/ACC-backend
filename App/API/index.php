<?php

use App\API\API;
use Controllers\System\System;

require_once __DIR__ . '/../../vendor/autoload.php';

API::Upload();

if(API::getMethod() !== "POST") {
    http_response_code(403);
    die("forbidden");
}

API::setHeaders();

$action = null;
$id = null;
$concepto = null;
$coa = null;
$data = null;
$tabla = null;
$primaria = null;
$token = (object) ['token' => null];

$post =  json_decode(file_get_contents('PHP://input')) ;

if(is_null($post)) {
    $post = (object) $_POST;
}

if(is_null($post)) {
    $post  = API::getQueryString() && count(API::getQueryString()->vars) > 0 ? (object)  API::getQueryString()->vars : null;
}


if(is_null($post)) {
    echo json_encode(["Forbidden" => 403, "message" => "Variables no recibidas."]);
    die(http_response_code(403));
}

foreach ($post as $key => $value) {
    $value = (object) $value;

    if(isset($value->name) && $value->name === 'action') {
        $action = $value->value;
    }
    if(isset($value->name) && $value->name === 'id') {
        $id = $value->value;
    }
    if(isset($value->name) && $value->name === 'token') {
        $token->token = $value->value;
    }
    if(isset($value->name) && $value->name === 'data') {
        $data = $value->value ;
    }
    if(isset($value->name) && $value->name === 'tabla') {
        $tabla = $value->value ;
    }
    if(isset($value->name) && $value->name === 'primaria') {
        $primaria = $value->value ;
    }
}

if(API::Auth($token->token) === false) {
    echo json_encode(
        [
            "Forbidden" => 403 ,
            "message" => "Auth:null" ,
            "data" => $post
        ]
    );
    die(http_response_code(403));
}

if(!isset($action)) {
    echo json_encode([
        "Forbidden" => 403
    ]);
    die(http_response_code(403));
}

switch ($action) {
    case 'getBancos':
        die(json_encode(
            API::getBancos()
        ));
    case 'getIpri':
        die(json_encode(
            API::getIpri($data)
        ));
    case 'getCoas':
        die(json_encode(
            API::getCoas()
        ));
    case 'getCatastros':
        die(json_encode(
            API::getCatastros()
        ));
    case 'getRoles':
        die(json_encode(
            System::getGroups()
        ));
    case 'getProvincias':
        die(json_encode(
            API::getProvinces()
        ));
    case 'getConceptos':
        die(json_encode(
            API::getConceptos()
        ));
    case 'getUsers':
        die(json_encode(
            API::getUsers()
        ));
    case 'getUserIdentity':
        die(json_encode(
            API::getUserByEmail($email)
        ));
    case 'getBancoId':
        die(json_encode(
            API::getBancosID($id)
        ));
    case 'getCoasId':
        die(json_encode(
            API::getCoasID($id)
        ));
    case 'setValues':
        die(json_encode(
            API::setValues($tabla, $data, $primaria)
        ));
    case 'insertValues':
        die(json_encode(
            API::insertValues($tabla, $data, $primaria)
        ));
    case 'saveConfig':
        die(System::saveConfigStyles(
            json_encode($data)
        ));
    case 'updateUserGroupName':
        die(System::saveUserGroup(
            (array) $data
        ));
    case 'deleteUserGroup':
        die(System::deleteUserGroup(
            (int) $data->id_usergroup
        ));
    default:
        http_response_code(403);
        die(json_encode([
            "Forbidden" => 403,
            "message" => "Invalid action"
        ]));
}
