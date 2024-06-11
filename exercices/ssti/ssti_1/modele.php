<?php
  define('WEP_APP_PAGE_TO_ROOT', './../../../' );
  include_once __DIR__ . '/config/const.php';
  include_once __DIR__ . '/config/database.php';
  session_start();

  ini_set('display_errors', 1);
  spl_autoload_register(function ($classname) {
    $dirs = array ('./Twig-3.x/');

    foreach ($dirs as $dir) {
      $filename = $dir . str_replace('\\', '/', $classname) .'.php';
      if (file_exists($filename)) {
        require_once $filename;
        break;
      }
    }
  });

  if(!isset($_SESSION['exercice']) || $_SESSION['exercice'] !== EXERCICE || !isset($_SESSION['username'])) {
    header("Location: index.php?error=Vous devez vous authentifier avant de poursuivre.", true, 302);
    exit();
  }

  if(isset($_SESSION['id']) && !empty($_SESSION['id']) && is_numeric($_SESSION['id']) && $_SESSION['id'] >= 1) {
    try {
      $cnx = new PDO('mysql:host='. $_bdd['server'] . ';dbname=' . $_bdd['database'], $_bdd['user'], $_bdd['password']);
      $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $stmt = $cnx->prepare("SELECT id, username, firstname, lastname, role FROM users WHERE id = ?");
      $stmt->bindParam(1, $_SESSION["id"], PDO::PARAM_STR);
      $stmt->execute(); 

      $user = $stmt->fetch(PDO::FETCH_ASSOC);
      $_SESSION['username'] = $user['username'];
      $_SESSION['firstname'] = $user['firstname'];
      $_SESSION['lastname'] = $user['lastname'];
      $_SESSION['role'] = $user['role'];

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

  if(isset($_POST['position']) || isset($_POST['reference'])) {
    if(empty($_POST['position'])) {
      header("Location: modele.php?error=Le champ \"Intitué du poste\" ne doit pas être vide.", true, 302);
      exit();
    }

    if(empty($_POST['reference'])) {
      header("Location: modele.php?error=Le champ \"Référence de l'offre\" ne doit pas être vide.", true, 302);
      exit();
    }

    if(!is_numeric($_POST['reference'])) {
      header("Location: modele.php?error=Le champ \"Référence de l'offre\" doit être un nombre valide.", true, 302);
      exit();
    }

    $position = $_POST['position'];
    $reference = $_POST['reference'];

    $loader = new \Twig\Loader\ArrayLoader([
      'candidature' => 
      '
        <h4>Objet : Candidature pour le poste de {{ position }} - {{ reference }} </h4>
        <p>Madame, Monsieur,</p>
        <p>Actuellement en recherche d\'emploi, je me permets de candidater à votre offre pour le poste de {{ position|raw }} </p> 
        <p>Je suis très intéressé par le secteur de la cybersécurité et particulièrement motivé pour rejoindre votre entreprise.</p>
        <p>Intégrer votre entreprise, représente pour moi un réel enjeu d\'avenir dans lequel ma motivation pourra s\'exprimer pleinement.</p>
        <p>Dans l\'attente d\'un retour de votre part, je reste à votre disposition pour toute information complémentaire ainsi que pour un entretien à votre convenance.</p>
        <p>Veuillez agréer, Madame, Monsieur, mes sincères salutations.</p>
        <p>' . $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] . '</p>
      '
    ]);        
   
    $twig = new \Twig\Environment($loader);
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
                    <h1>Générez une lettre de motivation personnalisée !</h1>
                    <form method="POST" action="./modele.php">
                      <div class="mb-3">
                        <label for="position" class="form-label fw-bold text-dark">Nom du poste à candidater :</label>
                        <input type="text" class="form-control" id="position" name="position" placeholder="Consultant">
                      </div>
                      <div class="mb-3">
                        <label for="reference" class="form-label fw-bold text-dark">Référence de l'offre :</label>
                        <input type="text" class="form-control" id="reference" name="reference" placeholder="1234" value="1234">
                      </div>
                      <div>
                        <button type="submit" name="generate" class="btn btn-sm btn-dark text-light">Générer une candidature</button>
                      </div>
                    </form>
                    <div class="mt-3">
                      <?php
                        if(isset($twig)) {
                          echo $twig->render('candidature', ['position' => $position, 'reference' => $reference]);
                        }                          
                      ?>
                    </div>
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