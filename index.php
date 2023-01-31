<?php
require_once './config.php';
require_once './ultils.php';
require_once './classes/tbl_config.php';

$connect = new Connect();

$config_tbl = new Config($connect);
$logo = $config_tbl->get_logo();
// Ultils::dump($logo);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./assets/css/style.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-4">
                    <div class="logo-wrap d-flex flex-wrap align-items-center">
                        <a href="index.php">
                            <img src="./<?php if(is_array($logo)) echo $logo['config_value']; ?>" alt="logo">
                        </a>
                        <div class="logo-desc">
                            <h4>NCC store</h4>
                            <div><i>"fast, convenient, trust"</i></div>
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
        </div>
    </header>
</body>

</html>