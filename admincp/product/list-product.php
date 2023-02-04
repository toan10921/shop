  <?php
    $tbl_product = new Product($connect);
    $limit = 10;
    $current_page = isset($_GET['paging']) ? $_GET['paging'] : 1;
    $offset = ($current_page - 1) * $limit;
    $products = $tbl_product->get_products(null,null,'id','DESC',$limit,$offset);
    $total_products = $tbl_product->total_record();
    ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1>Product Management</h1>
                  </div>
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="#">Home</a></li>
                          <li class="breadcrumb-item active">Product Management</li>
                      </ol>
                  </div>
              </div>
          </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
          <div class="container-fluid">
              <div class="row">
                  <div class="col-md-12">
                      <div class="card">
                          <div class="box-header card-header d-flex flex-wrap justify-content-between align-items-center">
                              <h3 class="card-title">List Products</h3>
                              <?php
                                $data_get = $_GET;
                                $data_get['page'] = 'product';
                                $data_get['action'] = 'create';
                              ?>
                              <a href="?<?php echo http_build_query($data_get); ?>" class="btn btn-success">Add New</a>
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body">
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
                                                <td><img src="<?php echo Ultils::home_url('').$product['image'] ?>" alt="" width="100px"></td>
                                                <td><?php echo $product['productName'] ?></td>
                                                <td><?php echo $product['price'] ?></td>
                                                <td><?php echo $product['brandName'] ?></td>
                                                <td><?php echo $product['categoryName'] ?></td>
                                                <td>
                                                    <a href="#" class="btn btn-primary">Edit</a>
                                                    <a href="#" class="btn btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                  </tbody>
                              </table>
                          </div>
                          <!-- /.card-body -->
                          <div class="card-footer clearfix">
                              <?php 
                                $panigation = new Pagination($limit,$total_products);
                              ?>
                          </div>
                      </div>
                      <!-- /.card -->
                  </div>
                  <!-- /.col -->
              </div>
              <!-- /.row -->
          </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->