<?php


class connexionPDO
{
    private const HOST = 'localhost';
    private const BD_Name = 'finalcourse';
    private const USER = 'root';
    private const PWD = '';
    private static $pdo=null;

    /**
     * connexionPDO constructor.
     */
    private function __construct()
    {
        try {
            self::$pdo = new PDO("mysql:host=" . self::HOST . ";dbname=" . self::BD_Name,
                self::USER, self::PWD);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }

    }

    public static function getInstance()
    {
        if(!self::$pdo)
        {
           new connexionPDO();
            echo "I'm creating a new instance <br>";
        }else {
            echo "I'm using the same instance <br>";
        }
        return self::$pdo;
    }

}
