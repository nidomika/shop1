<!DOCTYPE html>
<html lang="pl">
<head></head>
  <?php require "./layout/head.php"; ?>
  <?php require "./layout/navbar.php"; ?>
  <title>Zamówienia - <?php echo $GLOBALS["siteName"]; ?></title>
</head>
<body>
  <div class="container mt-5">
    <div class="card">
      <div class="card-body">
      <h3 class="card-title">Zamówienie nr <?php echo $order["order_no"]; ?></h3>
      <p class="card-text"><strong>Data złożenia zamówienia: </strong><?php echo $order["date_ordered"]; ?></p>
      <p class="card-text"><strong>Wartość: </strong><?php echo $order["total"]; ?> PLN</p>  
      <p class="card-text"><strong>Dane do wysyłki: </strong></p>
      <ul class="list-unstyled">
        <li class="card-text"><?php echo $order["name"] . " " . $order["last_name"]; ?></li>
        <li class="card-text"><?php echo $order["address"]; ?></li>
        <li class="card-text"><?php echo $order["zip_code"] . " " . $order["city"]; ?></li>
        <li class="card-text"><?php echo $order["country"]; ?></li>
      </ul>
      <div class="card-header">Produkty</div>
      <table class="table table-striped">
          <thead>
          <tr>
            <th scope="col">Lp.</th>
            <th scope="col">Produkt</th>
            <th scope="col">Liczba</th>
            <th scope="col">Cena</th>
            <th scope="col">Wartość</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i = 1;
          foreach ($products as $product) { ?>
            <tr>
              <td>
                <?php echo $i++; ?>
              </td>
              <td>
                <?php echo $product["name"]; ?>
              </td>
              <td>
                <?php echo $product["quantity"]; ?>
              </td>
              <td>
                <?php echo $product["price"]; ?> PLN
              </td>
              <td>
                <?php echo $product["quantity"] * $product["price"]; ?> PLN
              </td>
            </tr> 
            <?php }
          ?>
        </tbody>
      </table>     
    </div>
  </div>
    <div class="d-flex gap-2 mt-2 justify-content-end">
      <?php if (!$order["completed"]) { ?>
        <form method="post" action="/zamowienia/<?php echo $order["order_no"]; ?>/zakoncz" >
          <button class="btn btn-primary">Zakończ zamówienie</button>
        </form>
        <?php } ?>
        <a class="btn btn-primary" href="/zamowienia">Powrót do listy</a>
    </div>
</body>
</html>