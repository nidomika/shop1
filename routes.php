<?php
require_once "{$_SERVER["DOCUMENT_ROOT"]}/router.php";

get("/", "views/index.php");

get("/rejestracja", "modules/register/register.controller.php");
post("/rejestracja", "modules/register/register.controller.php");

get("/logowanie", "modules/login/login.controller.php");
post("/logowanie", "modules/login/login.controller.php");

any("/404", "views/404.php");
