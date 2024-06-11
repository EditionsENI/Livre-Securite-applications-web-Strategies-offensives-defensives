<?php
  define('WEP_APP_PAGE_TO_ROOT', './../../../' );
  include_once __DIR__ . '/config/const.php';
  include_once __DIR__ . '/config/database.php';
  session_start();

  if(!isset($_SESSION['exercice']) || $_SESSION['exercice'] !== EXERCICE || !isset($_SESSION['username'])) {
    header("Location: index.php?error=Vous devez vous authentifier avant de poursuivre.", true, 302);
    exit();
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
            <?php
              include_once __DIR__ . '/inc/navbar.inc.php';
            ?>
            <div class="row view">
              <div class="d-flex align-items-center">
                <div class="col-2">
                </div>
                <div class="col">
                  <div class="bg-white p-3 border border-secondary rounded">
                    <h1>Monitoring de la plateforme</h1>
                    <form method="GET" action="./monitoring.php">
                      <div class="col-2 mb-3">
                        <select class="form-select form-select-sm" name="ip" onchange="this.form.submit()">
                          <option selected disabled>Liste des hôtes</option>
                          <?php
                            echo '<option value="127.0.0.1">Localhost</option>';
                            echo '<option value="127.0.1.1">Base de données</option>';
                            echo '<option value="' . htmlspecialchars($_SERVER['SERVER_ADDR'], ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401) . '">Serveur Web</option>';
                          ?>
                        </select>
                      </div>
                    </form>
                    <?php
                      if(isset($_GET['ip']) && !empty($_GET['ip'])) {
                        echo '<pre>';
                        system('ping' . ' -c 1 ' . $_GET['ip']);
                        echo '</pre>';
                      }
                    ?>
                  </div>
                  <div class="error-div">
                    <?php
                      include_once __DIR__ . '/inc/error.php';
                    ?>
                  </div>  
                </div>
                <div class="col-2">
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