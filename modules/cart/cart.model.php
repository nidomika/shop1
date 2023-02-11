<?php
require_once "./modules/products/products.model.php";

class CartModel
{
    private $db;
    private $productsModel;
    public $deliveryCost;

    function __construct()
    {
        $this->deliveryCost = number_format("10", 2);
        $this->db = $GLOBALS["db"];
        $this->productsModel = new ProductsModel();
    }

    private function getProductById($productId)
    {
        $stmt = $this->db->prepare("SELECT * FROM carts WHERE user_id = ? AND product_id = ?");
        $stmt->execute([$GLOBALS["currentUser"]["id"], $productId]);
        $product = $stmt->fetch();

        return $product;
    }

    public function addProduct($productId, $quantity)
    {
        $productInCart = $this->getProductById($productId);
        if ($productInCart != false) {
            $newQuantity = intval($quantity) + intval($productInCart["quantity"]);
            $quantityOnStock = intval($this->productsModel->getProductById($productId)["quantity"]);
            if ($newQuantity > $quantityOnStock) {
                $newQuantity = $quantityOnStock;
            }

            $stmt = $this->db->prepare("UPDATE carts SET quantity = ? WHERE user_id = ? AND product_id = ?");
            $stmt->execute([$newQuantity, $GLOBALS["currentUser"]["id"], $productId]);
        } else {
            $stmt = $this->db->prepare("INSERT INTO carts (user_id, product_id, quantity) VALUES (?, ?, ?)");
            $stmt->execute([$GLOBALS["currentUser"]["id"], $productId, $quantity]);
        }
    }

    public function removeProduct($productId, $quantity)
    {
        $productInCart = $this->getProductById($productId);
        $newQuantity = intval($productInCart["quantity"]) - intval($quantity);
        if ($newQuantity > 0) {
            $stmt = $this->db->prepare("UPDATE carts SET quantity = ? WHERE user_id = ? AND product_id = ?");
            $stmt->execute([$newQuantity, $GLOBALS["currentUser"]["id"], $productId]);
        } else {
            $stmt = $this->db->prepare("DELETE FROM carts WHERE user_id = ? AND product_id = ?");
            $stmt->execute([$GLOBALS["currentUser"]["id"], $productId]);
        }
        $stmt2 = $this->db->prepare("UPDATE products SET quantity = quantity + 1 WHERE id = ?");
        $stmt2->execute($productId);
    }

    public function getAllFromCart()
    {
        $stmt = $this->db->prepare(
            "SELECT carts.product_id, carts.quantity AS quantity_in_cart, products.quantity AS quantity_on_stock, products.name, products.price, products.image_url FROM carts INNER JOIN products ON carts.product_id = products.id WHERE carts.user_id = ?"
        );
        $stmt->execute([$GLOBALS["currentUser"]["id"]]);
        $productsInCart = $stmt->fetchAll();

        return $productsInCart;
    }

    public function getTotalSum()
    {
        $allProductsInCart = $this->getAllFromCart();
        $total = 0;
        foreach ($allProductsInCart as $product) {
            $total += $product["price"] * $product["quantity_in_cart"];
        }

        return $total;
    }

    public function getTotalSumWithDelivery()
    {
        $total = $this->getTotalSum();

        return $total + $this->deliveryCost;
    }

    public function removeAllFromCart()
    {
        $stmt = $this->db->prepare("DELETE FROM carts WHERE user_id = ?");
        $stmt->execute([$GLOBALS["currentUser"]["id"]]);
    }

    public function saveOrder()
    {
        $orderNumber = rand(100000000, 999999999);
        $total = $this->getTotalSumWithDelivery();
        $products = $this->getAllFromCart();

        foreach ($products as $product) {
            $stmt2 = $this->db->prepare("INSERT INTO orders_products (product_id, quantity, order_no) VALUES (?, ?, ?)");
            $stmt2->execute([$product["product_id"], $product["quantity_in_cart"], $orderNumber]);
        }

        $stmt = $this->db->prepare("INSERT INTO orders (order_no, user_id, total) VALUES (?, ?, ?)");
        $stmt->execute([$orderNumber, $GLOBALS["currentUser"]["id"], $total]);

        return $orderNumber;
    }

    public function parseCartToText()
    {
        $products = $this->getAllFromCart();
        $text = "";
        foreach ($products as $product) {
            $text .= $product["name"] . " sztuk: " . $product["quantity_in_cart"] . "\n";
        }

        $text .=
            "\n Wysyłka do: \n" .
            $GLOBALS["currentUser"]["name"] .
            " " .
            $GLOBALS["currentUser"]["last_name"] .
            "\n" .
            $GLOBALS["currentUser"]["address"] .
            "\n" .
            $GLOBALS["currentUser"]["zip_code"] .
            " " .
            $GLOBALS["currentUser"]["city"] .
            "\n";

        return $text;
    }
}
