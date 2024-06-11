<?php
  define('WEP_APP_PAGE_TO_ROOT', './' );
  require_once WEP_APP_PAGE_TO_ROOT . "inc/uuid_gen.php"; 
  require_once WEP_APP_PAGE_TO_ROOT . "setup.inc.php"; 
  
  $_bdd = array();
  $_bdd['server'] = '127.0.0.1';
  $_bdd['port'] = '3306';
  $_bdd['user'] = 'root';
  $_bdd['password'] = 'root';

  function checkBdd($_bdd) {
    try {
      $cnx = new PDO('mysql:host='. $_bdd['server'], $_bdd['user'], $_bdd['password']);
      return "OK";
    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }
  
  if(isset($_POST["main_vulns"])) {
    mainVulns($_bdd);
  }

  if(isset($_POST["other_vulns"])) {
    otherVulns($_bdd);
  }  
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Configuration</title>
    <link href="./styles/bootstrap.min.css" rel="stylesheet">
    <link href="./styles/platform_styles.css" rel="stylesheet">
    <link href="./styles/exercice_styles.css" rel="stylesheet">
  </head>
  <body>
    <?php
      include WEP_APP_PAGE_TO_ROOT . "/inc/navbar.inc.php";
    ?>
    <div class="container-fluid ps-0">
      <div class="row">
        <div class="col-2">
          <div>
            <?php
              include WEP_APP_PAGE_TO_ROOT . "/inc/nav.inc.php";
            ?>
          </div>
        </div>
        <div class="col">
          <div class="m-4 p-4 border">
            <div class="border rounded ps-2 pt-2 pe-2">
              <form>
                <div class="mb-3">
                  <label for="server" class="form-label fw-bold text-dark">Server :</label>
                  <input type="text" class="form-control-sm." id="server" name="server" value="<?php echo htmlspecialchars($_bdd['server'], ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401); ?>" disabled>
                </div>  
                <div class="mb-3">
                  <label for="port" class="form-label fw-bold text-dark">Port :</label>
                  <input type="text" class="form-control-sm." id="port" name="port" value="<?php echo htmlspecialchars($_bdd['port'], ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401); ?>" disabled>
                </div>
                <div class="mb-3">
                  <label for="user" class="form-label fw-bold text-dark">User :</label>
                  <input type="text" class="form-control-sm." id="user" name="user" value="<?php echo htmlspecialchars($_bdd['user'], ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401); ?>" disabled>
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label fw-bold text-dark">Password :</label>
                  <input type="text" class="form-control-sm." id="password" name="password" value="<?php echo htmlspecialchars($_bdd['password'], ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401); ?>" disabled>
                </div>
              </form>
              <?php
                if(($ret = checkBdd($_bdd)) === "OK") {
                  echo '<p>Connexion à la base de données <span class="fw-bold text-success">OK</span>.</p>';
                }
                else {
                  echo '<p>Connexion à la base de données <span class="fw-bold text-danger">' . $ret . '</span></p>';
                }
              ?>
            </div>
            <div class="border rounded ps-2 pt-2 pe-2 mt-2">
              <?php
                if (extension_loaded('xml')) {
                  echo '<p>L\'extension PHP-XML <span class="fw-bold text-success">est installée</span>.</p>';
                } else {
                  echo '<p>L\'extension PHP-XML n\'est <span class="fw-bold text-danger">pas installée</span>.</p>';
                }
                if (extension_loaded('curl')) {
                  echo '<p>L\'extension PHP-CURL <span class="fw-bold text-success">est installée</span>.</p>';
                } else {
                  echo '<p>L\'extension PHP-CURL n\'est <span class="fw-bold text-danger">pas installée</span>.</p>';
                }
                if(ini_get('allow_url_fopen') == True) {
                  echo '<p>La directive <span class="fw-bold">allow_url_fopen</span> est <span class="fw-bold text-success">activée</span> dans le fichier php.ini.</p>';
                } else {
                  echo '<p>La directive <span class="fw-bold">allow_url_fopen</span> n\'est <span class="fw-bold text-danger">pas activée</span> dans le fichier php.ini.</p>';
                }
                if(ini_get('allow_url_include') == True) {
                  echo '<p>La directive <span class="fw-bold">allow_url_include</span> est <span class="fw-bold text-success">activée</span> dans le fichier php.ini.</p>';
                } else {
                  echo '<p>La directive <span class="fw-bold">allow_url_include</span> n\'est <span class="fw-bold text-danger">pas activée</span> dans le fichier php.ini.</p>';
                }
                if(ini_get('session.use_strict_mode') == 1) {
                  echo '<p>La directive <span class="fw-bold">session.use_strict_mode</span> est <span class="fw-bold text-danger">activée</span> dans le fichier php.ini.</p>';
                } else {
                  echo '<p>La directive <span class="fw-bold">session.use_strict_mode</span> n\'est <span class="fw-bold text-success">pas activée</span> dans le fichier php.ini.</p>';
                }
                if(ini_get('session.cookie_httponly') == 1) {
                  echo '<p>La directive <span class="fw-bold">session.cookie_httponly</span> est <span class="fw-bold text-danger">activée</span> dans le fichier php.ini.</p>';
                } else {
                  echo '<p>La directive <span class="fw-bold">session.cookie_httponly</span> n\'est <span class="fw-bold text-success">pas activée</span> dans le fichier php.ini.</p>';
                }
                if (is_writable("exercices/idor/idor_5/users/") && is_readable("exercices/idor/idor_5/users/") && is_executable("exercices/idor/idor_5/users/")) {
                  echo '<p>Le dossier <span class="fw-bold">exercices/idor/idor_5/users/</span> possède les droits en lecture et écriture : <span class="fw-bold text-success">Oui</span>.</p>';
                } else {
                  echo '<p>Le dossier <span class="fw-bold">exercices/idor/idor_5/users/</span> possède les droits en lecture et écriture : <span class="fw-bold text-danger">Non</span>.</p>';
                }
                if (is_writable("exercices/sqli/sqli_9/public/") && is_readable("exercices/sqli/sqli_9/public/") && is_executable("exercices/sqli/sqli_9/public/")) {
                  echo '<p>Le dossier <span class="fw-bold">exercices/sqli/sqli_9/public/</span> possède les droits en lecture et écriture : <span class="fw-bold text-success">Oui</span>.</p>';
                } else {
                  echo '<p>Le dossier <span class="fw-bold">exercices/sqli/sqli_9/public/</span> possède les droits en lecture et écriture : <span class="fw-bold text-danger">Non</span>.</p>';
                }
                if (is_writable("exercices/osinjection/osinjection_2/users/") && is_readable("exercices/osinjection/osinjection_2/users/") && is_executable("exercices/osinjection/osinjection_2/users/")) {
                  echo '<p>Le dossier <span class="fw-bold">exercices/osinjection/osinjection_2/users/</span> possède les droits en lecture et écriture : <span class="fw-bold text-success">Oui</span>.</p>';
                } else {
                  echo '<p>Le dossier <span class="fw-bold">exercices/osinjection/osinjection_2/users/</span> possède les droits en lecture et écriture : <span class="fw-bold text-danger">Non</span>.</p>';
                }
                if (is_writable("exercices/codeinjection/codeinjection_2/uploads/") && is_readable("exercices/codeinjection/codeinjection_2/uploads/") && is_executable("exercices/codeinjection/codeinjection_2/uploads/")) {
                  echo '<p>Le dossier <span class="fw-bold">exercices/codeinjection/codeinjection_2/uploads/</span> possède les droits en lecture et écriture : <span class="fw-bold text-success">Oui</span>.</p>';
                } else {
                  echo '<p>Le dossier <span class="fw-bold">exercices/codeinjection/codeinjection_2/uploads/</span> possède les droits en lecture et écriture : <span class="fw-bold text-danger">Non</span>.</p>';
                }
              ?>
            </div>
            <div class="border rounded ps-2 pt-2 pe-2 mt-2">
              <form method="POST" action="./setup.php">
                <div class="mb-3">
                  <label for="main_vulns" class="form-label fw-bold text-dark">Les principales vulnérabilités web :</label>
                  <input type="submit" class="form-control-sm." name="main_vulns" value="Créer / Restaurer la base de données">
                </div>
              </form>
              <form method="POST" action="./setup.php">
                <div class="mb-3">
                  <label for="other_vulns" class="form-label fw-bold text-dark">Autre vulnérabilités applicatives :</label>
                  <input type="submit" class="form-control-sm." name="other_vulns" value="Créer / Restaurer la base de données">
                </div>
              </form>
            </div>
            <div class="error-div">
              <?php
                include_once __DIR__ . '/inc/error.php';
              ?>
            </div> 
          </div>
        </div>
      </div>
    </div>
    <script src="./js/bootstrap.min.js"></script>
  </body>
</html>