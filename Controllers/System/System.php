<?php

namespace Controllers\System;

use Controllers\User\User;
use Models\Database\Database;
use Controllers\Session\Session;

class System extends Database
{
    final public static function getStyles()
    {

        $res = [];
        $resultados = false;
        $datos = parent::query('SELECT json FROM config WHERE name = "styles";');
        if($datos->num_rows > 0) {
            while($row = $datos->fetch_assoc()) {
                $res[] = json_decode($row['json']);
            }
            $resultados = $res;
        }
        return  $resultados;
    }
    final public static function getGroups($id = null)
    {
        $res = [];
        $resultados = false;
        if($id) {
            $datos = parent::query('SELECT * FROM usergroup WHERE id_usergroup ='.$id);
        } else {
            $datos = parent::query('SELECT * FROM usergroup');
        }
        if($datos->num_rows > 0) {
            while($row = $datos->fetch_assoc()) {
                $countUser = parent::query('SELECT count(*) as contador FROM users WHERE usergroup ="'.$row['id_usergroup'].'"');
                $row['contador'] = $countUser->fetch_assoc()['contador'];
                $row['groupname'] = ucfirst($row['groupname']);
                $res[] = $row;
            }
            $resultados = $res;
        }
        return  $resultados;
    }
    final public static function saveUserGroup($data): string
    {
        $data = (array) $data;
        $id = isset($data['id_usergroup']) ? (int)  $data['id_usergroup'] : null;
        $groupname = (string) $data['groupname'];
        if(isset($id)) {
            if(count(self::getGroups($id)) > 0) {
                $res = Database::query("UPDATE usergroup SET groupname='$groupname' WHERE id_usergroup =" .$id);
            } else {
                $res = Database::query("INSERT INTO usergroup SET groupname='$groupname'");
            }
        } else {
            $res = Database::query("INSERT INTO usergroup SET groupname='$groupname'");
        }
        return $res ? json_encode(["success"=> 1]) : json_encode(["Error"=> 1]);
    }

    final public static function addVisita(): bool
    {
        return Database::query("UPDATE monitor SET datavalue = (SELECT datavalue FROM monitor WHERE datakey ='visitas') + 1 , `user_id`=".User::getUserID()." WHERE datakey='visitas' ");
    }

    final public static function getTypeLogin(): string
    {
        $dato = Database::query('SELECT JSON_EXTRACT(json, "$.json.site-config.loginType") AS loginType FROM config');
        return json_encode($dato->fetch_assoc()['loginType']);
    }
    final public static function getTypeForm(): string
    {
        $dato = Database::query('SELECT JSON_EXTRACT(json, "$.json.site-config.formSearchType") AS formSearchType FROM config');
        return  $dato->fetch_assoc()['formSearchType'] ;
    }

    final public static function deleteUserGroup($id): string
    {
        return json_encode(Database::query("DELETE FROM usergroup WHERE id_usergroup=" .$id));
    }

    final public static function saveConfigStyles($json): string
    {
        return json_encode(Database::query("UPDATE config SET json='$json' WHERE name = 'styles'; "));
    }

    public static function getPluginsList()
    {
        $path = __DIR__ . '/../../Plugins/';
        $dir = opendir($path);
        while ($elemento = readdir($dir)) {
            if($elemento != "." && $elemento != "..") {
                if(is_dir($path.$elemento)) {
                    $arrFiles = glob($path.$elemento . '/*.ini');
                    self::readPluginsIniVars($arrFiles);
                }
            }
        }
    }

    private static function readPluginsIniVars($arrFiles)
    {
        for ($i=0; $i < count($arrFiles) ; $i++) {
            $pluginsVars = (object) ((object) parse_ini_file($arrFiles[$i], true))->options;
            echo '
                <div class="dx-field">
                    <div class="dx-field-label '.(isset($pluginsVars->desabilitado) && $pluginsVars->desabilitado == 'true' ? 'text-dashed' : "").'" title="'.$pluginsVars->title.' --v'.$pluginsVars->version.'">'.$pluginsVars->title.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Versión: '.$pluginsVars->version.'</div>
                    <div class="dx-field-value">
                        <div id="withText'. $pluginsVars->id.'"></div>
                    </div>
                </div>

                <script>
                    $("#withText'.$pluginsVars->id.'").dxCheckBox({
                        value: '.$pluginsVars->activo.',
                        disabled: '.$pluginsVars->desabilitado.',
                        hint: "'.$pluginsVars->title.'  --v'.$pluginsVars->version.'" ,
                        text: "",
                    });
                </script>
            ';
        }
    }
}
