<?php
class Config{

    protected $conn;

    public function __construct(Connect $connect){
        $this->conn = $connect->conn;
    }

    public function get_logo(){
        $sql = "SELECT * FROM tbl_config where config_name = 'logo'";
        $result = mysqli_query($this->conn, $sql);
        $data = mysqli_fetch_assoc($result);
        return $data;
    }

}