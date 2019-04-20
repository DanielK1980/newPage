<?php

namespace src\Model;

use Exception;
use PDO;
use PDOException;
use src\Config;

class Login extends Config {

    protected $pdo;
    protected $conn = false;

    public function __construct() {
        try {
            $servername = $this::$DBHost;
            $name = $this::$DBName;
            $username = $this::$DBLogin;
            $password = $this::$DBPass;
            $this->pdo = new PDO("mysql:host=$servername;dbname=$name", $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn = true;
        } catch (PDOException $e) {
            $this->conn = "Connection failed: " . $e->getMessage();
        }
    }

    public function GetBadLogin($hr_id) {
        if ($this->conn) {
            try {
                $sql = "SELECT * FROM Login where hr_id = '$hr_id'";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
                $liczba = $stmt->rowCount();
                $this->pdo = null;
                return $liczba;
            } catch (PDOException $e) {
                return "<br> Błąd odczytu danych";
            }
        } else {
            return $this->conn;
        }
    }

    public function AddBadLogin($hr_id) {
        if ($this->conn) {
            try {
                $sql = "INSERT INTO Login (hr_id, date)
                    VALUES ('$hr_id', NOW())";
                // use exec() because no results are returned
                $this->pdo->exec($sql);               
                return "Zapisano rekord";               
            } catch (PDOException $e) {
                return "<br> Błąd zapisu danych";
            }
        } else {
            return $this->conn;
        }
    }

    public function RemoveBadLogin($hr_id) {
        if ($this->conn) {
            try {
                $sql = "DELETE FROM Login WHERE hr_id='$hr_id'";
                // use exec() because no results are returned
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
                $count = $stmt->rowCount();
                $this->pdo = null;
                return "Usunięto $count";                
            } catch (PDOException $e) {
                return "<br> Błąd usunięcia danych";
            }
        } else {
            return $this->conn;
        }
    }

}
