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

    public function insert_product($product_name,$cat_id,$brand_id,$desc,$type,$price,$image_name){
        $product_name = $this->conn->real_escape_string($product_name);
        $cat_id = (int)$this->conn->real_escape_string($cat_id);
        $brand_id = (int)$this->conn->real_escape_string($brand_id);
        $type = (int)$type;
        $price = (float)$this->conn->real_escape_string($price);
        $image_name = $this->conn->real_escape_string($image_name);

        $sql = "INSERT INTO tbl_product (productName,catId,brandId,productDesc,type,price,image) VALUES ('$product_name',$cat_id,$brand_id,'$desc',$type,$price,'$image_name')";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function get_product_by_id($id){
        $id = (int)$id;
        $sql = "SELECT * FROM tbl_product WHERE id = $id";
        $result = $this->conn->query($sql);
        $data = $result->fetch_assoc();
        return $data;
    }

    public function get_product_by_id_frontend($id){
        $id = (int)$id;
        $sql = "SELECT tbl_product.*,tbl_brand.brandName as brandName,tbl_category.name as categoryName FROM tbl_product inner join tbl_brand on tbl_product.brandId = tbl_brand.id inner join tbl_category on tbl_product.catId = tbl_category.id  WHERE tbl_product.id = $id";
        $result = $this->conn->query($sql);
        $data = $result->fetch_assoc();
        return $data;
    }

    public function update_product($id,$product_name, $product_price, $product_image, $product_category, $product_brand, $product_description){
        $id = (int)$id;
        $product_name = $this->conn->real_escape_string($product_name);
        $product_price = (float)$this->conn->real_escape_string($product_price);
        $product_category = (int)$this->conn->real_escape_string($product_category);
        $product_brand = (int)$this->conn->real_escape_string($product_brand);
        $product_description = $this->conn->real_escape_string($product_description);

        if($product_image == null){
            $sql = "update tbl_product set productName = '$product_name', price = $product_price, catId = $product_category, brandId = $product_brand, productDesc = '$product_description' where id = $id";
        }else{
            $product_image = $this->conn->real_escape_string($product_image);
            $sql = "update tbl_product set productName = '$product_name', price = $product_price, image = '$product_image', catId = $product_category, brandId = $product_brand, productDesc = '$product_description' where id = $id";
        }
     
        $result = $this->conn->query($sql);
        return  $result;
    }

    public function delete_product($id){
        $id = (int)$id;
        $sql = "DELETE FROM tbl_product WHERE id = $id";
        $result = $this->conn->query($sql);
        return $result;
    }

}