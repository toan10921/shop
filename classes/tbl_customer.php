<?php
class Customer{
    protected $conn;

    public function __construct(Connect $connect){
        $this->conn = $connect->conn;
    }

    public function get_customer($email,$password){
        // phai dung query stmt va validate that ky du lieu ko cho hack
        $sql = "SELECT * FROM tbl_customer WHERE email = '$email' AND password = '$password'";
        $result = $this->conn->query($sql);
        $data = $result->fetch_assoc();
        return $data;
    }

    public function get_customer_by_id($customer_id){
        $sql = "SELECT * FROM tbl_customer WHERE id = $customer_id";
        $result = $this->conn->query($sql);
        $data = $result->fetch_assoc();
        return $data;
    }

    public function insert_customer($name,$email,$password,$phone,$address){
        $sql = "INSERT INTO tbl_customer (name,email,password,phone,address,country,city,zipcode) VALUES ('$name','$email','$password','$phone','$address','','','')";
        $result = $this->conn->query($sql);
        if($result){
            $customer_id = $this->conn->insert_id;
            $customer_inserted = $this->get_customer_by_id($customer_id);
            return $customer_inserted;
        }
        return false;
    }

}