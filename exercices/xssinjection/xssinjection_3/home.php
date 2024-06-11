<?php
  define('WEP_APP_PAGE_TO_ROOT', './../../../' );
  include_once __DIR__ . '/config/const.php';
  include_once __DIR__ . '/config/database.php';

  if(!isset($_GET['lang'])) {
    header("Location: signup.php?lang=fr", true, 302);
    exit();
  }

  $lang = $_GET['lang'];
  switch ($lang) {
    case "fr":
      $lang = "fr";
      break;
    case "en":
      $lang = "en";
      break;
    default:
      $lang = "fr";
      break;
  }

  session_start();

  if(isset($_POST['username']) && empty($_POST['username'])) {
    $queryParams = $_GET;
    switch ($_GET['lang']) {
      case 'fr':
        $queryParams['error'] = "Le nom d'utilisateur doit être renseigné.";
        break;
      case 'en':
        $queryParams['error'] = "The username must be provided.";
        break;
      default:
        $queryParams['error'] = "Le nom d'utilisateur doit être renseigné.";
        break;
    }    
    
    header("Location: index.php?" . http_build_query($queryParams), true, 302);
    exit();
  }
  if(isset($_POST['password']) && empty($_POST['password'])) {
    $queryParams = $_GET;
    switch ($_GET['lang']) {
      case 'fr':
        $queryParams['error'] = "Le mot de passe doit être renseigné.";
        break;
      case 'en':
        $queryParams['error'] = "The password must be provided.";
        break;
      default:
        $queryParams['error'] = "Le mot de passe doit être renseigné.";
        break;
    }    
    
    header("Location: index.php?" . http_build_query($queryParams), true, 302);
    exit();
  }

  if(isset($_POST['username']) || isset($_POST['password'])) {
    if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password'])) {
      try {
        $cnx = new PDO('mysql:host='. $_bdd['server'] . ';dbname=' . $_bdd['database'], $_bdd['user'], $_bdd['password']);
        $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $cnx->prepare("SELECT id, username, firstname, lastname, password, role FROM users WHERE username = ?");
        $stmt->bindParam(1, $_POST["username"], PDO::PARAM_STR);
        $stmt->execute(); 

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!password_verify($_POST['password'], $user['password'])) {
          $queryParams = $_GET;
          switch ($_GET['lang']) {
            case 'fr':
              $queryParams['error'] = "Le nom d'utilisateur ou le mot de passe est incorrect.";
              break;
            case 'en':
              $queryParams['error'] = "The username or password is incorrect.";
              break;
            default:
              $queryParams['error'] = "Le nom d'utilisateur ou le mot de passe est incorrect.";
              break;
          }    
    
          header("Location: index.php?" . http_build_query($queryParams), true, 302);
          exit();
        }

        $_SESSION['exercice'] = EXERCICE;
        $_SESSION['id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['firstname'] = $user['firstname'];
        $_SESSION['lastname'] = $user['lastname'];
        $_SESSION['role'] = $user['role'];
      }
      catch(Exception $e) {
        $queryParams = $_GET;
        switch ($_GET['lang']) {
          case 'fr':
            $queryParams['error'] = "Une erreur technique s'est produite.";
            break;
          case 'en':
            $queryParams['error'] = "A technical error has occurred.";
            break;
          default:
            $queryParams['error'] = "Une erreur technique s'est produite.";
            break;
        }    
    
        header("Location: index.php?" . http_build_query($queryParams), true, 302);
        exit();
      }          
    }
  }

  if(!isset($_SESSION['exercice']) || $_SESSION['exercice'] !== EXERCICE || !isset($_SESSION['username'])) {
    $queryParams = $_GET;
    switch ($_GET['lang']) {
      case 'fr':
        $queryParams['error'] = "Vous devez vous authentifier avant de poursuivre.";
        break;
      case 'en':
        $queryParams['error'] = "You must authenticate before proceeding.";
        break;
      default:
        $queryParams['error'] = "Vous devez vous authentifier avant de poursuivre.";
        break;
    }    

    header("Location: index.php?" . http_build_query($queryParams), true, 302);
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
            <div class="d-flex align-items-center">
              <div class="col-11">
              </div>
              <div class="col-1">
                <form method="GET" action="./home.php">
                  <select class="form-select" name="lang" id="lang" onchange="this.form.submit()">
                    <script src="./inc/lang.js"></script>
                  </select>
                </form>
              </div>
            </div>
            <div class="row view">
              <div class="d-flex align-items-center">
                <div class="col-2">
                </div>
                <div class="col">
                  <div class="bg-white p-3 border border-secondary rounded">
                    <h1><?php echo isset($lang) && $lang === "fr" ? "Bienvenue sur Notre Plateforme!" : "Welcome to Our Platform!"; ?></h1>
                    <h2><?php echo isset($lang) && $lang === "fr" ? "Félicitations, " : "Congratulations, "; ?><?php echo htmlspecialchars($_SESSION['firstname'], ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401) . ' ' . htmlspecialchars($_SESSION['lastname'], ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401); ?>!</h2>
                    <p>
                      <?php echo isset($lang) && $lang === "fr" ? "Nous sommes ravis de vous accueillir sur notre plateforme en ligne. Vous avez désormais accès à toutes les fonctionnalités exclusives réservées aux membres. Explorez nos services, connectez-vous avec d'autres utilisateurs et profitez d'une expérience personnalisée." : "We are delighted to welcome you to our online platform. You now have access to all the exclusive features reserved for members. Explore our services, connect with other users, and enjoy a personalized experience."; ?>
                      
                    </p>
                    <p>
                      <?php echo isset($lang) && $lang === "fr" ? "Que pouvez-vous faire maintenant?" : "What can you do now?"; ?>
                    </p>
                    <p>
                      <?php echo isset($lang) && $lang === "fr" ? "Explorer le Contenu : Découvrez nos fonctionnalités et trouvez ce qui vous intéresse." : "Explore the Content: Discover our features and find what interests you."; ?>
                    </p>
                    <p>
                      <?php echo isset($lang) && $lang === "fr" ? "<span class=\"text-danger\">Nous travaillons actuellement à la mise à jour du site pour le rendre bilingue en français et en anglais. Veuillez noter que des travaux sont en cours, et il est possible que vous rencontriez des bugs pendant cette phase de construction. Nous nous excusons pour tout inconvénient et apprécions votre compréhension pendant cette période de transition.</span>" : "<span class=\"text-danger\">We are currently working on updating the site to make it bilingual in French and English. Please note that construction is underway, and you may encounter bugs during this phase. We apologize for any inconvenience and appreciate your understanding during this transition period.</span>"; ?>
                    </p>
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