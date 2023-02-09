<?php
require_once './config.php';
require_once './ultils.php';
require_once './classes/tbl_config.php';
require_once './classes/tbl_product.php';
require_once './classes/tbl_cart.php';

$connect = new Connect();
$tbl_cart = new Cart($connect);
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $product_id = $_GET['id'];
        $quantity = $_GET['quantity'];
        $cart_session_id = $_GET['cart_sessionid'];

        $check_product_inserted = $tbl_cart->check_product_inserted($cart_session_id, $product_id);
        if (is_array($check_product_inserted) && count($check_product_inserted) > 0) {
            $old_qty = (int)$check_product_inserted[0]['quantity'];
            // ko insert ma update
            $result = $tbl_cart->update_cart($cart_session_id, $product_id, $quantity, $old_qty);
        } else {
            $result = $tbl_cart->insert_cart($cart_session_id, $product_id, $quantity);
        }
        echo $result;
    }
} else {
    if (isset($_GET['action']) && !empty($_GET['action'])) {
        if ($_GET['action'] == 'update') {
            $cart_session_id = $_GET['cart_sessionid'];
            $product_id = $_GET['id'];
            $quantity = $_GET['quantity'];
            $result = $tbl_cart->update_cart($cart_session_id, $product_id, $quantity, 0);
            echo '<script>window.location.href="' . Ultils::home_url('cart.php') . '";</script>';
        }
    } else {
        echo '<script>window.location.href="' . Ultils::home_url('index.php') . '";</script>';
    }
}
