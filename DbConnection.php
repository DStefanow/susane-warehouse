<?php

class DbConnection
{
    // define connection properties
    const HOST = "localhost";
    const DB_name = "susan-warehouse";
    const USER = "root";
    const PASSWORD = "";

    /**
     * @var PDO
     */
    private $db;

    public function __construct()
    {
        $this->db =  new PDO("mysql:host=" . self::HOST .
                            ";dbname=" . self::DB_name .
                            ";charset=utf8", self::USER, self::PASSWORD);
    }

    public function getConnection()
    {
        return $this->db;
    }
}