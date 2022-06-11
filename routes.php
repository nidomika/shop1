<?php
require_once "{$_SERVER["DOCUMENT_ROOT"]}/router.php";

get("/", "index.php");

get("/rejestracja", "./register/register.controller.php");
post("/rejestracja", "./register/register.controller.php");

any("/404", "views/404.php");
