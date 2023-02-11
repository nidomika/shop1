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
    $deliveryCost = $cartModel->deliveryCost;
    $totalWithDelivery = $cartModel->getTotalSumWithDelivery();

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
        $cartModel = new CartModel();
        $products = $cartModel->getAllFromCart();

        $orderNumber = $cartModel->saveOrder();

        $to = $GLOBALS["deliverOrderMail"];
        $subject = "Zamowienie nr " . $orderNumber;
        $message = $cartModel->parseCartToText();
        $headers = "From: sklep@uwushop.com" . "\r\n" . "X-Mailer: PHP/" . phpversion();
        mail($to, $subject, $message, $headers);

        require "./views/finalize.php";
        $cartModel->removeAllFromCart();
    },
    "post"
);
