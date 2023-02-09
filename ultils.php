<?php

define('VERSION', '1.0.0');

class Ultils{

    public static function home_url($slug){
        $home_url = "http://localhost/n2110l/shop/".$slug;
        return $home_url;
    }

    public static function root_dir(){
        $root_dir = $_SERVER['DOCUMENT_ROOT']."/n2110l/shop/";
        return $root_dir;
    }

    public static function format_number($number){
        return number_format($number, 0, ',', '.') . ' đ';
    }
}

function dump($data){
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
}