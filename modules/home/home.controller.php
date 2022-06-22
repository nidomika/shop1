<?php
require_once "./modules/products/products.model.php";

Route::add("/", function () {
    $productsModel = new ProductsModel();
    $products = $productsModel->getAllProducts();

    include "home.view.php";
});
