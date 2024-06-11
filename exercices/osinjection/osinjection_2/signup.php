<?php
  define('WEP_APP_PAGE_TO_ROOT', './../../../' );
  include_once __DIR__ . '/config/const.php';
  include_once __DIR__ . '/config/database.php';

  session_start();
  if(isset($_SESSION['exercice']) && $_SESSION['exercice'] === EXERCICE && isset($_SESSION['username'])) {
    header("Location: home.php", true, 302);
    exit();
  }

  if(isset($_POST['username']) || isset($_POST['firstname']) || isset($_POST['lastname']) || isset($_POST['password']) || isset($_POST['confirmed_password'])) {
    if(isset($_POST['username']) && empty($_POST['username'])) {
      if(!isset($error) || empty($error)) {
        header("HTTP/1.1 400 Bad Request");
        $error = "Le nom d'utilisateur doit être renseigné.";
      }
    }
    if(isset($_POST['username']) && !empty($_POST['username'])) {
      if(!preg_match('/^[a-zA-Z0-9]+$/', $_POST['username'])) {
        if(!isset($error) || empty($error)) {
          header("HTTP/1.1 400 Bad Request");
          $error = "Le nom d'utilisateur ne peut contenir que des chiffres et des lettres.";
        }
      }
    }
    if(isset($_POST['firstname']) && empty($_POST['firstname'])) {
      if(!isset($error) || empty($error)) {
        header("HTTP/1.1 400 Bad Request");
        $error = "Le prénom doit être renseigné.";
      }
    }
    if(isset($_POST['lastname']) && empty($_POST['lastname'])) {
      if(!isset($error) || empty($error)) {
        header("HTTP/1.1 400 Bad Request");
        $error = "Le nom doit être renseigné.";
      }
    }
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
        
        $stmt = $cnx->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bindParam(1, $_POST["username"], PDO::PARAM_STR);
        $stmt->execute(); 
             
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if($user) {
          header("HTTP/1.1 409 Conflict");
          $error = "Le nom d'utilisateur n'est pas disponible.";
        }
        else {
          $userPassword = password_hash($_POST["password"], PASSWORD_DEFAULT);
          $stmt = $cnx->prepare("INSERT INTO users (username, firstname, lastname, password, role) VALUES (?, ?, ?, ?, 'user')");
          $stmt->bindParam(1, $_POST["username"], PDO::PARAM_STR);
          $stmt->bindParam(2, $_POST["firstname"], PDO::PARAM_STR);
          $stmt->bindParam(3, $_POST["lastname"], PDO::PARAM_STR);
          $stmt->bindParam(4, $userPassword, PDO::PARAM_STR);
          $stmt->execute();

          $data = array(
            'username' => $_POST["username"],
            'firstname' => $_POST["firstname"],
            'lastname' => $_POST["lastname"],
            'role' => 'user'
          );

          $jsonData = json_encode($data, JSON_PRETTY_PRINT);
          $userfile = 'users/' . $_POST["username"] . '.json';
          $file = fopen($userfile, 'w');
          fwrite($file, $jsonData);
          fclose($file);

          $message = "Bienvenue. Votre compte a été créé.";
        }   
      }
      catch(Exception $e) {
        header("HTTP/1.1 500 Internal Server Error");
        $error = "Une erreur technique s'est produite.";
      }
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
                  <div class="bg-white p-3 border border-secondary rounded">
                    <form method="POST" action="./signup.php">
                      <div class="mb-3">
                        <label for="username" class="form-label fw-bold text-dark">Nom d'utilisateur :</label>
                        <input type="text" class="form-control" id="username" name="username">
                      </div>
                      <div class="mb-3">
                        <label for="firstname" class="form-label fw-bold text-dark">Prénom :</label>
                        <input type="text" class="form-control" id="firstname" name="firstname">
                      </div>
                      <div class="mb-3">
                        <label for="lastname" class="form-label fw-bold text-dark">Nom :</label>
                        <input type="text" class="form-control" id="lastname" name="lastname">
                      </div>
                      <div class="mb-3">
                        <label for="password" class="form-label fw-bold text-dark">Mot de passe :</label>
                        <input type="password" class="form-control" id="password" name="password">
                      </div>
                      <div class="mb-3">
                        <label for="confirmed_password" class="form-label fw-bold text-dark">Confirmation mot de passe :</label>
                        <input type="password" class="form-control" id="confirmed_password" name="confirmed_password">
                      </div>
                      <div class="d-grid">
                        <button type="submit" name="signup" class="btn btn-dark text-light">S'inscrire</button>
                      </div>
                    </form>
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