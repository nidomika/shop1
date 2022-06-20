<!DOCTYPE html>
<html lang="pl">
<head></head>
  <?php require "./layout/head.php"; ?>
  <title>Logowanie - <?php echo $GLOBALS["siteName"]; ?></title>
</head>
<body>
  <?php require "./layout/navbar.php"; ?>
  <div class="container">
    <h1 class="mt-5 mb-3">Logowanie</h1>
    <form action="/logowanie" method="POST">
      <div class="mb-3">
        <label for="Login">Login</label>
        <input 
          type="text"
          id="Login"
          name="<?php echo $LOGIN_INPUT; ?>"
          placeholder="Login"
          autocomplete="username"
          class="form-control"
          autofocus
        >
      </div>    
      <div class="mb-3">
        <label for="Hasło">Hasło</label>
        <input
          type="password"
          id="Hasło"
          name="<?php echo $PASSWORD_INPUT; ?>"
          placeholder="Hasło"
          autocomplete="new-password"
          class="form-control"
        >
      </div>
        <?php if ($loginError) { ?>
          <div class="alert alert-danger" role="alert">
            Nieprawidłowe dane logowania
          </div>
        <?php } ?>
      <button class="btn btn-primary">Zaloguj</button>
    </form>
    <p class="mt-5">Nie masz konta?</p>
    <a class="btn btn-outline-primary" href="/rejestracja">Zarejestruj się</a>
  </div>
</body>
</html>