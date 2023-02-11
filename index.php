<?php
require_once "./config.php";
require_once "./auth.php";
require_once "./router.php";
require_once "./modules/cart/cart.controller.php";
require_once "./modules/home/home.controller.php";
require_once "./modules/login/login.controller.php";
require_once "./modules/logout/logout.controller.php";
require_once "./modules/register/register.controller.php";
require_once "./modules/admin/admin.controller.php";
require_once "./modules/orders/orders.controller.php";

Route::pathNotFound(function ($path) {
    include "views/404.php";
});

Route::run("/");
