<?php
require_once "./modules/admin/admin.model.php";
require_once "./modules/products/products.model.php";

Route::add("/admin", function () {
    if (!$GLOBALS["isAuth"] || !$GLOBALS["currentUser"]["is_admin"]) {
        require "./views/401.php";
        exit();
    }

    $productsModel = new ProductsModel();
    $products = $productsModel->getAllProducts();

    require "./views/admin/admin.php";
});

Route::add("/admin/produkt/([0-9]*)", function ($productId) {
    if (!$GLOBALS["isAuth"] || !$GLOBALS["currentUser"]["is_admin"]) {
        require "./views/401.php";
        exit();
    }

    $productsModel = new ProductsModel();
    $product = $productsModel->getProductById($productId);

    if (!$product) {
        require "./views/404.php";
        exit();
    }

    require "./views/admin/edit-product.php";
});

Route::add(
    "/admin/produkt/([0-9]*)",
    function ($productId) {
        if (!$GLOBALS["isAuth"] || !$GLOBALS["currentUser"]["is_admin"]) {
            require "./views/401.php";
            exit();
        }

        $productsModel = new ProductsModel();
        $productsModel->editProduct(array_values($_POST));

        header("Location: /admin");
        exit();

        require "./views/admin/edit-product.php";
    },
    "post"
);

Route::add("/admin/produkt/dodaj", function () {
    if (!$GLOBALS["isAuth"] || !$GLOBALS["currentUser"]["is_admin"]) {
        require "./views/401.php";
        exit();
    }

    require "./views/admin/add-product.php";
});

Route::add(
    "/admin/produkt/dodaj",
    function () {
        if (!$GLOBALS["isAuth"] || !$GLOBALS["currentUser"]["is_admin"]) {
            require "./views/401.php";
            exit();
        }

        $productsModel = new ProductsModel();
        $productsModel->addProduct(array_values($_POST));

        header("Location: /admin");
        exit();
    },
    "post"
);

Route::add(
    "/admin/produkt/usun/([0-9]*)",
    function ($productId) {
        if (!$GLOBALS["isAuth"] || !$GLOBALS["currentUser"]["is_admin"]) {
            require "./views/401.php";
            exit();
        }

        $productsModel = new ProductsModel();
        $productsModel->removeProduct($productId);

        header("Location: /admin");
        exit();
    },
    "post"
);
