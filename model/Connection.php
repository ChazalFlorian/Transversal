<?php
/**
 * Created by PhpStorm.
 * User: Kévin
 * Date: 03/04/2015
 * Time: 16:23
 */


class Connection extends PDO
{
    private static $pdo;

    public function __construct(){
         parent::__construct('mysql:host=localhost;dbname=easyrelax', 'root', '', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    }

    public static function getConnection() {
        if (!self::$pdo) 
        	self::$pdo = new self;
        
        return self::$pdo;
    }
}
