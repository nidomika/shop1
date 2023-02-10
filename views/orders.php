<!DOCTYPE html>
<html lang="pl">
<head></head>
  <?php require "./layout/head.php"; ?>
  <?php require "./layout/navbar.php"; ?>
  <title>Zamówienia - <?php echo $GLOBALS["siteName"]; ?></title>
</head>
<body>
  <div class="container mt-5">
    <h1>Zamówienia</h1>
     <div class="row">
    <?php foreach ($orders as $order) { ?>
      <div class="card py-2">
            <h5 class="card-title">Zamówienie nr <?php echo $order["order_no"]; ?></h5>
            <p class="card-text">Zamawiający: <?php echo $order["user_id"]; ?></p>
            <p class="card-text">Wartość: <?php echo $order["total"]; ?></p>
            <p class="card-text">Data złożenia zamówienia: <?php echo $order["date"]; ?></p>
            <a class="btn btn-primary" href="/zamowienia/<?php echo $order["order_no"]; ?>">Szczegóły</a>
          </div>
        </div>
      </div>
    <?php } ?>
    </div>
  </div>
</body>
</html>