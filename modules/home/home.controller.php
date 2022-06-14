<?php
require_once "./modules/products/products.model.php";

$productsModel = new ProductsModel();
$products = $productsModel->getAllProducts();

include "home.view.php";
