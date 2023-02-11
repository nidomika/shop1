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
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Zamówienie nr <?php echo $order["order_no"]; ?></h5>
          <p class="card-text">Wartość: <?php echo $order["total"]; ?> PLN</p>
          <p class="card-text">Data złożenia zamówienia: <?php echo $order["date_ordered"]; ?></p>
          <p class="card-text">Zakończone: <?php echo $order["completed"] ? "Tak" : "Nie"; ?></p>
          <a class="btn btn-primary" href="/zamowienia/<?php echo $order["order_no"]; ?>">Szczegóły</a>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
</body>
</html>