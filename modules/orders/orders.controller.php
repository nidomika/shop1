<?php
require_once "./modules/orders/orders.model.php";

Route::add(
    "/zamowienia",
    function () {
        if (!$GLOBALS["isAuth"] || !$GLOBALS["currentUser"]["is_admin"]) {
            require "./views/401.php";
            exit();
        }

        $ordersModel = new OrdersModel();
        $orders = $ordersModel->getAllOrders();

        require "./views/orders.php";
    },
    "get"
);

Route::add(
    "/zamowienia/([0-9]*)",
    function ($orderNo) {
        if (!$GLOBALS["isAuth"] || !$GLOBALS["currentUser"]["is_admin"]) {
            require "./views/401.php";
            exit();
        }

        $ordersModel = new OrdersModel();
        $orders = $ordersModel->getOrderByNo($orderNo);

        require "./views/orders.php";
    },
    "get"
);
