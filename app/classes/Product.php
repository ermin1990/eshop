<?php

class Product{
    protected $conn;

    public function __construct(){
        global $conn;
        $this->conn = $conn;
    }

    public function get_all(){
        $sql = "SELECT * FROM products";
        $res = $this->conn->query($sql);
        return $res->fetch_all(MYSQLI_ASSOC);
    }


    public function get_one_product($product_id){
        $stmt = $this->conn->prepare("Select * from products Where product_id=?");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();

        $res = $stmt->get_result();
        return $res->fetch_assoc();


    }

    public function add_new_product($name,$price,$size,$image,$target){
        // Unos u bazu
        $sql = "INSERT INTO products (name, price, size, image) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sdss", $name, $price, $size, $image);

        if ($stmt->execute()) {
            move_uploaded_file($_FILES['image']['tmp_name'], $target);
            $_SESSION['servermsg'] = "Produkt uspješno dodan";
        } else {
            $_SESSION['servermsg'] = "Greška prilikom dodavanja artikla!";
            var_dump($stmt->error);
        }

        return $this->conn->insert_id;


    }

    public function delete($product_id){
        $sql="DELETE FROM products WHERE product_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
    }

    public function update($product_id, $name, $price, $size){
        $sql = "UPDATE products SET name= ?, price= ?, size= ? WHERE product_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssi", $name,$price,$size, $product_id);
        $res = $stmt->execute();

        if ($res){
            return true;
        }
    }



}