<?php
// config mysql
define('DB_HOST', 'localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','shoptoan');

class Connect{
    public $conn;
    public function __construct(){
        // write by oop
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->conn->connect_errno) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }
}
