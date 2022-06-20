<?php
if (!$GLOBALS["isAuth"]) {
    require "./views/401.php";
    exit();
}
