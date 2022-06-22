<?php
Route::add(
    "/logowanie",
    function () {
        if ($GLOBALS["isAuth"]) {
            header("Location: /");
            exit();
        }

        require_once "./modules/session/session.model.php";
        require_once "./modules/login/login.model.php";

        $LOGIN_INPUT = "login";
        $PASSWORD_INPUT = "password";

        $loginModel = new LoginModel();
        $sessionModel = new SessionModel();
        $loginError = false;

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $userId = $loginModel->getUserIdByUsernameAndPassword($_POST[$LOGIN_INPUT], $_POST[$PASSWORD_INPUT]);
            if ($userId != false) {
                $sessionKey = $sessionModel->create($userId);
                setcookie("session", $sessionKey);
                header("Location: /");
                exit();
            }
            $loginError = true;
            include "login.view.php";
        } else {
            include "login.view.php";
        }
    },
    ["get", "post"]
);
