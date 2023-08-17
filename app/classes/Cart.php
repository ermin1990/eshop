<?php

class Cart
{
    protected $conn;

    public function __construct(){
        global $conn;
        $this->conn = $conn;
    }

    public function add_to_cart($product_id,$user_id,$quantity)
    {
        $stmt = $this->conn->prepare("insert into cart (user_id, product_id, quantity) values (?,?,?)");
        $stmt->bind_param("iii", $user_id,$product_id, $quantity);
        $stmt->execute();
    }

    public function get_cart_items()
    {
        $stmt = $this->conn->prepare("SELECT p.product_id, p.name, p.price, p.size, p.image, c.quantity, c.cart_id
                                            FROM cart c
                                            INNER JOIN products p
                                            ON c.product_id = p.product_id
                                            WHERE c.user_id=?");

        $stmt->bind_param("i", $_SESSION['user_id']);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    public function destroy_cart(){
        $stmt = $this->conn->prepare("DELETE FROM cart WHERE user_id = ?");
        $stmt->bind_param("i", $_SESSION['user_id']);
        $stmt->execute();
    }

    public function delete_cart_item($cart_item_id){
        $stmt = $this->conn->prepare("DELETE FROM cart WHERE cart_id = ?");
        $stmt->bind_param("i", $cart_item_id);
        $stmt->execute();
    }

    public function update_quantity_cart_item($cart_id, $quantity){
        $sql = "UPDATE cart SET quantity = ? WHERE cart_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $quantity, $cart_id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

    }


}