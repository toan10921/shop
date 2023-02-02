<?php
class Config{

    protected $conn;

    public function __construct(Connect $connect){
        $this->conn = $connect->conn;
    }

    // public function get_logo(){
    //     $sql = "SELECT * FROM tbl_config where config_name = 'logo'";
    //     $result = mysqli_query($this->conn, $sql);
    //     $data = mysqli_fetch_assoc($result);
    //     return $data;
    // }

    // public function get_title(){
    //     $sql = "SELECT * FROM tbl_config where config_name = 'shop_title'";
    //     $result = mysqli_query($this->conn, $sql);
    //     $data = mysqli_fetch_assoc($result);
    //     return $data;
    // }

    public function get_record($config_name){
        $sql = "SELECT * FROM tbl_config where config_name = '$config_name'";
        $result = $this->conn->query($sql);
        // lay ra 1 ban ghi
        $data = $result->fetch_assoc();

        return $data;
    }

}