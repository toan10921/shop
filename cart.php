<?php
require_once './config.php';
require_once './ultils.php';
require_once './classes/tbl_config.php';
require_once './classes/tbl_product.php';
require_once './classes/tbl_category.php';
require_once './classes/tbl_cart.php';

$connect = new Connect();

$tbl_cart = new Cart($connect);

$products_cart = [];

if (!empty($_COOKIE['cart_sessionid'])) {
    $products_cart = $tbl_cart->get_cart($_COOKIE['cart_sessionid']);
}
$total_cart = 0;

require_once './templates/header.php';
?>
<div class="main">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3>Your Cart:</h3>
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($products_cart as $product) :
                            $total_cart += (int)$product['quantity'] * (float)$product['price'];
                        ?>
                            <tr>
                                <td><?php echo $product['productName']; ?></td>
                                <td><input type="number" value="<?php echo $product['quantity']; ?>" /></td>
                                <td><?php echo Ultils::format_number((float)$product['price']); ?></td>
                                <td><?php echo Ultils::format_number((int)$product['quantity'] * (float)$product['price']); ?></td>
                                <td>
                                    <button class="btn btn-warning btn-update" data-product_id="<?php echo $product['id'] ?>">Update</button>
                                    <a href="<?php echo Ultils::home_url('cart.php?action=delete&id=' . $product['id']); ?>" class="btn btn-danger">Delete</a>
                                </td>
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
                <form action="<?php echo Ultils::home_url('add-cart.php'); ?>">
                    <input type="hidden" name="cart_sessionid" value="<?php if(isset($_COOKIE['cart_sessionid'])) echo $_COOKIE['cart_sessionid']; ?>" />
                    <input type="hidden" name="quantity" value="0" />
                    <input type="hidden" name="id" value="0" />
                    <input type="hidden" name="action" value="update" />
                </form>
                <a href="<?php echo Ultils::home_url('checkout.php'); ?>" class="btn btn-success">Checkout</a>
            </div>
        </div>
    </div>
</div>
<script>
    $('.btn-update').on('click',function(e){
        e.preventDefault();
        var product_id = $(this).data('product_id');
        // var quantity = $(this).parent().parent().find('input').val();
        var quantity = $(this).parents('tr').find('input').val();

        var form = $('form');
        form.find('input[name="id"]').val(product_id);
        form.find('input[name="quantity"]').val(quantity);
        form.submit();
    })
</script>
<?php
require_once './templates/footer.php';
