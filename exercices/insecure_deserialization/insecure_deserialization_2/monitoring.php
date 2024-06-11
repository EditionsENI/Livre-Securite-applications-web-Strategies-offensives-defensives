<?php
  define('WEP_APP_PAGE_TO_ROOT', './../../../' );
  include_once __DIR__ . '/config/const.php';
  include_once __DIR__ . '/config/database.php';
  include_once __DIR__ . '/inc/user.php';
  include_once __DIR__ . '/inc/monitor.php';
  session_start();

  if(!isset($_SESSION['exercice']) || $_SESSION['exercice'] !== EXERCICE || !isset($_SESSION['username'])) {
    if (isset($_COOKIE[EXERCICE])) {
      $unserUser = unserialize($_COOKIE[EXERCICE]);
  
      $cnx = new PDO('mysql:host='. $_bdd['server'] . ';dbname=' . $_bdd['database'], $_bdd['user'], $_bdd['password']);
      $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
      $stmt = $cnx->prepare("SELECT id, password FROM users WHERE username = ?");
      $stmt->bindParam(1, $unserUser->username, PDO::PARAM_STR);
      $stmt->execute(); 
  
      $user = $stmt->fetch(PDO::FETCH_ASSOC);
      if(!password_verify($unserUser->password, $user['password'])) {
        setcookie(EXERCICE, '', time() - 3600);
        header("Location: index.php?error=Vous devez vous authentifier avant de poursuivre.", true, 302);
        exit();
      }
  
      $_SESSION['exercice'] = EXERCICE;
      $_SESSION['id'] = $user['id'];
      $_SESSION['username'] = $unserUser->username;
      $_SESSION['userObj'] = $unserUser;
    }
    else {
      header("Location: index.php?error=Vous devez vous authentifier avant de poursuivre.", true, 302);
      exit();
    }
  }

  if($_SESSION['userObj']->role !== "administrator") {
    header("Location: home.php?error=Vous ne possédez pas les autorisations requises.", true, 302);
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
                    <h1>Monitoring - Administrators Only</h1>
                    <?php 
                      $monitor = new Monitor("/", "/proc/version");
                      echo $monitor;
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