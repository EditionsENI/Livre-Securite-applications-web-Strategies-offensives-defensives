<?php
  define('WEP_APP_PAGE_TO_ROOT', './../../../' );
  include_once __DIR__ . '/config/const.php';
  include_once __DIR__ . '/config/database.php';
  session_start();

  if(!isset($_SESSION['exercice']) || $_SESSION['exercice'] !== EXERCICE || !isset($_SESSION['username'])) {
    header("Location: index.php?error=Vous devez vous authentifier avant de poursuivre.", true, 302);
    exit();
  }

  if(isset($_GET['usersearch']) && !empty($_GET['usersearch'])) {
    if(!isset($error) || empty($error)) {
      try {
        $cnx = new PDO('mysql:host='. $_bdd['server'] . ';dbname=' . $_bdd['database'], $_bdd['user'], $_bdd['password']);
        $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $usersearch = '%' . $_GET["usersearch"] . '%';
        $stmt = $cnx->prepare("SELECT username, firstname, lastname FROM users WHERE username LIKE ?");
        $stmt->bindParam(1, $usersearch, PDO::PARAM_STR);
        $stmt->execute();
    
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        if(!$users) {
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
                  <form class="row row-cols-lg-auto g-3 align-items-center ms-2 mt-2 mb-2" method="GET" action="./search.php">
                    <div class="col-12">
                      <label class="visually-hidden" for="usersearch">User</label>
                      <div class="input-group">
                        <div class="input-group-text">
                          Recherche :
                        </div>
                        <input type="text" class="form-control" id="usersearch" name="usersearch" placeholder="Utilisateur">
                        <button type="submit" class="btn btn-dark text-light">Rechercher</button>
                      </div>
                    </div>
                  </form>
                  <div>
                    <?php
                      if(isset($_GET['usersearch']) && !empty($_GET['usersearch'])) {
                        echo "Voici les résultats pour votre recherche <span class=\"fw-bold\">'" . $_GET['usersearch'] . "'</span> :";
                      }
                    ?>
                  </div>
                  <?php
                    if(isset($user) && !isset($error)) {
                  ?>
                      <div class="bg-white pt-3 ps-3 pe-3 border border-secondary rounded">
                        <?php
                          foreach ($users as $user) {
                            echo "Nom d'utilisateur: " . htmlspecialchars($user['username'], ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401) . "<br />";
                            echo "Prénom: " . htmlspecialchars($user['firstname'], ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401) . "<br />";
                            echo "Nom de famille: " . htmlspecialchars($user['lastname'], ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401) . "<br />";
                            echo "<hr>";
                          }
                        ?>
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