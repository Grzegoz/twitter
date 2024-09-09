<?php

namespace Artur\Twitter\Core;

use PDO;
use PDOException;

class Database {

    private const HOST = 'localhost';
    private const DBNAME = 'postgres';
    private const USER = 'postgres';
    private const PASSWORD = '1234';
    private const PORT = '5000';

    private static $pdo;

    public static function init()
    {
        try {
            $dsn = "pgsql:host=" . self::HOST . ";dbname=" . self::DBNAME . ";port=" . self::PORT;
            self::$pdo = new PDO($dsn, self::USER, self::PASSWORD, [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION]);
        } 
        catch(PDOException $e) {
            echo "ошибка подключения" . $e->getMessage();
            die();
        }   
    }

    public static function query($sql) {
        $stm = self::$pdo->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function insert($name_table, $data) {
        $columns_str = implode(',', array_keys($data));
        $value_str = implode(',', $data);
        $sql = "INSERT INTO $name_table($columns_str) VALUES ($value_str)";
        $stm = self::$pdo->prepare($sql);
        $stm->execute();

    }

    
}










// вот код для проверки подключения моей БД: $stm = $pdo->prepare("SELECT 1");
            // $stm->execute();
            // $result = $stm->fetch();
            // var_dump($result);
//В index.php мы пишем \Artur\Twitter\Core\Database::init();