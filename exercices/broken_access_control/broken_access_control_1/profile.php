<?php
  define('WEP_APP_PAGE_TO_ROOT', './../../../' );
  include_once __DIR__ . '/config/const.php';
  include_once __DIR__ . '/config/database.php';
  session_start();

  if(!isset($_SESSION['exercice']) || $_SESSION['exercice'] !== EXERCICE || !isset($_SESSION['username'])) {
    header("Location: index.php?error=Vous devez vous authentifier avant de poursuivre.", true, 302);
    exit();
  }

  if(isset($_POST['password']) && isset($_POST['confirmed_password'])) {
    if(isset($_POST['password']) && empty($_POST['password'])) {
      if(!isset($error) || empty($error)) {
        header("HTTP/1.1 400 Bad Request");
        $error = "Le mot de passe doit être renseigné.";
      }
    }
    if(isset($_POST['confirmed_password']) && empty($_POST['confirmed_password'])) {
      if(!isset($error) || empty($error)) {
        header("HTTP/1.1 400 Bad Request");
        $error = "La confirmation de mot de passe doit être renseignée.";
      }
    }
    if($_POST['password'] !== $_POST['confirmed_password']) {
      if(!isset($error) || empty($error)) {
        header("HTTP/1.1 400 Bad Request");
        $error = "Le mot de passe et la confirmation de mot de passe ne correspondent pas.";
      }
    }

    if(!isset($error) || empty($error)) {
      try {
        $cnx = new PDO('mysql:host='. $_bdd['server'] . ';dbname=' . $_bdd['database'], $_bdd['user'], $_bdd['password']);
        $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $cnx->prepare("UPDATE users SET password = ? WHERE id = ?");
        $newPassword = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $stmt->bindParam(1, $newPassword, PDO::PARAM_STR);
        $stmt->bindParam(2, $_POST["id"], PDO::PARAM_INT);
        $stmt->execute();

        $message = "Votre mot de passe a été mis à jour avec succès."; 
      }   
      catch(Exception $e) {
        header("HTTP/1.1 500 Internal Server Error");
        $error = "Une erreur technique s'est produite.";
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
                        <form method="POST" action="./profile.php">
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
                        </form>
                      </div>
                      <div class="bg-white p-3 mt-2 border border-secondary rounded">
                        <form method="POST" action="./profile.php">
                          <input type="hidden" class="form-control" id="id" name="id" value="<?php echo htmlspecialchars($user['id'], ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401); ?>">  
                          <div class="mb-3">
                            <label for="password" class="form-label fw-bold text-dark">Mot de passe :</label>
                            <input type="password" class="form-control" id="password" name="password">
                          </div>  
                          <div class="mb-3">
                            <label for="confirmed_password" class="form-label fw-bold text-dark">Confirmation mot de passe :</label>
                            <input type="password" class="form-control" id="confirmed_password" name="confirmed_password">
                          </div>
                          <div class="d-grid">
                            <button type="submit" name="change_password" class="btn btn-dark text-light">Mettre à jour</button>
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