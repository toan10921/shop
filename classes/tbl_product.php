<?php
class Product{
    protected $conn;

    public function __construct(Connect $connect){
        $this->conn = $connect->conn;
    }

    public function get_products($brand = null, $category = null , $sort = null, $order = null, $limit = null,$offset = null){
        $sql = "SELECT tbl_product.*,tbl_brand.brandName as brandName, tbl_category.name as categoryName FROM tbl_product inner join tbl_brand on tbl_product.brandId = tbl_brand.id inner join tbl_category on tbl_product.catId = tbl_category.id where 1=1";
        
        if($sort && $order){
            $sql .= " ORDER BY $sort $order";
        }
        if($limit){
            $sql .= " LIMIT $limit";
        }

        if($offset){
            $sql .= " OFFSET $offset";
        }

        $result = $this->conn->query($sql);
        $data = $result->fetch_all(MYSQLI_ASSOC);
        return $data;
    }

    public function total_record(){
        $sql = "SELECT * FROM tbl_product";
        $result = $this->conn->query($sql);
        $total_record = $result->num_rows;
        return $total_record;
    }
}