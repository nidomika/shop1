<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">uwushop</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <?php if ($GLOBALS["isAuth"]) {
              echo "Hej, " . $GLOBALS["currentUser"]["name"] . "! 🍟";
          } ?>
        </li>
      </ul>
      <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <?php if ($GLOBALS["isAuth"]) { ?>
          <a class="btn btn-outline-success" href="/koszyk">Koszyk</a>
          <a class="btn btn-outline-success" href="/wylogowanie">Wyloguj</a>
        <?php } else { ?>
          <a class="btn btn-outline-success" href="/logowanie">Zaloguj</a>        
        <?php } ?>
      </div>
    </div>
  </div>
</nav>