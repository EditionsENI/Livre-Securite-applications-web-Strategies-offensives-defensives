<nav class="navbar navbar-expand-lg border-bottom border-2 shadow-lg p-0" id="exercice-header">
  <?php
    if(isset($_SESSION['exercice']) && $_SESSION['exercice'] === EXERCICE && isset($_SESSION['username'])) {
  ?>
      <div class="ps-3">
        <a class="text-light fw-bold text-decoration-none" href="home.php">Bienvenue</a>
      </div>
      <div class="collapse navbar-collapse pe-3 justify-content-end">
      <a class="text-light fw-bold ms-2 me-2 ps-1 pe-1 text-decoration-none" href="<?php echo htmlspecialchars('./profile.php?id=' . $_SESSION['id'], ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401); ?>"><?php echo htmlspecialchars(ucfirst($_SESSION['username']), ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401); ?></a>
        <a class="text-light fw-bold ms-2 me-2 ps-1 pe-1 text-decoration-none" href="./logout.php">Se déconnecter</a>
      </div>
  <?php
    }
    else {
  ?>
      <div class="ps-3">
        <a class="text-light fw-bold text-decoration-none" href="index.php">Accueil</a>
      </div>
  <?php
    }
  ?>
</nav>