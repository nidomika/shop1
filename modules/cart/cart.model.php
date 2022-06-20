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
        $stmt = $this->db->prepare("SELECT * FROM carts WHERE `user_id` = ? AND `product_id` = ?");
        $stmt->execute([$GLOBALS["currentUser"]["id"], $productId]);
        $product = $stmt->fetch();

        return $product;
    }

    public function addProduct($productId, $quantity)
    {
        $product = $this->getProductById($productId);
        if ($product != false) {
            $newQuantity = intval($quantity) + intval($product["quantity"]);
            $quantityOnStock = intval($this->productsModel->getProductById($productId)["quantity"]);
            if ($newQuantity > $quantityOnStock) {
                $newQuantity = $quantityOnStock;
            }
            $stmt = this->db->prepare("UPDATE carts SET quantity= ? WHERE `user_id`= ? AND product_id= ?");
            $stmt->execute([$newQuantity, $GLOBALS["currentUser"]["id"], $product["id"]]);
        } else {
            $stmt = $this->db->prepare("INSERT INTO carts (`user_id`, `product_id`, `quantity`) VALUES (?, ?, ?)");
            $stmt->execute([$GLOBALS["currentUser"]["id"], $productId, $quantity]);
            $user = $stmt->fetch();
        }
    }
    public function removeProduct($productId, $quantity)
    {
        $product = $this->getProductById($productId);
        if (intval($product["quantity"]) > 0) {
            $newQuantity = intval($quantity) + intval($product["quantity"]);
            $stmt = this->db->prepare("UPDATE carts SET quantity= ? WHERE `user_id`= ? AND product_id= ?");
            $stmt->execute([$newQuantity, $GLOBALS["currentUser"]["id"], $product["id"]]);
        } else {
            $stmt = $this->db->prepare("DELETE FROM carts WHERE `user_id` = ? AND product_id = ?");
            $stmt->execute([$GLOBALS["currentUser"]["id"], $product["id"]]);
            $user = $stmt->fetch();
        }
    }
}
