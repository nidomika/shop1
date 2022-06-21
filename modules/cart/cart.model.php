<?php
require_once "./modules/products/products.model.php";
class CartModel
{
    private $db;
    private $productsModel;

    function __construct()
    {
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

            $stmt = this->db->prepare("UPDATE carts SET quantity = ? WHERE user_id = ? AND product_id = ?");
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
            $stmt = this->db->prepare("UPDATE carts SET quantity = ? WHERE user_id = ? AND product_id = ?");
            $stmt->execute([$newQuantity, $GLOBALS["currentUser"]["id"], $productId]);
        } else {
            $stmt = $this->db->prepare("DELETE FROM carts WHERE user_id = ? AND product_id = ?");
            $stmt->execute([$GLOBALS["currentUser"]["id"], $productId]);
        }
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
}
