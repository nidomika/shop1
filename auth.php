<?php
require_once "./modules/session/session.model.php";
require_once "./db.php";

if (isset($_COOKIE["session"])) {
    $sessionModel = new SessionModel();
    $GLOBALS["currentUser"] = $sessionModel->getUserBySessionKey($_COOKIE["session"]);
}
$GLOBALS["isAuth"] = isset($GLOBALS["currentUser"]) && $GLOBALS["currentUser"] != false;
