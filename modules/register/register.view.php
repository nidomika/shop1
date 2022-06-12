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
    <form action="/rejestracja" method="POST">
      <div class="mb-3">
        <label for="Imię">Imię</label>
        <input 
          class="<?php $formValidator->renderInputClasses($NAME_INPUT); ?>"
          type="text"
          id="Imię"
          name="<?php echo $NAME_INPUT; ?>"
          placeholder="Imię"
          autocomplete="given-name"
          value="<?php $formValidator->renderValue($NAME_INPUT); ?>"
        >
        <?php $formValidator->renderError($NAME_INPUT); ?>
      </div>
      <div class="mb-3">
        <label for="Nazwisko">Nazwisko</label>
        <input class="<?php $formValidator->renderInputClasses($LAST_NAME_INPUT); ?>"
          type="text"
          id="Nazwisko"
          name="<?php echo $LAST_NAME_INPUT; ?>"
          placeholder="Nazwisko"
          autocomplete="last-name"
        >
        <?php $formValidator->renderError($LAST_NAME_INPUT); ?>
      </div>
      <div class="mb-3">
        <label for="Login">Login</label>
        <input class="<?php $formValidator->renderInputClasses($LOGIN_INPUT); ?>"
          type="text"
          id="Login"
          name="<?php echo $LOGIN_INPUT; ?>"
          placeholder="Login"
          autocomplete="username"
        >
        <?php $formValidator->renderError($LOGIN_INPUT); ?>
      </div>    
      <div class="mb-3">
        <label for="Hasło">Hasło</label>
        <input class="<?php $formValidator->renderInputClasses($PASSWORD_INPUT); ?>"
          type="password"
          id="Hasło"
          name="<?php echo $PASSWORD_INPUT; ?>"
          placeholder="Hasło"
          autocomplete="new-password"
        >
        <?php $formValidator->renderError($PASSWORD_INPUT); ?>
      </div>
      <div class="mb-3">
        <label for="Hasło2">Powtórz hasło</label>
        <input class="<?php $formValidator->renderInputClasses($PASSWORD2_INPUT); ?>"
          type="password"
          id="Hasło2"
          name="<?php echo $PASSWORD2_INPUT; ?>"
          placeholder="Powtórz hasło"
          autocomplete="new-password"
        >
        <?php $formValidator->renderError($PASSWORD2_INPUT); ?>
      </div>
      <div class="mb-3">
        <label for="email">Email</label>
        <input type="text"
          name="<?php echo $EMAIL_INPUT; ?>"
          id="email"
          class="<?php $formValidator->renderInputClasses($EMAIL_INPUT); ?>"
          placeholder="Email"
          autocomplete="email"
        >
        <?php $formValidator->renderError($EMAIL_INPUT); ?>
      </div>    
      <div class="mb-3">
        <label for="Ulica">Ulica</label>
        <input class="<?php $formValidator->renderInputClasses($ADDRESS_INPUT); ?>"
          type="text"
          id="Ulica"
          name="<?php echo $ADDRESS_INPUT; ?>"
          placeholder="Ulica"
          autocomplete="street-address"
        >
        <?php $formValidator->renderError($ADDRESS_INPUT); ?>
      </div>
      <div class="mb-3">
        <label for="Miasto">Miasto</label>
        <input class="<?php $formValidator->renderInputClasses($CITY_INPUT); ?>"
          type="text"
          id="Miasto"
          name="<?php echo $CITY_INPUT; ?>"
          placeholder="Miasto"
          autocomplete="address-level2"
        >
        <?php $formValidator->renderError($CITY_INPUT); ?>
      </div>
      <div class="mb-3">
        <label for="Kod pocztowy">Kod pocztowy</label>
        <input class="<?php $formValidator->renderInputClasses($ZIP_CODE_INPUT); ?>"
          type="text"
          id="Kod pocztowy"
          name="<?php echo $ZIP_CODE_INPUT; ?>"
          placeholder="XX-XXX"
          autocomplete="postal-code"
        >
        <?php $formValidator->renderError($ZIP_CODE_INPUT); ?>
      </div>
      <div class="mb-3">
        <label for="Kraj">Kraj</label>
        <input class="<?php $formValidator->renderInputClasses($COUNTRY_INPUT); ?>"
          type="text"
          id="Kraj"
          name="<?php echo $COUNTRY_INPUT; ?>"
          placeholder="Kraj"
          autocomplete="country-name"
        >
        <?php $formValidator->renderError($COUNTRY_INPUT); ?>
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