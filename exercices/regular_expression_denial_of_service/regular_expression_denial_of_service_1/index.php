<?php
  define('WEP_APP_PAGE_TO_ROOT', './../../../' );
  include_once __DIR__ . '/config/const.php';
  ini_set('session.cookie_httponly', '1');
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo htmlspecialchars(TITLE, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401); ?></title>
    <link href="../../../styles/bootstrap.min.css" rel="stylesheet">
    <link href="../../../styles/platform_styles.css" rel="stylesheet">
    <link href="../../../styles/exercice_styles.css" rel="stylesheet">
  </head>
  <body>
    <?php
      include WEP_APP_PAGE_TO_ROOT . "inc/navbar.inc.php";
    ?>
    <div class="container-fluid ps-0">
      <div class="row">
        <div class="col-2">
          <div>
            <?php
              include WEP_APP_PAGE_TO_ROOT . "inc/nav.inc.php";
            ?>
          </div>
        </div>
        <div class="col">
          <div class="bg-light m-4 border exercice">
            <div class="row loginForm">
              <div class="d-flex align-items-center">
                <div class="col">
                </div>
                <div class="col">
                  <div class="bg-white p-3 border border-secondary rounded">
                    <form method="POST" action="./home.php">
                      <div class="mb-3">
                        <label for="username" class="form-label fw-bold text-dark">Nom d'utilisateur :</label>
                        <input type="text" class="form-control" id="username" name="username">
                      </div>  
                      <div class="mb-3">
                        <label for="password" class="form-label fw-bold text-dark">Mot de passe :</label>
                        <input type="password" class="form-control" id="password" name="password">
                      </div>
                      <div class="d-grid">
                        <button type="submit" name="login" class="btn btn-dark text-light">S'authentifier</button>
                      </div>
                    </form>
                    <div class="text-center pt-2">
                        <a href="signup.php">Pas encore de compte ?</a>
                    </div>
                  </div>
                  <div class="error-div">
                    <?php
                      include_once __DIR__ . '/inc/error.php';
                    ?>
                  </div>  
                </div>
                <div class="col">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="../../../js/bootstrap.min.js"></script>
  </body>
</html>