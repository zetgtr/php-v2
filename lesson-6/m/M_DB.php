<?php

class M_DB
{
    const DB_HOST = '127.0.0.1';
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

    public function insert($table, $object) {
        
        foreach ($object as $key => $value) {
        
            $columns[] = $key;
            $masks[] = ":$key";
            
            if ($value === null) {
                $object[$key] = 'NULL';
            }
        }

        $columns_s = implode(',', $columns);
		$masks_s = implode(',', $masks);
		
		$query = "INSERT INTO $table ($columns_s) VALUES ($masks_s)";

        print_r($query);
		$q = $this->db->prepare($query);
		$q->execute($object);
		
		if ($q->errorCode() != PDO::ERR_NONE) {
			$info = $q->errorInfo();
			die($info[2]);
		}
		
		return $this->db->lastInsertId();
    }

    public function update($table, $object, $whereObj) {
			
        $sets = array();
         
        foreach ($object as $key => $value) {
            
            $sets[] = "$key=:$key";
            
            if ($value === NULL) {
                $object[$key]='NULL';
            }
         }

         foreach ($whereObj as $key => $value) {
            
            $where[] = "$key=:$key";
            $object[$key] = $value;
            
            if ($value === NULL) {
                $whereObj[$key]='NULL';
            }
         }
        
        $sets_s = implode(',',$sets);
        $where_s = implode(',',$where);
        $query = "UPDATE $table SET $sets_s WHERE $where_s";
        $q = self::$db->prepare($query);
        $q->execute($object);

        if ($q->errorCode() != PDO::ERR_NONE) {
            $info = $q->errorInfo();
            die($info[2]);
        }
        
        return $q->rowCount();
    }

    public function delete($table, $whereObj) {

        foreach ($whereObj as $key => $value) {
            
            $where[] = "$key=:$key";
            
            if ($value === NULL) {
                $whereObj[$key]='NULL';
            }
         }

        $where_s = implode(',',$where);
        $query = "DELETE FROM $table WHERE $where_s";
        $q = $this->db->prepare($query);
        $q->execute($whereObj);
        
        if ($q->errorCode() != PDO::ERR_NONE) {
            $info = $q->errorInfo();
            die($info[2]);
        }
        
        return $q->rowCount();
    }
}