<!DOCTYPE html>
<html lang="pl">
<head>
  <?php require "./layout/head.php"; ?>
  <title>Dodaj produkt - <?php echo $GLOBALS["siteName"]; ?></title>
</head>
<body>
  <?php require "./layout/navbar.php"; ?>
  <form method="post" action="/admin/produkt/dodaj" class="container mt-5">
    <h3>Dodaj produkt</h3>
    <div class="mb-3">
      <label for="name" class="form-label">Nazwa</label>
      <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="mb-3">
      <label for="price" class="form-label">Cena</label>
      <input type="number" class="form-control" id="price" name="price" step="0.01" required>
    </div>
    <div class="mb-3">
      <label for="description" class="form-label">Opis</label>
      <input type="text" class="form-control" id="description" name="description">
    </div>
    <div class="mb-3">
      <label for="image_url" class="form-label">Adres obrazka</label>
      <input type="text" class="form-control" id="image_url" name="image_url">
    </div>
    <div class="mb-3">
      <label for="quantity" class="form-label">Stan na magazynie</label>
      <input type="number" class="form-control" id="quantity" name="quantity" step="1" min="0" required>
    </div>
    <button class="btn btn-primary">Zapisz</button>
</form>
  <?php require "./layout/footer.php"; ?>
</body>
</html>