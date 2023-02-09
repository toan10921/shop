<?php
require_once './config.php';
require_once './ultils.php';
require_once './classes/tbl_config.php';
require_once './classes/tbl_order.php';
require_once './classes/tbl_cart.php';
require_once './classes/tbl_product.php';

session_start();

$connect = new Connect();

$tbl_cart = new Cart($connect);
$tbl_order = new Order($connect);

if (isset($_GET['vnp_SecureHash'])) {
    $customer_id = $_SESSION['customer']['id'];
    if (!empty($_COOKIE['cart_sessionid'])) {
        $products_cart = $tbl_cart->get_cart($_COOKIE['cart_sessionid']);
    }
    $total_cart = 0;

    foreach ($products_cart as $product) {
        $total_cart += (int)$product['quantity'] * (float)$product['price'];
    }
    $total_amount = ((float)$_GET['vnp_Amount'])/100;
    if ($total_amount != $total_cart) {
        header('Location: ' . Ultils::home_url('index.php'));
    }else{
        $cart_session_id = $_COOKIE['cart_sessionid'];
        $customer_id = $_SESSION['customer']['id'];
        $result = $tbl_order->insert_order($cart_session_id, $customer_id, 0);
        if ($result) {
            if (isset($_COOKIE['cart_sessionid'])) {
                setcookie('cart_sessionid', '', time() - 3600, '/');
            }
            header('Location: ' . Ultils::home_url('receive-order.php'));
        }
    }
}
