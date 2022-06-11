<?php
require_once "./db.php";
require_once "./utils/Validator.php";

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

$validator = new Validator();

$validator->addInput($LOGIN_INPUT, function ($value, &$errors) use ($db) {
    if (!Validator::checkLength($value, 5, 30)) {
        $errors[] = "Login powinien mieć między 5 a 30 znaków";
    }

    // Check login uniqueness
    $stmt = $db->prepare("SELECT login FROM users WHERE login = ?");
    $stmt->execute([$value]);
    $user = $stmt->fetch();
    if ($user != false) {
        $errors[] = "Użytkownik z takim loginem już istnieje";
    }
});

$validator->addInput($EMAIL_INPUT, function ($value, &$errors) {
    if (!Validator::checkLength($value, 3, 255)) {
        $errors[] = "Email powinien mieć między 3 a 255 znaków";
    } elseif (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email składa się z niepoprawnych znaków";
    }
});

$validator->addInput($NAME_INPUT, function ($value, &$errors) {
    if (!Validator::checkLength($value, 2, 30)) {
        $errors[] = "Imię powinno mieć między 2 a 30 znaków";
    }
});

$validator->addInput($LAST_NAME_INPUT, function ($value, &$errors) {
    if (!Validator::checkLength($value, 2, 40)) {
        $errors[] = "Nazwisko powinno mieć między 2 a 40 znaków";
    }
});

$validator->addInput($PASSWORD_INPUT, function ($value, &$errors) {
    if (!Validator::checkLength($value, 8, 255)) {
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

$validator->addInput($PASSWORD2_INPUT, function ($value, &$errors) use ($PASSWORD_INPUT) {
    if ($value !== $_POST[$PASSWORD_INPUT]) {
        $errors[] = "Hasła nie są jednakowe";
    }
});

$validator->addInput($ADDRESS_INPUT, function ($value, &$errors) {
    if (!Validator::checkLength($value, 3, 60)) {
        $errors[] = "Adres powinien mieć mieć między 3 a 60 znaków";
    }
});

$validator->addInput($CITY_INPUT, function ($value, &$errors) {
    if (!Validator::checkLength($value, 2, 40)) {
        $errors[] = "Nazwa miasta powinna mieć między 2 a 40 znaków";
    }
});

$validator->addInput($ZIP_CODE_INPUT, function ($value, &$errors) {
    if (!preg_match("@^\d\d-\d\d\d$@", $value)) {
        $errors[] = "Kod pocztowy powinien być w formacie XX-XXX";
    }
});

$validator->addInput($COUNTRY_INPUT, function ($value, &$errors) {
    if (!Validator::checkLength($value, 2, 40)) {
        $errors[] = "Nazwa kraju powinna mieć między 2 a 40 znaków";
    }
});
?>

<!DOCTYPE html>
<html lang="pl">
<head></head>
  <?php require "./layout/head.php"; ?>
  <title>Rejestracja użytkownika</title>
</head>
<body>
  <div class="container">
    <br>
    <h1 class="mt-8 mb-3">Rejestracja</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
      <div class="mb-3">
        <label for="Imię">Imię</label>
        <input class="<?php $validator->renderInputClasses($NAME_INPUT); ?>" type="text" id="Imię" name="<?php echo $NAME_INPUT; ?>" placeholder="Imię" autocomplete="given-name">
        <?php $validator->renderError($NAME_INPUT); ?>
      </div>
      <div class="mb-3">
        <label for="Nazwisko">Nazwisko</label>
        <input class="<?php $validator->renderInputClasses($LAST_NAME_INPUT); ?>" type="text" id="Nazwisko" name="<?php echo $LAST_NAME_INPUT; ?>" placeholder="Nazwisko" autocomplete="last-name">
        <?php $validator->renderError($LAST_NAME_INPUT); ?>
      </div>
      <div class="mb-3">
        <label for="Login">Login</label>
        <input class="<?php $validator->renderInputClasses($LOGIN_INPUT); ?>" type="text" id="Login" name="<?php echo $LOGIN_INPUT; ?>" placeholder="Login" autocomplete="username">
        <?php $validator->renderError($LOGIN_INPUT); ?>
      </div>    
      <div class="mb-3">
        <label for="Hasło">Hasło</label>
        <input class="<?php $validator->renderInputClasses($PASSWORD_INPUT); ?>" type="password" id="Hasło" name="<?php echo $PASSWORD_INPUT; ?>" placeholder="Hasło" autocomplete="new-password">
        <?php $validator->renderError($PASSWORD_INPUT); ?>
      </div>
      <div class="mb-3">
        <label for="Hasło2">Powtórz hasło</label>
        <input class="<?php $validator->renderInputClasses(
            $PASSWORD2_INPUT
        ); ?>" type="password" id="Hasło2" name="<?php echo $PASSWORD2_INPUT; ?>" placeholder="Powtórz hasło" autocomplete="new-password">
        <?php $validator->renderError($PASSWORD2_INPUT); ?>
      </div>
      <div class="mb-3">
        <label for="email">Email</label>
        <input type="text" name="<?php echo $EMAIL_INPUT; ?>" id="email" class="<?php $validator->renderInputClasses($EMAIL_INPUT); ?>" placeholder="Email" autocomplete="email">
        <?php $validator->renderError($EMAIL_INPUT); ?>
      </div>    
      <div class="mb-3">
        <label for="Ulica">Ulica</label>
        <input class="<?php $validator->renderInputClasses($ADDRESS_INPUT); ?>" type="text" id="Ulica" name="<?php echo $ADDRESS_INPUT; ?>" placeholder="Ulica" autocomplete="street-address">
        <?php $validator->renderError($ADDRESS_INPUT); ?>
      </div>
      <div class="mb-3">
        <label for="Miasto">Miasto</label>
        <input class="<?php $validator->renderInputClasses($CITY_INPUT); ?>" type="text" id="Miasto" name="<?php echo $CITY_INPUT; ?>" placeholder="Miasto" autocomplete="address-level2">
        <?php $validator->renderError($CITY_INPUT); ?>
      </div>
      <div class="mb-3">
        <label for="Kod pocztowy">Kod pocztowy</label>
        <input class="<?php $validator->renderInputClasses($ZIP_CODE_INPUT); ?>" type="text" id="Kod pocztowy" name="<?php echo $ZIP_CODE_INPUT; ?>" placeholder="XX-XXX" autocomplete="postal-code">
        <?php $validator->renderError($ZIP_CODE_INPUT); ?>
      </div>
      <div class="mb-3">
        <label for="Kraj">Kraj</label>
        <input class="<?php $validator->renderInputClasses($COUNTRY_INPUT); ?>" type="text" id="Kraj" name="<?php echo $COUNTRY_INPUT; ?>" placeholder="Kraj" autocomplete="country-name">
        <?php $validator->renderError($COUNTRY_INPUT); ?>
      </div>

      <div class="mb-3">
        <label class="form-label" for="education">Wykształcenie</label>
        <select class="form-select" id="education" name="<?php echo $EDUCATION_INPUT; ?>">
          <option>Podstawowe</option>
          <option>Średnie</option>
          <option>Wyższe</option>
        </select>
      </div>

      <div class="mb-3">
        <div class="form-label">Zainteresowania</div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="psy"  name="<?php echo $HOBBIES_INPUT; ?>[]" id="dogs-checkbox">
          <label class="form-check-label" for="dogs-checkbox">Psy</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="koty" name="<?php echo $HOBBIES_INPUT; ?>[]" id="cats-checkbox">
          <label class="form-check-label" for="cats-checkbox">Koty</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="papugi" name="<?php echo $HOBBIES_INPUT; ?>[]" id="parrots-checkbox">
          <label class="form-check-label" for="parrots-checkbox">Papugi</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="żółwie" name="<?php echo $HOBBIES_INPUT; ?>[]" id="turtles-checkbox">
          <label class="form-check-label" for="turtles-checkbox">Żółwie</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="chomiki" name="<?php echo $HOBBIES_INPUT; ?>[]" id="hamsters-checkbox">
          <label class="form-check-label" for="hamsters-checkbox">Chomiki</label>
        </div>
      </div>

      <button class="btn btn-primary">Zarejestruj</button>
    </form>
  </div>

  <?php require "./layout/footer.php"; ?>
</body>
</html>