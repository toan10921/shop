<?php
class Slider {

    protected $conn;

    public function __construct(Connect $connect){
        $this->conn = $connect->conn;
    }
    
    public function get_slider(){
        $sql = "SELECT * FROM tbl_slider where status = 0";
        // $result = mysqli_query($this->conn, $sql);
        // $data = mysqli_fetch_assoc($result);
        $result = $this->conn->query($sql);
        // lay ra tat ca ban ghi
        $data = $result->fetch_all(MYSQLI_ASSOC);
        return $data;
    }
}