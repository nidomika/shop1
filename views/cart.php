<!DOCTYPE html>
<html lang="pl">
<head>
  <?php require "./layout/head.php"; ?>
  <title>Koszyk - <?php echo $GLOBALS["siteName"]; ?></title>
</head>
<body>
  <?php require "./layout/navbar.php"; ?>
  <div class="container mt-5">
    <h3>Koszyk</h3>
    <div class="row justify-content-between">
      <div class="col-8">
        <?php if (count($products) == 0) { ?>
          <p class="lead">Twój koszyk jest pusty!</p>
          <br>
          <a href="/" class="btn btn-primary">Przejdź do strony głównej</a>
        <?php } else {foreach ($products as $product) { ?>
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
                <form action="/koszyk/usun" method="post">
                  <input type="hidden" name="productId" value="<?php echo $product["product_id"]; ?>">
                  <button class="btn btn-danger">Usuń produkt</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
        <div class="col">
          <div class="card mb-3">
            <div class="card-body">
              <h4>Dane do wysyłki: </h4>
              <ul class="list-group">
                <li class="list-group-item"><b>Imię i nazwisko: </b> <?php echo $GLOBALS["currentUser"]["name"] . " " . $GLOBALS["currentUser"]["last_name"]; ?></li>
                <li class="list-group-item"><b>Adres: </b> <?php echo $GLOBALS["currentUser"]["address"]; ?></li>
                <li class="list-group-item"><b>Kod pocztowy i miasto: </b> <?php echo $GLOBALS["currentUser"]["zip_code"] . " " . $GLOBALS["currentUser"]["city"]; ?></li>
                <li class="list-group-item"><b>Adres email: </b> <?php echo $GLOBALS["currentUser"]["email"]; ?></li>
              </ul>
            </div>
          </div>
          <div class="card mb-3">
            <div class="card-body">
              <h5 class="card-title">Podsumowanie</h5>
              <p class="card-text">Wartość zamówienia: <?php echo $total; ?> PLN</p>
              <p class="card-text">Dostawa: <?php echo $delivery; ?> PLN</p>
              <hr>
              <p class="card-text">Suma: <?php echo $total + $delivery; ?> PLN</p>
              <form method="post" action="/koszyk/podsumowanie">
                <input type="hidden" name="productsInCart" value="<?php $products; ?>">
                <div class="d-grid gap-2">
                  <button class="btn btn-primary">Zamów</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <?php } ?>
    </div>
  </div>
</body>
</html>