<?php
require_once "./modules/cart/cart.model.php";

Route::add("/koszyk", function () {
    if (!$GLOBALS["isAuth"]) {
        require "./views/401.php";
        exit();
    }

    $cartModel = new CartModel();
    $products = $cartModel->getAllFromCart();
    $total = $cartModel->getTotalSum();
    $delivery = number_format("10", 2);

    include "cart.view.php";
});
