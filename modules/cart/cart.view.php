<!DOCTYPE html>
<html lang="pl">
<head>
  <?php require "./layout/head.php"; ?>
  <title>Koszyk - <?php echo $GLOBALS["siteName"]; ?></title>
</head>
<body>
  <?php require "./layout/navbar.php"; ?>
  <div class="container">
    <h3>Koszyk</h3>
    <?php foreach ($products as $product) { ?>
    <div class="card mb-3" style="max-width: 540px;">
      <div class="row g-0">
        <div class="col-md-4">
          <img src=<?php echo $product["image_url"]; ?> class="img-fluid rounded-start" alt="...">
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h5 class="card-title"><?php echo $product["name"]; ?></h5>
            <p class="card-text">Cena: <?php echo $product["price"]; ?> PLN | Suma: <?php echo floatval($product["price"]) * intval($product["quantity_in_cart"]); ?> PLN</p>
            <div>
              <div class="input-group">
                <!-- <label for="product-quantity" class="form-label">Liczba sztuk</label> -->
                <span class="input-group-text" id="basic-addon1">Sztuk: </span>
                <input 
                  class="form-control" 
                  id="product-quantity" 
                  value="<?php echo $product["quantity_in_cart"]; ?>"
                  min="1" 
                  max="<?php echo $product["quantity_on_stock"]; ?>"
                  type="number"
                  required
                >
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
    <div class="card w-50">
      <div class="card-body">
        <h5 class="card-title">Podsumowanie</h5>
        <p class="card-text">Wartość zamówienia: <?php echo $total; ?> PLN</p>
        <p class="card-text">Dostawa: <?php echo $delivery; ?> PLN</p>
        <hr>
        <p class="card-text">Suma: <?php echo $total + $delivery; ?> PLN</p>
        <div class="d-grid gap-2">
          <a href="#" class="btn btn-primary">Przejdź do finalizacji zamówienia</a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>