<?php
class User{
    protected $conn;

    public function __construct(Connect $connect){
        $this->conn = $connect->conn;
    }

    public function get_user($username, $password){
        $stmt = $this->conn->prepare("SELECT * FROM tbl_users WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        // lay ra 1 ban ghi
        $data = $result->fetch_assoc();
        return $data;
    }
}