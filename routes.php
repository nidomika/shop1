<?php
require_once "{$_SERVER["DOCUMENT_ROOT"]}/router.php";

get("/rejestracja", "modules/register/register.controller.php");
post("/rejestracja", "modules/register/register.controller.php");

any("/404", "views/404.php");
