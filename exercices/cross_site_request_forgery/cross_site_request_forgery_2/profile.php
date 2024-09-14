<?php
  define('WEP_APP_PAGE_TO_ROOT', './../../../' );
  include_once __DIR__ . '/config/const.php';
  include_once __DIR__ . '/config/database.php';
  ini_set("session.cookie_httponly", 1);
  session_start();

  if(!isset($_SESSION['exercice']) || $_SESSION['exercice'] !== EXERCICE || !isset($_SESSION['username'])) {
    header("Location: index.php?error=Vous devez vous authentifier avant de poursuivre.", true, 302);
    exit();
  }
  if(isset($_POST['firstname']) || isset($_POST['lastname'])) {
    if(!isset($_POST['csrf_token']) || empty($_POST['csrf_token'])) {
      if(!isset($error) || empty($error)) {
        header("Location: profile.php?error=" . urlencode('Attaque CSRF détectée.'), true, 302);
        exit();
      }
    }
    if($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
      if(!isset($error) || empty($error)) {
        header("Location: profile.php?error=" . urlencode('Attaque CSRF détectée.'), true, 302);
        exit();
      }
    }
    if(isset($_POST['firstname']) && empty($_POST['firstname'])) {
      if(!isset($error) || empty($error)) {
        header("Location: profile.php?error=" . urlencode('Le prénom doit être renseigné.'), true, 302);
        exit();
      }
    }
    if(isset($_POST['lastname']) && empty($_POST['lastname'])) {
      if(!isset($error) || empty($error)) {
        header("Location: profile.php?error=" . urlencode('Le nom doit être renseigné.'), true, 302);
        exit();
      }
    }

    if(!isset($error) || empty($error)) {
      try {
        $cnx = new PDO('mysql:host='. $_bdd['server'] . ';dbname=' . $_bdd['database'], $_bdd['user'], $_bdd['password']);
        $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if(!isset($error) || empty($error)) {
          $stmt = $cnx->prepare("UPDATE users SET firstname = ?, lastname = ? WHERE id = ?");
          $stmt->bindParam(1, $_POST["firstname"], PDO::PARAM_STR);
          $stmt->bindParam(2, $_POST["lastname"], PDO::PARAM_STR);
          $stmt->bindParam(3, $_SESSION["id"], PDO::PARAM_INT);
          $stmt->execute();

          header("Location: profile.php?message=" . urlencode('Votre compte a été mis à jour avec succès.'), true, 302);
          exit();
        }        
      }   
      catch(Exception $e) {
        header("HTTP/1.1 500 Internal Server Error");
        $error = "Une erreur technique s'est produite.";
        $error = $e->getMessage();
      }
    }
  }

  if(isset($_SESSION['id']) && !empty($_SESSION['id']) && is_numeric($_SESSION['id']) && $_SESSION['id'] >= 1) {
    try {
      $cnx = new PDO('mysql:host='. $_bdd['server'] . ';dbname=' . $_bdd['database'], $_bdd['user'], $_bdd['password']);
      $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $stmt = $cnx->prepare("SELECT id, username, firstname, lastname, role FROM users WHERE id = ?");
      $stmt->bindParam(1, $_SESSION["id"], PDO::PARAM_STR);
      $stmt->execute(); 

      $user = $stmt->fetch(PDO::FETCH_ASSOC);

      if(!$user) {
        if(!isset($error) || empty($error)) {
          header("Location: profile.php?error=" . urlencode('Aucun utilisateur trouvé.'), true, 302);
          exit();
        }
      }
    }
    catch(Exception $e) {
      header("Location: profile.php?error=" . urlencode('Une erreur technique s\'est produite.'), true, 302);
      exit();
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
                        <form method="POST" action="./profile.php">
                          <div class="mb-3">
                            <label for="username" class="form-label fw-bold text-dark">Nom d'utilisateur :</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($user['username'], ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401); ?>" disabled>
                          </div>  
                          <div class="mb-3">
                            <label for="firstname" class="form-label fw-bold text-dark">Prénom :</label>
                            <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo htmlspecialchars($user['firstname'], ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401); ?>">
                          </div>
                          <div class="mb-3">
                            <label for="lastname" class="form-label fw-bold text-dark">Nom :</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo htmlspecialchars($user['lastname'], ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401); ?>">
                          </div>
                          <div class="mb-3">
                            <label for="role" class="form-label fw-bold text-dark">Rôle :</label>
                            <input type="text" class="form-control" id="role" name="role" value="<?php echo htmlspecialchars($user['role'], ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401); ?>" disabled>
                          </div>
                          <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401); ?>">
                          <div class="d-grid">
                            <button type="submit" name="signup" class="btn btn-dark text-light">Mettre à jour</button>
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