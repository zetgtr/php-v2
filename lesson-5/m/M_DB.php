<?php

class M_DB
{
    const DB_HOST = 'localhost';
    const DB_USER = 'root';
    const DB_PASSWORD = '';
    const DB_NAME = 'lesson-8';
    const CHARSET = 'utf8';

    static private $db;

    protected static $instance = null;

    public function __construct(){
        if (self::$instance === null){
            try {
                self::$db = new PDO(
                    'mysql:host='.self::DB_HOST.';dbname='.self::DB_NAME,
                    self::DB_USER,
                    self::DB_PASSWORD,
                    $options = [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES ".self::CHARSET
                    ]
                );
            } catch (PDOException $e) {
                throw new Exception ($e->getMessage());
            }
        }
        return self::$instance;
    }
    public static function query($stmt)  {
        return self::$db->query($stmt);
    }
    public static function prepare($stmt)  {
        return self::$db->prepare($stmt);
    }
}