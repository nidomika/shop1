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
        $stmt = $this->db->prepare("SELECT * FROM products WHERE deleted = 0");
        $stmt->execute();
        $products = $stmt->fetchAll();

        return $products;
    }

    public function getAllProductsInStock()
    {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE deleted = 0 AND quantity > 0");
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
        $add = $stmt->fetch();

        return $add;
    }

    public function editProduct($values)
    {
        $stmt = $this->db->prepare("UPDATE products SET name = ?, price = ?, description = ?, image_url = ?, quantity = ? WHERE id = ?");
        $stmt->execute($values);
        $edit = $stmt->fetch();

        return $edit;
    }

    public function removeProduct($productId)
    {
        $stmt = $this->db->prepare("UPDATE products SET deleted = 1 WHERE id = ?");
        $stmt->execute([$productId]);
        $delete = $stmt->fetch();

        return $delete;
    }
}
