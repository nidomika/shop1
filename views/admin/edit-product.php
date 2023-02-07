<!DOCTYPE html>
<html lang="pl">
<head>
  <?php require "./layout/head.php"; ?>
  <title>Edytuj produkt - <?php echo $GLOBALS["siteName"]; ?></title>
</head>
<body>
  <?php require "./layout/navbar.php"; ?>
  <div class="container mt-5">
    <div class="mb-3">
      <label for="name" class="form-label">Nazwa</label>
      <input type="text" class="form-control" id="name">
    </div>
    <div class="mb-3">
      <label for="price" class="form-label">Cena</label>
      <input type="text" class="form-control" id="price">
    </div>
    <div class="mb-3">
      <label for="description" class="form-label">Opis</label>
      <input type="text" class="form-control" id="description">
    </div>
    <div class="mb-3">
      <label for="image_url" class="form-label">Adres obrazka</label>
      <input type="text" class="form-control" id="image_url">
    </div>
    <div class="mb-3">
      <label for="quantity" class="form-label">Stan na magazynie</label>
      <input type="text" class="form-control" id="quantity">
    </div>
  </div>
  <?php require "./layout/footer.php"; ?>
</body>
</html>