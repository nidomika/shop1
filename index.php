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

Route::pathNotFound(function ($path) {
    include "views/404.php";
});

// get("/", "modules/home/home.controller.php");

// get("/rejestracja", "modules/register/register.controller.php");
// post("/rejestracja", "modules/register/register.controller.php");

// get("/logowanie", "modules/login/login.controller.php");
// post("/logowanie", "modules/login/login.controller.php");

// get("/koszyk", "modules/cart/cart.controller.php");

// get("/wylogowanie", "modules/logout/logout.controller.php");

// any("/404", "views/404.php");
Route::run("/");
