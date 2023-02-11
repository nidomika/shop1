<?php
require_once "./modules/session/session.model.php";
require_once "./db.php";

if (isset($_COOKIE["session"])) {
    $sessionModel = new SessionModel();
    $user = $sessionModel->getUserBySessionKey($_COOKIE["session"]);
    if ($user) {
        $userSessionKey = $sessionModel->getUserSessionKey($user["id"]);
        if ($userSessionKey["expires_at"] > date("Y-m-d H:i:s")) {
            $GLOBALS["currentUser"] = $user;
        } else {
            $sessionModel->deleteByUserId($user["id"]);
            if ($_SERVER["REQUEST_URI"] != "/logowanie") {
                header("Location: /logowanie");
                exit();
            }
        }
    }
}
$GLOBALS["isAuth"] = isset($GLOBALS["currentUser"]) && $GLOBALS["currentUser"] != false;
