<?php
session_start();
if (!isset($_SESSION['user'])) {
    echo 'can not authorize';
    exit();
}

require_once '../../ultils.php';
require_once Ultils::root_dir() . '/config.php';
require_once Ultils::root_dir() . '/classes/tbl_product.php';
$connect = new Connect;
$tbl_product = new Product($connect);

$deleted = $tbl_product->delete_product($_GET['id']);

if ($deleted) {
    $limit = 10;
    $current_page = isset($_GET['paging']) ? $_GET['paging'] : 1;
    $offset = ($current_page - 1) * $limit;
    $products = $tbl_product->get_products(null, null, 'id', 'DESC', $limit, $offset);
    $total_products = $tbl_product->total_record();
?>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 110px">Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Brand Name</th>
                    <th>Category Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product) : ?>
                    <tr>
                        <td><img src="<?php echo Ultils::home_url('/images/') . $product['image'] ?>" alt="" width="100px"></td>
                        <td><?php echo $product['productName'] ?></td>
                        <td><?php echo $product['price'] ?></td>
                        <td><?php echo $product['brandName'] ?></td>
                        <td><?php echo $product['categoryName'] ?></td>
                        <td>
                            <?php $httpquery = http_build_query([
                                "action" => "edit",
                                "id" => $product['id'],
                            ]) ?>
                            <a href="<?php echo Ultils::home_url('admincp/index.php?page=product&') . $httpquery; ?>" class="btn btn-primary">Edit</a>
                            <a href="#" data-id="<?php echo $product['id']; ?>" class="btn btn-danger btn-delete-product">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
<?php
}
