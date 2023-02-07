<?php
class ProductCate{
    protected $conn;

    public function __construct(Connect $connect){
        $this->conn = $connect->conn;
    }

    public function get_Categories(){
        $sql = "SELECT * FROM tbl_category";
        $result = $this->conn->query($sql);
        $data = $result->fetch_all(MYSQLI_ASSOC);
        return $data;
    }
}