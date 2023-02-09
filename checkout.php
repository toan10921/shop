<?php
require_once './config.php';
require_once './ultils.php';
require_once './classes/tbl_config.php';
require_once './classes/tbl_product.php';
require_once './classes/tbl_category.php';
require_once './classes/tbl_cart.php';
require_once './classes/tbl_order.php';
session_start();
$connect = new Connect();
$tbl_cart = new Cart($connect);
$tbl_order = new Order($connect);
$products_cart = [];

if (!empty($_COOKIE['cart_sessionid'])) {
    $products_cart = $tbl_cart->get_cart($_COOKIE['cart_sessionid']);
}

if (empty($_SESSION['customer'])) {
    header('Location: ' . Ultils::home_url('login.php?redirect=checkout.php'));
}

if (count($products_cart) == 0) {
    header('Location: ' . Ultils::home_url('index.php'));
}

$total_cart = 0;

foreach($products_cart as $product){
    $total_cart += (int)$product['quantity'] * (float)$product['price'];
}


if(isset($_POST['submit'])){
    // $cusname = $_POST['cusname'];
    // $address = $_POST['address'];
    // $phone = $_POST['phone'];
    // $email = $_POST['email'];
    // $note = $_POST['note'];
    // $total = $total_cart;
    $cart_session_id = $_COOKIE['cart_sessionid'];
    $customer_id = $_SESSION['customer']['id'];
    $payment_method = $_POST['payment_method'];
    switch ($payment_method){
        default:
        case '1':
            $result = $tbl_order->insert_order($cart_session_id, $customer_id,0);
            if($result){
                if(isset($_COOKIE['cart_sessionid'])){
                    setcookie('cart_sessionid', '', time() - 3600, '/');
                }
                header('Location: ' . Ultils::home_url('receive-order.php'));
            }
        break;
        case '3':
            header('Location: ' . Ultils::home_url('vnpay.php?total=' . $total_cart ));
            break;
    }
   
}

require_once './templates/header.php';
?>
<div class="main">
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h3>Your Cart:</h3>
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($products_cart as $product) :
                        ?>
                            <tr>
                                <td><?php echo $product['productName']; ?></td>
                                <td><?php echo $product['quantity']; ?></td>
                                <td><?php echo Ultils::format_number((float)$product['price']); ?></td>
                                <td><?php echo Ultils::format_number((int)$product['quantity'] * (float)$product['price']); ?></td>
                            </tr>
                        <?php
                        endforeach;
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">Total cart</td>
                            <td colspan="2"><?php echo Ultils::format_number($total_cart); ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="col-6">
                <form action="" method="post">
                    <h3>Your information:</h3>
                    <div class="form-group">
                        <label for="cusname">Customer Name:</label>
                        <input id="cusname" type="text" name="cusname" value="<?php echo $_SESSION['customer']['name']; ?>" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="cusname">Customer address:</label>
                        <input id="address" type="text" name="address" value="<?php echo $_SESSION['customer']['address']; ?>" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="cusname">City:</label>
                        <input id="city" type="text" name="city" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="cusname">Country:</label>
                        <input id="country" type="text" name="country" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="cusname">Zipcode:</label>
                        <input id="zipcode" type="text" name="zipcode" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="cusname">Phone:</label>
                        <input id="phone" type="text" name="phone" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="cusname">Payment method:</label>
                        <select name="payment_method" class="form-control">
                            <option value="1">Cash on delivery</option>
                            <option value="2">Paypal</option>
                            <option value="3">vnpay</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <div class="pay-wrap d-flex justify-content-end">
                            <button type="submit" name="submit" href="#" class="btn btn-success">Pay now</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    require_once './templates/footer.php';
