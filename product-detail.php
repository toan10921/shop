<?php
require_once './config.php';
require_once './ultils.php';
require_once './classes/tbl_config.php';
require_once './classes/tbl_product.php';
require_once './classes/tbl_category.php';

$connect = new Connect();

$tbl_product = new Product($connect);
$tbl_category = new ProductCate($connect);

if (!isset($_GET['id']) || empty($_GET['id'])) {
    // exit();
    header('Location: index.php');
}

$product = $tbl_product->get_product_by_id_frontend($_GET['id']);
$categories = $tbl_category->get_Categories();

require_once './templates/header.php';
?>
<div class="main">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-8">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <img src="<?php echo Ultils::home_url('images/') . $product['image']; ?>" alt="">
                    </div>
                    <div class="col-12 col-sm-6">
                        <h1><?php echo $product['productName']; ?></h1>
                        <p>Price: <?php echo $product['price']; ?></p>
                        <p>Category: <?php echo $product['categoryName']; ?></p>
                        <p>Brand: <?php echo $product['brandName']; ?></p>
                        <form method="get" id="add_cart">
                            <label>Quantity:</label>
                            <input type="number" value="1" />
                            <button class="btn btn-primary">Add to cart</button>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h2>Product description</h2>
                        <p><?php echo $product['productDesc']; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="sidebar">
                    <div class="widget">
                        <h2>cATEGORIES</h2>
                        <ul>
                            <?php
                            foreach ($categories as $category) {
                                echo '<li><a href="' . Ultils::home_url('category.php?id=' . $category['id']) . '">' . $category['name'] . '</a></li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#add_cart').on('submit', function(e) {
            e.preventDefault();
            let cart_sessionid = getCookie('cart_sessionid');
            if (cart_sessionid == '' || cart_sessionid == null) {
                cart_sessionid = makeid(10);
            }

            if (cart_sessionid) {
                // set cookie
                setCookie('cart_sessionid', cart_sessionid, 10);
                // xu ly logic oday
                var quantity = $(this).find('input').val();
                var id = <?php echo $product['id']; ?>;
                var params = {
                    id: id,
                    quantity: quantity,
                    cart_sessionid: cart_sessionid
                };
                var query = $.param(params);
                $.ajax({
                    url: '<?php echo Ultils::home_url('add-cart.php') ?>'+ '?' + query,
                    type: 'get',
                    success: function(data) {
                        console.log(data);
                    },
                    error(error) {
                        console.log(error);
                    }
                });
            }


        });
    });
</script>

<?php
require_once './templates/footer.php';
