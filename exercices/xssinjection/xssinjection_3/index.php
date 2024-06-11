<?php
  define('WEP_APP_PAGE_TO_ROOT', './../../../' );
  include_once __DIR__ . '/config/const.php';
?>

<?php
    if(!isset($_GET['lang']) || empty($_GET['lang'])) {
      header("Location: index.php?lang=fr", true, 302);
      exit();
    }

    $lang = $_GET['lang'];
    switch ($lang) {
      case "fr":
        $lang = "fr";
        break;
      case "en":
        $lang = "en";
        break;
      default:
        $lang = "fr";
        break;
    }
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
            <div class="d-flex align-items-center">
              <div class="col-11">
              </div>
              <div class="col-1">
                <form method="GET" action="./index.php">
                  <select class="form-select" name="lang" id="lang" onchange="this.form.submit()">
                    <script src="./inc/lang.js"></script>
                  </select>
                </form>
              </div>
            </div>
            <div class="row loginForm">
              <div class="d-flex align-items-center">
                <div class="col">
                </div>
                <div class="col">
                  <div class="bg-white p-3 border border-secondary rounded">
                    <form method="POST" action="<?php echo htmlspecialchars("home.php?lang=" . $lang, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401); ?>">
                      <div class="mb-3">
                        <label for="username" class="form-label fw-bold text-dark"><?php echo isset($lang) && $lang === "fr" ? "Nom d'utilisateur :" : "Username:"; ?></label>
                        <input type="text" class="form-control" id="username" name="username">
                      </div>  
                      <div class="mb-3">
                        <label for="password" class="form-label fw-bold text-dark"><?php echo isset($lang) && $lang === "fr" ? "Mot de passe :" : "Password:"; ?></label>
                        <input type="password" class="form-control" id="password" name="password">
                      </div>
                      <div class="d-grid">
                        <button type="submit" name="login" class="btn btn-dark text-light"><?php echo isset($lang) && $lang === "fr" ? "S'authentifier" : "Sign In"; ?></button>
                      </div>
                    </form>
                    <div class="text-center pt-2">
                        <a href="<?php echo htmlspecialchars("signup.php?lang=" . $lang, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401); ?>"><?php echo isset($lang) && $lang === "fr" ? "Pas encore de compte ?" : "Don't have an account ?"; ?></a>
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