<?php
require_once Ultils::root_dir() . '/classes/tbl_category.php';
require_once Ultils::root_dir() . '/classes/tbl_brand.php';
$tbl_category = new ProductCate($connect);
$categories = $tbl_category->get_Categories();
$tbl_brand = new Brand($connect);
$brands = $tbl_brand->get_brands();
$tbl_product = new Product($connect);

$errors = [];

if (isset($_POST['submit'])) {
  $product_name = $_POST['product_name'];
  if (empty($product_name)) {
    $errors['prd_name'] = 'Product name is required';
  }
  $product_price = $_POST['product_price'];
  if (empty($product_price)) {
    $errors['prd_price'] = 'Product price is required';
  }
  $product_image = $_FILES['product_image']['name'];
  $product_image_tmp = $_FILES['product_image']['tmp_name'];
  $product_category = $_POST['product_category'];
  $product_brand = $_POST['product_brand'];
  if (empty($product_category)) {
    $errors['prd_cate'] = 'Product category is required';
  }
  $product_description = $_POST['product_description'];
  if (empty($product_description)) {
    $errors['prd_desc'] = 'Product description is required';
  }

  if (count($errors) == 0) {
    // check file type only image
    $file_type = pathinfo($product_image, PATHINFO_EXTENSION);
    if ($file_type != 'jpg' && $file_type != 'png' && $file_type != 'jpeg' && $file_type != 'gif') {
      echo "<script>alert('File type is not image')</script>";
      exit();
    }
    if (!file_exists(Ultils::root_dir('') . "/images/")) {
      mkdir(Ultils::root_dir('') . "/images/", 0777, true);
    }
    $product_image =  time().$product_image;
    move_uploaded_file($product_image_tmp, Ultils::root_dir('') . "/images/" . $product_image);

    // todo insert csdl
    $inserted = $tbl_product->insert_product($product_name, $product_category, $product_brand, $product_description, 0, $product_price, $product_image);
    if($inserted){
      echo "<script>alert('Product added successfully')</script>";
      echo "<script>window.open('index.php?page=product','_self')</script>";
    }else{
      echo "<script>alert('Product added failed')</script>";
    }
  }
}

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Add Product</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Add Product</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Add Product</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form id="product_form" method="post" enctype="multipart/form-data">
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Product Name</label>
                  <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter product name" required>
                  <?php if(isset($errors['prd_name'])) echo '<p><i class="text-danger">'.$errors['prd_name'].'</i></p>'; ?>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Product Price</label>
                  <input type="number" class="form-control" id="product_price" name="product_price" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Product Image</label>
                  <input type="file" class="form-control" id="product_image" name="product_image">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Product Category</label>
                  <select name="product_category" class="form-control" required>
                    <option value="">Select category</option>
                    <?php
                    foreach ($categories as $key => $category) {
                      // echo '<option value="'.$category['id'].'">'.$category['name'].'</option>';
                    ?>
                      <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Product Brand</label>
                  <select name="product_brand" class="form-control" required>
                    <option value="">Select brand</option>
                    <?php
                    foreach ($brands as $key => $brand) {
                      // echo '<option value="'.$category['id'].'">'.$category['name'].'</option>';
                    ?>
                      <option value="<?php echo $brand['id']; ?>"><?php echo $brand['brandName']; ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Product Description</label>
                  <textarea class="form-control" id="product_description" name="product_description" placeholder="Enter product name" required></textarea>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
          </div>
          <!-- /.card -->
        </div>
        <!--/.col (left) -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<script>
  // init jquery function

  (function() {
    $(document).ready(function() {
      $('#product_description').summernote({
        height: 300,
        minHeight: null,
        maxHeight: null,
        focus: true
      });
    });
  })(jQuery)
</script>