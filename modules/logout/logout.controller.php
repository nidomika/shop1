<?php
if (!$GLOBALS["isAuth"]) {
    header("Location: /");
    exit();
}

require_once "./modules/session/session.model.php";

$sessionModel = new SessionModel();
$sessionModel->delete($_COOKIE["session"]);

setcookie("session", null, -1);
header("Location: /");
exit();
