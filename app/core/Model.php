<?php


abstract class  Model
{
    protected static function getDB()
    {
        static $db = null;
        if ($db === null) {
            try {
                $host = 'localhost';
                $dbname = 'junior_dev_test';
                $user = 'root';
                $password = '';

                $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);

                //throw exception when error occurs
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                return $db;
            } catch (\PDOException $e) {
                echo $e->getMessage();
            }
        }
    }


    protected function check($a)
    {
        return mysqli_real_escape_string($this->connection, $a);
    }
}
