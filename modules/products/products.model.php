<?php
class ProductsModel
{
    private $db;

    function __construct()
    {
        $this->db = $GLOBALS["db"];
    }

    public function getAllProducts()
    {
        $stmt = $this->db->prepare("SELECT * FROM products");
        $stmt->execute();
        $products = $stmt->fetchAll();

        return $products;
    }

    public function getProductById($productId)
    {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$productId]);
        $product = $stmt->fetch();
        return $product;
    }

    public function addProduct($values)
    {
        $stmt = $this->db->prepare("INSERT INTO products (name, price, description, image_url, quantity) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute($values);
        $product = $stmt->fetch();
        return $product;
    }

    public function editProduct($values)
    {
        $stmt = $this->db->prepare("UPDATE products SET name = ?, price = ?, description = ?, image_url = ?, quantity = ? WHERE id = ?");
        $stmt->execute($values);
        $product = $stmt->fetch();
        return $product;
    }

    public function removeProduct($productId)
    {
        $stmt = $this->db->prepare("DELETE FROM products WHERE id = ?");
        $stmt->execute([$productId]);
        $product = $stmt->fetch();
        return $product;
    }
}
