<?php 
require_once Ultils::root_dir().'/classes/tbl_product.php';

if(isset($_GET['action'])){
    $action = $_GET['action'];
    switch ($action) {
        default:
            require_once 'list-product.php';
            break;
        case 'create':
            require_once 'create-product.php';
            break;    
        case 'edit':
            require_once 'edit-product.php';
            break;    
    }
}else{
    require_once 'list-product.php';
}