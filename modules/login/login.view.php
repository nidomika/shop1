<!DOCTYPE html>
<html lang="pl">
<head></head>
  <?php require "./layout/head.php"; ?>
  <title>Logowanie</title>
</head>
<body>
  <div class="container">
    <br>
    <h1 class="mt-8 mb-3">Logowanie</h1>
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
  </div>
</body>
</html>