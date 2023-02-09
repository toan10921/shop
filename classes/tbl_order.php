<?php
require_once './ultils.php';
require_once './config.php';
require_once './classes/tbl_cart.php';
require_once './classes/tbl_order_detail.php';

class Order{
    protected $conn;
    protected $tbl_cart;
    protected $tbl_order_detail;

    public function __construct(Connect $connect){
        $this->conn = $connect->conn;
        $this->tbl_cart = new Cart(new Connect);
        $this->tbl_order_detail = new OrderDetail(new Connect);
    }

    public function insert_order($cart_sessionid,$customerId, $status){
        $sql = "INSERT INTO tbl_order (customerId, status) VALUES ($customerId , 0)";
        $this->conn->query($sql);
        $instert_order_id =  $this->conn->insert_id;
        // get all product from cart
        $cart_products = $this->tbl_cart->get_cart($cart_sessionid);
        foreach($cart_products as $cart_product){
            $product_id = $cart_product['id'];
            $quantity = $cart_product['quantity'];
            $price = $cart_product['price'];
            $this->tbl_order_detail->insert_order_details($instert_order_id, $product_id, $quantity, $price);
        }

       return $instert_order_id;
    }
}