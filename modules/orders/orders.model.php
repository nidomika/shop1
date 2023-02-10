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
        $stmt = $this->db->prepare("SELECT * FROM orders");
        $stmt->execute();
        $products = $stmt->fetchAll();

        return $products;
    }

    public function getOrderByNo($orderNo)
    {
        $stmt = $this->db->prepare("SELECT * FROM orders WHERE id = ?");
        $stmt->execute([$orderNo]);
        $product = $stmt->fetch();
        return $product;
    }

    public function getOrderProducts($orderNo)
    {
        $stmt = $this->db->prepare("SELECT * FROM orders_products WHERE order_no = ?");
        $stmt->execute([$orderNo]);
        $product = $stmt->fetch();
        return $product;
    }
}
