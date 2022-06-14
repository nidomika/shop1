<?php
require_once "./auth.php";
require_once "./router.php";

get("/", "modules/home/home.controller.php");

get("/rejestracja", "modules/register/register.controller.php");
post("/rejestracja", "modules/register/register.controller.php");

get("/logowanie", "modules/login/login.controller.php");
post("/logowanie", "modules/login/login.controller.php");

get("/wylogowanie", "modules/logout/logout.controller.php");

any("/404", "views/404.php");
