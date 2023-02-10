<?php
require_once "./modules/products/products.model.php";

Route::add("/", function () {
    $productsModel = new ProductsModel();
    $products = $productsModel->getAllProductsInStock();

    require "./views/home.php";
});
