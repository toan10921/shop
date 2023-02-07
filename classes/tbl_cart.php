<?php
class Cart{
    protected $conn;

    public function __construct(Connect $connect){
        $this->conn = $connect->conn;
    }

    public function insert_cart($cart_session_id,$product_id,$quantity){
        $product_id = (int)$product_id;
        $quantity = (int)$quantity;
        $sql = "INSERT INTO tbl_cart (ssessionId,productId,quantity) VALUES ('$cart_session_id',$product_id,$quantity)";
        $result = $this->conn->query($sql);
        return $result;
    }

    // public function get_brands(){
    //     $sql = "SELECT * FROM tbl_brand";
    //     $result = $this->conn->query($sql);
    //     $data = $result->fetch_all(MYSQLI_ASSOC);
    //     return $data;
    // }
}