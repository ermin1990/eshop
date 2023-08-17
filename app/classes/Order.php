<?php
require_once "Cart.php";

class Order extends Cart
{

    public function createOrder($delivery_address){
        $stmt = $this->conn->prepare("INSERT INTO orders (user_id, delivery_address) values (?,?)");
        $stmt->bind_param("is", $_SESSION['user_id'],$delivery_address);
        $stmt->execute();

        $orderd_id = $this->conn->insert_id;

        $cart_items = $this->get_cart_items();

        $stmt= $this->conn->prepare("INSERT INTO order_items(order_id, product_id, quantity) values (?,?,?)");

        foreach ($cart_items as $item){
            $stmt->bind_param("iis", $orderd_id, $item['product_id'],$item['quantity']);
            $stmt->execute();
        }
        $this->destroy_cart();

    }

    public function get_orders(){
        $user_id = $_SESSION['user_id'];

        $sql =("SELECT
        orders.order_id,
        orders.delivery_address,
        orders.created_at,
        order_items.quantity,
        products.name,
        products.price,
        products.size,
        products.image
        FROM orders
        INNER JOIN order_items ON orders.order_id = order_items.order_id
        INNER JOIN products ON order_items.product_id = products.product_id
        WHERE orders.user_id = ?
        ");

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();

        $res = $stmt->get_result();
        return $res->fetch_all(MYSQLI_ASSOC);

    }

    public function get_all_orders()
    {
        $sql = "SELECT orders.order_id, users.name, orders.created_at
            FROM orders
            INNER JOIN users ON orders.user_id = users.user_id
            ORDER BY orders.created_at DESC";

        $result = $this->conn->query($sql);

        $orders = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $orders[] = $row;
            }
        }

        return $orders;
    }

    public function get_order_details($order_id)
    {
        $sql = "SELECT p.name, p.price, oi.quantity 
            FROM order_items oi
            INNER JOIN products p ON oi.product_id = p.product_id
            WHERE oi.order_id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $order_id);
        $stmt->execute();

        $result = $stmt->get_result();

        $order_details = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $order_details[] = $row;
            }
        }

        return $order_details;
    }

    public function getOrder($order_id)
    {
        $sql = "SELECT * FROM orders WHERE order_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $order_id);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }


}