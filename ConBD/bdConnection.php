<?php

class Connection
{
    private static $conn=null;
    public static function getConnection(){
        self::$conn = null;
        if (self::$conn === null) {
            $options = array(
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            );

            $host       = 'localhost';
            $database   = 'bdweb2';
            $port       = 3306; 
            $user       = 'root';
            $password   = '';

            try { self::$conn = new PDO("mysql:host=$host;dbname=$database;port=$port",
                    $user, $password, $options);
                return self::$conn; 
            } catch (PDOException $e) {
                echo "Erro in BD: " . $e->getMessage();
                return null;
            }
        }
        return self::$conn; 
    }
}
