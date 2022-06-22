<?php
require_once "./modules/products/products.model.php";

Route::add("/", function () {
    $productsModel = new ProductsModel();
    $products = $productsModel->getAllProducts();

    require "./views/home.php";
});
