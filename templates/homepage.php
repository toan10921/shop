<?php
require_once Ultils::root_dir() . '/classes/tbl_slider.php';
require_once Ultils::root_dir() . '/classes/tbl_product.php';

$tbl_lider = new Slider($connect);
$sliders =  $tbl_lider->get_slider();

$tbl_products = new Product($connect);
$products = $tbl_products->get_products(null, null, 'id', 'desc', 4);
?>
<section id="main">
    <div class="container">
        <div class="box1">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <div class="new-arrivals-product d-flex flex-wrap">
                        <?php
                        foreach ($products as $product) :
                        ?>
                            <div class="product-item d-flex flex-wrap">
                                <div class="img-wrap">
                                    <?php if (!empty($product['image'])) :
                                    ?>
                                        <img src="<?php echo Ultils::home_url($product['image']); ?>" alt="<?php $product['productName'] ?>">
                                    <?php
                                    endif;
                                    ?>
                                </div>
                                <div class="info-wrap">
                                    <h3 class="brand-name title18 text-uppercase fw-bold"><?php echo $product['brandName'] ?></h3>
                                    <h4 class="product-name title14"><?php echo $product['productName'] ?></h4>
                                    <a href="<?php echo Ultils::home_url('product-detail.php?id=' . $product['id']); ?>" class="btn btn-primary">View</a>
                                </div>
                            </div>
                        <?php
                        endforeach;
                        ?>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div id="homeSlider" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#homeSlider" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#homeSlider" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#homeSlider" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <?php foreach ($sliders as $key => $slider) : ?>
                                <div class="carousel-item <?php if ($key == 0) echo 'active'; ?>">
                                    <img src="<?php echo Ultils::home_url($slider['slider_image']); ?>" class="d-block w-100" alt="<?php echo $slider['slider_name']; ?>">
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#homeSlider" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#homeSlider" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>