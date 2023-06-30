<?php

namespace Models\Dbstruct;

use Models\Database\Database;

class Dbstruct extends Database {

    public function __construct(){
        try {
            parent::query("SELECT * FROM users");
        } catch (\Throwable $th) {
            self::init();
        }
    }

    public static function init(){
        ob_start();
        
        $fichero = __DIR__ . '/../../Assets/sql/sql.sql';  // Ruta al fichero que vas a cargar.

        // Linea donde vamos montando la sentencia actual
        $temp = '';
        
        // Flag para controlar los comentarios multi-linea
        $comentario_multilinea = false;
        
        // Leemos el fichero SQL al completo
        $lineas = file($fichero);
       
        // Procesamos el fichero linea a linea
        foreach ($lineas as $linea) {
        
            $linea = trim($linea); // Quitamos espacios/tabuladores por delante y por detrás
        
            // Si es una linea en blanco o tiene un comentario nos la saltamos
            if ( (substr($linea, 0, 2) == '--') or (substr($linea, 0, 1) == '#') or ($linea == '') )
                continue;
        
            // Saltamos los comentarios multilinea /* texto */ Se detecta cuando empiezan y cuando acaban mediante estos dos ifs  
            if ( substr($linea, 0, 2) == '/*' ) $comentario_multilinea = true;
        
            if ( $comentario_multilinea ) {
               if ( (substr($linea, -2, 2) == '*/') or (substr($linea, -3, 3) == '*/;') ) $comentario_multilinea = false;
               continue;
            }
        
            // Añadimos la linea actual a la sentencia en la que estamos trabajando 
            $temp .= $linea;
        
            // Si la linea acaba en ; hemos encontrado el final de la sentencia
            if (substr($linea, -1, 1) == ';') {
                // Ejecutamos la consulta
                if(!parent::query($temp)){
                    return false;
                }
                // Limpiamos sentencia temporal
                $temp = '';
                ob_end_flush();
                ob_flush();
                flush();
                ob_start();
            }
        }
        ob_end_clean();
        return true;
    }
}


