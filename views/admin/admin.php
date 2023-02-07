<!DOCTYPE html>
<html lang="pl">
<head>
  <?php require "./layout/head.php"; ?>
  <title>Panel administratora - <?php echo $GLOBALS["siteName"]; ?></title>
</head>
<body>
  <?php require "./layout/navbar.php"; ?>
  <div class="container mt-5">
    <h3>Panel administratora</h3>
    <div class="row row-cols-1 row-cols-md-3 g-4">
    <?php foreach ($products as $product) { ?>
      <div class="col">
        <div class="card">
          <img src=<?php echo $product["image_url"]; ?> class="card-img-top" width="300" height="300" alt="...">
          <div class="card-body">
            <h5 class="card-title"><?php echo $product["name"]; ?></h5>
            <p><?php echo $product["price"]; ?> PLN</p>
            <p class="card-text"><?php echo $product["description"]; ?></p>
            <p class="card-text">Stan na magazynie: <?php echo $product["quantity"]; ?></p>
            <a href="/admin/product/<?php echo $product["id"]; ?>">Edytuj</a>
          </div>
        </div>
      </div>
    <?php } ?>
    </div>
  </div>
  <?php require "./layout/footer.php"; ?>
</body>
</html>