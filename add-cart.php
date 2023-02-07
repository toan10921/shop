<?php
require_once './config.php';
require_once './ultils.php';
require_once './classes/tbl_config.php';
require_once './classes/tbl_product.php';
require_once './classes/tbl_cart.php';

$connect = new Connect();
$tbl_cart = new Cart($connect);
if(isset($_GET['id']) && !empty($_GET['id'])){
    $product_id = $_GET['id'];
    $quantity = $_GET['quantity'];
    $cart_session_id = $_GET['cart_sessionid'];
    $result = $tbl_cart->insert_cart($cart_session_id,$product_id,$quantity);
    echo $result;
}