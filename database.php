<?php


define('DB_SERVER', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'test');

class Connection
{

    private $pdo;

    public $servarname = DB_SERVER;
    public $username = DB_USER;
    public $password = DB_PASS;
    public $dbname = DB_NAME;

    public function connect()
    {
        $this->pdo = null;
        try {
            $this->pdo = new PDO('mysql:host=' . $this->servarname . ';dbname=' . $this->dbname, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            return $this->pdo;
        } catch (PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }
    }
}

class Database extends Connection
{

    // function for registration
    public function register($name, $email, $password)
    {
        $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(['name' => $name, 'email' => $email, 'password' => $password]);

        if ($stmt) {
            return true;
        } else {
            return false;
        }
    }

    // function for login
    public function login($email, $password)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if (password_verify($password, $user['password'])) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    // function for checking email already exists
    public function checkEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(['email' => $email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return true;
        } else {
            return false;
        }
    }
}
