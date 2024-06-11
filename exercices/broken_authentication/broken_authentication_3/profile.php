<?php
  define('WEP_APP_PAGE_TO_ROOT', './../../../' );
  include_once __DIR__ . '/config/const.php';
  include_once __DIR__ . '/config/database.php';
  session_start();

  if(!isset($_SESSION['exercice']) || $_SESSION['exercice'] !== EXERCICE || !isset($_SESSION['username'])) {
    header("Location: index.php?error=Vous devez vous authentifier avant de poursuivre.", true, 302);
    exit();
  }


  if(!isset($error) || empty($error)) {
    try {
      $cnx = new PDO('mysql:host='. $_bdd['server'] . ';dbname=' . $_bdd['database'], $_bdd['user'], $_bdd['password']);
      $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
      $stmt = $cnx->prepare("SELECT username, firstname, lastname, role FROM users WHERE id = ?");
      $stmt->bindParam(1, $_SESSION['id'], PDO::PARAM_INT);
      $stmt->execute(); 

      $user = $stmt->fetch(PDO::FETCH_ASSOC);

      if(!$user) {
        if(!isset($error) || empty($error)) {
          header("HTTP/1.1 404 Not Found");
          $error = "Aucun utilisateur trouvé.";
        }
      }
    }
    catch(Exception $e) {
      header("HTTP/1.1 500 Internal Server Error");
      $error = "Une erreur technique s'est produite.";
    }
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
                <div class="col">
                </div>
                <div class="col">
                  <?php
                    if(isset($user) && !isset($error)) {
                  ?>
                      <div class="bg-white p-3 border border-secondary rounded">
                        <form>
                          <div class="mb-3">
                            <label for="username" class="form-label fw-bold text-dark">Nom d'utilisateur :</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($user['username'], ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401); ?>" disabled>
                          </div>  
                          <div class="mb-3">
                            <label for="firstname" class="form-label fw-bold text-dark">Prénom :</label>
                            <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo htmlspecialchars($user['firstname'], ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401); ?>" disabled>
                          </div>
                          <div class="mb-3">
                            <label for="lastname" class="form-label fw-bold text-dark">Nom :</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo htmlspecialchars($user['lastname'], ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401); ?>" disabled>
                          </div>
                          <div class="mb-3">
                            <label for="role" class="form-label fw-bold text-dark">Rôle :</label>
                            <input type="text" class="form-control" id="role" name="role" value="<?php echo htmlspecialchars($user['role'], ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401); ?>" disabled>
                          </div>
                        </form>
                      </div>
                  <?php
                    }
                  ?>                 
                  <?php
                    include_once __DIR__ . '/inc/error.php';
                  ?>
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