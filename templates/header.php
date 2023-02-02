<?php
require_once './ultils.php';
$config_tbl = new Config($connect);
$logo = $config_tbl->get_record('logo');
$title = $config_tbl->get_record('shop_title');
$sub_title = $config_tbl->get_record('shop_sub_title');
?>
<header>
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-4">
                <div class="logo-wrap d-flex flex-wrap align-items-center">
                    <a href="<?php echo Ultils::home_url(''); ?>">
                        <img src="<?php if (is_array($logo)) echo Ultils::home_url($logo['config_value']);  ?>" alt="logo">
                    </a>
                    <div class="logo-desc">
                        <h4><?php if (is_array($title)) echo $title['config_value'];  ?></h4>
                        <div><i><?php if (is_array($sub_title)) echo $sub_title['config_value'];  ?></i></div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="search-wrap">
                    <form action="" method="get">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search">
                            <button class="btn btn-outline-secondary" type="submit">Search</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="cart-login-wrap d-flex flex-wrap  justify-content-end">
                    <div class="cart-wrap">
                        <a href="cart.php">
                            <i class="fas fa-shopping-cart"></i>
                            <span>Cart: </span>
                            <b class="error">$ 0</b>
                        </a>
                    </div>
                    <div class="login-wrap">
                        <a href="login.php">
                            <i class="fas fa-user"></i>
                            <span>Login</span></a>
                        <a href="register.php">
                            <i class="fas fa-user-plus"></i>
                            <span>Register</span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <nav>
                    <ul class="d-flex flex-wrap list-style-none">
                        <li><a href="<?php echo Ultils::home_url(''); ?>">Home</a></li>
                        <li><a href="#">Products</a></li>
                        <li><a href="#">News</a></li>
                        <li><a href="#">Brand</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>