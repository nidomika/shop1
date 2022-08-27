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

    require "./views/cart.php";
});

Route::add(
    "/koszyk/dodaj",
    function () {
        if (!$GLOBALS["isAuth"]) {
            require "./views/401.php";
            exit();
        }
        $cartModel = new CartModel();
        $cartModel->addProduct($_POST["productId"], 1);
        header("Location: /koszyk");
    },
    "post"
);

Route::add(
    "/koszyk/usun",
    function () {
        if (!$GLOBALS["isAuth"]) {
            require "./views/401.php";
            exit();
        }
        $cartModel = new CartModel();
        $cartModel->removeProduct($_POST["productId"], 1);
        header("Location: /koszyk");
    },
    "post"
);

Route::add(
    "/koszyk/podsumowanie",
    function () {
        if (!$GLOBALS["isAuth"]) {
            require "./views/401.php";
            exit();
        }
        // $to = "tapoqgkulujbagkrgd@kvhrw.com";
        // $subject = "subject";
        // $message = "message";
        // $headers = "From: webmaster@example.com" . "\r\n" . "X-Mailer: PHP/" . phpversion();

        // mail($to, $subject, $message, $headers);

        require "./views/finalize.php";
    },
    "post"
);
