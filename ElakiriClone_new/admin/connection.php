<?php

class Database
{

    public static $connecrtion;

    public static function setUpConnection()
    {

        if (!isset(Database::$connecrtion)) {

            Database::$connecrtion = new mysqli("localhost", "root", "your_password", "elakiri", "3306");
        }
    }
    // 12Btcusdt

    public static function iud($q)
    {


        Database::setUpConnection();
        Database::$connecrtion->query($q);
    }

    public static function search($q)
    {

        Database::setUpConnection();
        $resultset = Database::$connecrtion->query($q);
        return $resultset;
    }
}
