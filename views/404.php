<!DOCTYPE html>
<html lang="pl">
<head></head>
  <?php require "./layout/head.php"; ?>
  <?php require "./layout/navbar.php"; ?>
  <title>Nie znaleziono strony - <?php echo $GLOBALS["siteName"]; ?></title>
</head>
<body>
  <div class="container mt-5">
    <div class="text-center">
    <h3>Nie znaleziono strony</h3>
      <img src="https://http.cat/404" class="rounded img-fluid mt-5"/>
      <br>
      <div class="d-grid gap-2 col-7 mx-auto mt-5">
        <a class="btn btn-primary" href="/">Wróć do strony głównej</a>
      </div>
    </div>
  </div>
</body>
</html>