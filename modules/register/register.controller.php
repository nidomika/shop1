<?php
Route::add(
    "/rejestracja",
    function () {
        if ($GLOBALS["isAuth"]) {
            header("Location: /");
            exit();
        }

        require_once "./utils/FormValidator.php";
        require_once "./modules/register/register.model.php";

        $NAME_INPUT = "name";
        $LAST_NAME_INPUT = "last_name";
        $ADDRESS_INPUT = "address";
        $CITY_INPUT = "city";
        $ZIP_CODE_INPUT = "zip_code";
        $COUNTRY_INPUT = "country";
        $LOGIN_INPUT = "login";
        $PASSWORD_INPUT = "password";
        $PASSWORD2_INPUT = "password2";
        $EMAIL_INPUT = "email";
        $EDUCATION_INPUT = "education";
        $HOBBIES_INPUT = "hobbies";

        $formValidator = new FormValidator();
        $registerModel = new RegisterModel();

        $formValidator->addInput($LOGIN_INPUT, function ($value, &$errors) use ($registerModel) {
            if (!formValidator::checkLength($value, 5, 30)) {
                $errors[] = "Login powinien mieć między 5 a 30 znaków";
            }

            // Check login uniqueness
            $user = $registerModel->checkIfUserExists($value);
            if ($user != false) {
                $errors[] = "Użytkownik z takim loginem już istnieje";
            }
        });

        $formValidator->addInput($EMAIL_INPUT, function ($value, &$errors) {
            if (!formValidator::checkLength($value, 3, 255)) {
                $errors[] = "Email powinien mieć między 3 a 255 znaków";
            } elseif (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Email składa się z niepoprawnych znaków";
            }
        });

        $formValidator->addInput($NAME_INPUT, function ($value, &$errors) {
            if (!formValidator::checkLength($value, 2, 30)) {
                $errors[] = "Imię powinno mieć między 2 a 30 znaków";
            }
        });

        $formValidator->addInput($LAST_NAME_INPUT, function ($value, &$errors) {
            if (!formValidator::checkLength($value, 2, 40)) {
                $errors[] = "Nazwisko powinno mieć między 2 a 40 znaków";
            }
        });

        $formValidator->addInput($PASSWORD_INPUT, function ($value, &$errors) {
            if (!formValidator::checkLength($value, 8, 255)) {
                $errors[] = "Hasło musi mieć między 8 a 128 znaków";
            }

            $charsIncludeErrors = [];
            if (!preg_match("@[A-Z]@", $value)) {
                $charsIncludeErrors[] = "jedną wielką literę";
            }
            if (!preg_match("@[a-z]@", $value)) {
                $charsIncludeErrors[] = "jedną małą literę";
            }
            if (!preg_match("@[0-9]@", $value)) {
                $charsIncludeErrors[] = "jedną cyfrę";
            }
            if (!preg_match("@[^\w]@", $value)) {
                $charsIncludeErrors[] = "jeden znak specjalny";
            }

            if (sizeof($charsIncludeErrors) > 0) {
                $errors[] = "Hasło musi zawierać co najmniej " . implode(", ", $charsIncludeErrors);
            }
        });

        $formValidator->addInput($PASSWORD2_INPUT, function ($value, &$errors) use ($PASSWORD_INPUT) {
            if ($value !== $_POST[$PASSWORD_INPUT]) {
                $errors[] = "Hasła nie są jednakowe";
            }
        });

        $formValidator->addInput($ADDRESS_INPUT, function ($value, &$errors) {
            if (!formValidator::checkLength($value, 3, 60)) {
                $errors[] = "Adres powinien mieć mieć między 3 a 60 znaków";
            }
        });

        $formValidator->addInput($CITY_INPUT, function ($value, &$errors) {
            if (!formValidator::checkLength($value, 2, 40)) {
                $errors[] = "Nazwa miasta powinna mieć między 2 a 40 znaków";
            }
        });

        $formValidator->addInput($ZIP_CODE_INPUT, function ($value, &$errors) {
            if (!preg_match("@^\d\d-\d\d\d$@", $value)) {
                $errors[] = "Kod pocztowy powinien być w formacie XX-XXX";
            }
        });

        $formValidator->addInput($COUNTRY_INPUT, function ($value, &$errors) {
            if (!formValidator::checkLength($value, 2, 40)) {
                $errors[] = "Nazwa kraju powinna mieć między 2 a 40 znaków";
            }
        });

        if ($_SERVER["REQUEST_METHOD"] === "POST" && $formValidator->success()) {
            $registerModel->saveUser(
                [
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
                ],
                $_POST[$HOBBIES_INPUT]
            );
            header("Location: /");
            exit();
        } else {
            include "register.view.php";
        }
    },
    ["get", "post"]
);
