<!DOCTYPE html>
<html lang="pl">
<head>
  <?php require "./layout/head.php"; ?>
  <title>Edytuj produkt - <?php echo $GLOBALS["siteName"]; ?></title>
</head>
<body>
  <?php require "./layout/navbar.php"; ?>
  <form method="post" action="/admin/produkt/<?php echo $product["id"]; ?>" class="container mt-5">
    <h3>Edytuj produkt: <?php echo $product["name"]; ?></h3>
    <h6>id produktu: <?php echo $product["id"]; ?></h6>
    <div class="mb-3">
      <label for="name" class="form-label">Nazwa</label>
      <input type="text" class="form-control" id="name" name="name" value="<?php echo $product["name"]; ?>" required>
    </div>
    <div class="mb-3">
      <label for="price" class="form-label">Cena</label>
      <input type="number" class="form-control" id="price" name="price" value="<?php echo $product["price"]; ?>" required>
    </div>
    <div class="mb-3">
      <label for="description" class="form-label">Opis</label>
      <input type="text" class="form-control" id="description" name="description" value="<?php echo $product["description"]; ?>">
    </div>
    <div class="mb-3">
      <label for="image_url" class="form-label">Adres obrazka</label>
      <input type="text" class="form-control" id="image_url" name="image_url" value="<?php echo $product["image_url"]; ?>">
    </div>
    <div class="mb-3">
      <label for="quantity" class="form-label">Stan na magazynie</label>
      <input type="number" class="form-control" id="quantity" name="quantity" value="<?php echo $product["quantity"]; ?>" step="1" min="0" required>
    </div>
    
    <input type="text" id="id" value="<?php echo $product["id"]; ?>" name="id" hidden>
    <button class="btn btn-primary">Zapisz</button>
</form>
  <?php require "./layout/footer.php"; ?>
</body>
</html>