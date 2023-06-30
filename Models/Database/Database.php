<?php

# namespace Database

namespace Models\Database;

# Native Class import
use Exception;

#Custom class import
use App\Globals\Globals;

class Database extends Globals
{
    protected static $connection = null;
    public function __construct()
    {
        try {
            self::$connection = mysqli_connect(self::HOSTDB, self::DB_USERNAME, self::DB_PASSWORD, self::DB_DATABASE_NAME);
            if (mysqli_connect_errno()) {
                throw new Exception("Could not connect to database.");
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function select($query = "", $params = [])
    {
        $result = [];
        try {
            $stmt = self::executeStatement($query, $params);
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
        } catch(Exception $e) {
            echo $e->getMessage();
        }
        return $result;
    }
    private static function executeStatement($query = "", $params = [])
    {
        $stmt = false;
        try {
            $stmt = self::$connection->prepare($query);
            if($stmt === false) {
                throw new Exception("Unable to do prepared statement: " . $query);
            }
            if($params) {
                $stmt->bind_param($params[0], $params[1]);
            }

            $stmt->execute();

        } catch(Exception $e) {
            echo $e->getMessage();
        }
        return $stmt;
    }


    public static function query($query = "")
    {
        new Database();
        return self::$connection->query($query);
    }


    public function getField($table, $field, $value)
    {
        $query = "SELECT `$field` FROM `$table` WHERE `$field` = '$value'";
        $results = self::query($query);
        return json_encode($results);
    }
}
