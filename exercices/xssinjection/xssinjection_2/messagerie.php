<?php
  define('WEP_APP_PAGE_TO_ROOT', './../../../' );
  include_once __DIR__ . '/config/const.php';
  include_once __DIR__ . '/config/database.php';
  ini_set('session.cookie_httponly', '1');
  session_start();

  if(!isset($_SESSION['exercice']) || $_SESSION['exercice'] !== EXERCICE || !isset($_SESSION['username'])) {
    header("Location: index.php?error=Vous devez vous authentifier avant de poursuivre.", true, 302);
    exit();
  }

  if(isset($_POST['envoyer']) && isset($_POST['content']) && !empty($_POST['content'])) {
    if(!isset($error) || empty($error)) {
      try {
        $cnx = new PDO('mysql:host='. $_bdd['server'] . ';dbname=' . $_bdd['database'], $_bdd['user'], $_bdd['password']);
        $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         
        $stmt = $cnx->prepare("INSERT INTO messages (user_id, message) VALUES (?, ?)");
        $stmt->bindParam(1, $_SESSION["id"], PDO::PARAM_INT);
        $stmt->bindParam(2, $_POST["content"], PDO::PARAM_STR);
        $stmt->execute();
      }
      catch(Exception $e) {
        header("HTTP/1.1 500 Internal Server Error");
        $error = "Une erreur technique s'est produite.";
      }
    }
  }

  if(!isset($error) || empty($error)) {
    try {
      $cnx = new PDO('mysql:host='. $_bdd['server'] . ';dbname=' . $_bdd['database'], $_bdd['user'], $_bdd['password']);
      $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
      $stmt = $cnx->prepare("SELECT messages.message, users.username FROM messages JOIN users ON messages.user_id = users.id");
      $stmt->execute();
  
      $usermessages = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
                <div class="col-1">
                </div>
                <div class="col-10">
                  <?php
                    if($usermessages && !isset($error)) {
                  ?>
                      <div class="bg-white p-3 border border-secondary rounded">
                        <div class="table-responsive">
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th class="w-25">Nom d'utilisateur</th>
                                <th class="w-75">Message</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                                foreach($usermessages as $usermessage) {
                                  echo "<tr>";
                                  echo "<td class='text-break'>" . $usermessage['username'] . "</td>";
                                  echo "<td>" . $usermessage['message'] . "</td>";
                                  echo "</tr>";
                                }
                              ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                      <div class="bg-white mt-3 p-3 border border-secondary rounded">
                        <form method="POST" action="./messagerie.php">
                          <div class="mb-3">
                            <label for="content" class="form-label fw-bold text-dark">Message :</label><div class="input-group">
                            <input type="text" class="form-control" id="content" name="content" placeholder="Votre message ...">
                            <button type="submit" class="btn btn-dark text-light" name="envoyer">Envoyer</button>
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