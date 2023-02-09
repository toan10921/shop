<?php
class OrderDetail{
    protected $conn;

    public function __construct(Connect $connect){
        $this->conn = $connect->conn;
    }

    public function insert_order_details($orderId, $productId, $quantity, $price){
        $sql = "INSERT INTO tbl_order_detail (orderId, productId, quantity, price) VALUES ($orderId, $productId, $quantity, $price)";
        $result = $this->conn->query($sql);
        return $result;
    }
}