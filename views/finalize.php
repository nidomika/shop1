<!DOCTYPE html>
<html lang="pl">
<head></head>
  <?php require "./layout/head.php"; ?>
  <?php require "./layout/navbar.php"; ?>
  <title>Podsumowanie - <?php echo $GLOBALS["siteName"]; ?></title>
</head>
<body>
  <div class="container mt-5">
    <div class="text-center">
      <h3>Dziękujemy za zakupy w <?php echo $GLOBALS["siteName"]; ?>!</h3>
      Zamówienie nr <?php echo $orderNumber; ?> zostało przesłane do naszego sklepu.
      <?php foreach ($products as $product) { ?>
      <div class="card mb-3">
          <div class="row g-0">
            <div class="col-md-4">
              <img src=<?php echo $product["image_url"]; ?> class="img-fluid rounded-start" width="300" height="300" alt="...">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title"><?php echo $product["name"]; ?> </h5>
                <br>
                <p class="card-text">Cena: <?php echo $product["price"]; ?> PLN </p>
                <p class="card-text">Suma: <?php echo floatval($product["price"]) * intval($product["quantity_in_cart"]); ?> PLN</p>
                <p class="card-text">Sztuk: <?php echo $product["quantity_in_cart"]; ?></p>
              </div>
            </div>
        </div>
      </div>
      <?php } ?>
      <div class="d-grid gap-2 col-7 mx-auto mt-5">
        <a class="btn btn-primary" href="/">Wróć do strony głównej</a>
      </div>
    </div>
  </div>
</body>
</html>