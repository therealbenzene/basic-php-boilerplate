<?php

namespace App\Base\Database;

abstract class Database
{
    private $conn;

    public function __construct()
    {
        # code...
        $dbServername = "127.0.0.1";
        $dbPort = "6606";
        $dbUsername = "user";
        // $dbUsername = "root";
        $dbPassword = "password";
        $dbName = "scandiweb";

        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        $conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName, $dbPort);

        if (!$conn) {
            echo 'connection error: ' . mysqli_connect_error();
        }

        $this->conn = $conn;
    }

    protected function getConnection()
    {
        return $this->conn;
    }
}
