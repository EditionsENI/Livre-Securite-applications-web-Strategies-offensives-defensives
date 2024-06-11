<nav class="navbar navbar-expand-lg border-bottom border-2 shadow-lg p-0" id="exercice-header">
  <?php
    if(isset($_SESSION['exercice']) && $_SESSION['exercice'] === EXERCICE && isset($_SESSION['username'])) {
  ?>
      <div class="ps-3">
        <a class="text-light fw-bold text-decoration-none" href="<?php echo htmlspecialchars("home.php?lang=" . $lang, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401); ?>"><?php echo isset($lang) && $lang === "fr" ? "Bienvenue" : "Home"; ?></a>
      </div>
      <div class="collapse navbar-collapse pe-3 justify-content-end">
        <a class="text-light fw-bold ms-2 me-2 ps-1 pe-1 text-decoration-none" href="<?php echo htmlspecialchars("profile.php?lang=" . $lang, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401); ?>"><?php echo htmlspecialchars(ucfirst($_SESSION['username']), ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401); ?></a>
        <a class="text-light fw-bold ms-2 me-2 ps-1 pe-1 text-decoration-none" href="<?php echo htmlspecialchars("logout.php?lang=" . $lang, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401); ?>"><?php echo isset($lang) && $lang === "fr" ? "Se déconnecter" : "Logout"; ?></a>
      </div>
  <?php
    }
    else {
  ?>
      <div class="ps-3">
        <a class="text-light fw-bold text-decoration-none" href="<?php echo htmlspecialchars("index.php?lang=" . $lang, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401); ?>"><?php echo isset($lang) && $lang === "fr" ? "Accueil" : "Welcome"; ?></a>
      </div>
  <?php
    }
  ?>
</nav>