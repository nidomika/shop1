<?php
require_once "./db.php";
// var_dump($_POST);
$stmt = $db->prepare("INSERT INTO `users` (`name`, `last_name`, `email`, `login`, `password`, `address`, `city`, `zip_code`, `country`, `education`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->execute([
    $_POST[$NAME_INPUT],
    $_POST[$LAST_NAME_INPUT],
    $_POST[$EMAIL_INPUT],
    $_POST[$LOGIN_INPUT],
    $_POST[$PASSWORD_INPUT],
    $_POST[$ADDRESS_INPUT],
    $_POST[$CITY_INPUT],
    $_POST[$ZIP_CODE_INPUT],
    $_POST[$COUNTRY_INPUT],
    $_POST[$EDUCATION_INPUT],
]);

if (isset($_POST[$HOBBIES_INPUT])) {
    $id = $db->lastInsertId();
    $stmt = $db->prepare("INSERT INTO `hobbies` (`user_id`, `hobby`) VALUES (?, ?)");

    foreach ($_POST[$HOBBIES_INPUT] as $hobby) {
        $stmt->execute([$id, $hobby]);
    }
}
