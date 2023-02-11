<?php
class OrdersModel
{
    private $db;

    function __construct()
    {
        $this->db = $GLOBALS["db"];
    }

    public function getAllOrders()
    {
        $stmt = $this->db->prepare("SELECT * FROM orders ORDER BY date_ordered DESC");
        $stmt->execute();
        $orders = $stmt->fetchAll();

        return $orders;
    }

    public function getOrderDetailsByNo($orderNo)
    {
        $stmt = $this->db->prepare("SELECT * FROM orders AS o JOIN users AS u ON o.user_id = u.id WHERE order_no = ?");
        $stmt->execute([$orderNo]);
        $details = $stmt->fetch();

        return $details;
    }

    public function getOrderProducts($orderNo)
    {
        $stmt = $this->db->prepare("SELECT p.id, p.name, p.price, op.quantity FROM orders_products AS op JOIN products AS p ON op.product_id = p.id WHERE order_no = ?");
        $stmt->execute([$orderNo]);
        $products = $stmt->fetchAll();

        return $products;
    }

    public function finalizeOrder($orderNo)
    {
        $stmt = $this->db->prepare("UPDATE orders SET completed = 1 WHERE order_no = ?");
        $stmt->execute([$orderNo]);
        $update = $stmt->fetch();

        return $update;
    }
}
