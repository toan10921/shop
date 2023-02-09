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

    public function check_product_inserted($cart_session_id,$product_id){
        $sql = "SELECT * FROM tbl_cart WHERE ssessionId = '$cart_session_id' AND productId = $product_id";
        $result = $this->conn->query($sql);
        $data = $result->fetch_all(MYSQLI_ASSOC);
        return $data;
    }

    public function update_cart($cart_session_id,$product_id,$quantity,$old_qty){
        $quantity = (int)$quantity + (int)$old_qty;
        $sql = "UPDATE tbl_cart SET quantity = $quantity WHERE ssessionId = '$cart_session_id' AND productId = $product_id";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function get_cart($cart_session_id){
        $sql = "SELECT tbl_product.*,tbl_cart.quantity FROM tbl_cart inner join tbl_product on tbl_cart.productId = tbl_product.id WHERE tbl_cart.ssessionId = '$cart_session_id' ";
        $result = $this->conn->query($sql);
        $data = $result->fetch_all(MYSQLI_ASSOC);
        return $data;
    }

    // public function get_brands(){
    //     $sql = "SELECT * FROM tbl_brand";
    //     $result = $this->conn->query($sql);
    //     $data = $result->fetch_all(MYSQLI_ASSOC);
    //     return $data;
    // }
}