  <?php

    $tbl_product = new Product($connect);
    $limit = 10;
    $current_page = isset($_GET['paging']) ? $_GET['paging'] : 1;
    $offset = ($current_page - 1) * $limit;
    $products = $tbl_product->get_products(null, null, 'id', 'DESC', $limit, $offset);
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
                          </div>
                          <!-- /.card-body -->
                          <div class="card-footer clearfix">
                              <?php
                                $panigation = new Pagination($limit, $total_products);
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
  <script>
      $(document).ready(function() {

          $('.btn-delete-product').on('click', function(e) {
              e.preventDefault();

              Swal.fire({
                      title: 'Are you sure?',
                      text: "You won't be able to revert this!",
                      icon: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Yes, delete it!'
                  })
                  .then((result) => {
                      // todo: logout
                      if (result.isConfirmed) {
                          // var id = $(this).data('id');
                          var id = $(this).attr('data-id');
                          var paging = '<?php echo $current_page; ?>';
                          var params = {
                                id: id,
                                paging: paging
                          }
                          var query = $.param(params);
                          var url = '<?php echo Ultils::home_url('admincp/product/delete-product.php?'); ?>' + query;
                          $.ajax({
                              url: url,
                              type: 'GET',
                              success: function(data) {
                                 $('.content .card-body').html(data);
                                //   if(data == '1'){
                                //      window.location.reload();
                                //   }
                              },
                              error: function(error) {
                                  console.log(error);
                              }
                          });
                      }
                  });
          });
      });
  </script>