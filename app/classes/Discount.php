<?php
require_once 'Product.php';
class Discount extends Product
{
    public function create_discount($name, $start_date, $end_date)
    {
        $sql = "INSERT INTO discounts (name, start_date, end_date) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $name, $start_date, $end_date);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function get_one_discount($discount_id)
    {
        $sql = "SELECT * from discounts WHERE discount_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $discount_id);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function get_one_discount_with_product($discount_id){
        $sql = "SELECT  p.product_id, p.name as naziv_artikla, p.price, p.size, p.image
                FROM product_discounts pd
                INNER JOIN products p ON pd.product_id = p.product_id
                WHERE pd.discount_id = ?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $discount_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function exist($product_id,$discount_id)
    {
        $sql = "SELECT * FROM product_discounts WHERE product_id=? AND discount_id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $product_id,$discount_id);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }


    public function get_all_discounts()
    {
        $sql = "SELECT * FROM discounts";
        $result = $this->conn->query($sql);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function add_product_to_discount($discount_id,$selected_products){
        $sql_insert = "INSERT INTO product_discounts (discount_id, product_id) VALUES (?, ?)";
        $stmt_insert = $this->conn->prepare($sql_insert);

        foreach ($selected_products as $product_id) {
            $stmt_insert->bind_param("ii", $discount_id, $product_id);
            $stmt_insert->execute();
        }
    }

    public function remove_product_from_discount($selected_products, $discount_id)
    {
        // Dobavite sve proizvode povezane s trenutnim discount-om
        $current_products = $this->get_one_discount_with_product($discount_id);

        foreach ($current_products as $product) {
            $product_id = $product['product_id'];

            // Ako proizvod nije među odabranim proizvodima, izbrišite ga
            if (!in_array($product_id, $selected_products)) {
                $sql_delete = "DELETE FROM product_discounts WHERE discount_id = ? AND product_id = ?";
                $stmt_delete = $this->conn->prepare($sql_delete);
                $stmt_delete->bind_param("ii", $discount_id, $product_id);
                $stmt_delete->execute();
            }
        }
    }

}