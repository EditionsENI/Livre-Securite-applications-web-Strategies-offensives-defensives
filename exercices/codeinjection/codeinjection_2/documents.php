<?php
  define('WEP_APP_PAGE_TO_ROOT', './../../../' );
  include_once __DIR__ . '/config/const.php';
  include_once __DIR__ . '/config/database.php';
  session_start();

  if(!isset($_SESSION['exercice']) || $_SESSION['exercice'] !== EXERCICE || !isset($_SESSION['username'])) {
    header("Location: index.php?error=Vous devez vous authentifier avant de poursuivre.", true, 302);
    exit();
  }
?>

<?php
  if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["file"])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);

    if(!isset($error) || empty($error)) {
      if(file_exists($target_file)) {
        header("HTTP/1.1 409 Conflict");
        $error = "Le fichier existe déjà.";
      }
    }

    if(!isset($error) || empty($error)) {
      if($_FILES["file"]["size"] > 1000000) {
        header("HTTP/1.1 413 Content Too Large");
        $error = "Le fichier est trop volumineux.";
      }
    }

    if(!isset($error) || empty($error)) {
      $allowedExtensions = ['jpg', 'png', 'jpeg', 'txt', 'pdf'];
      $fileileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

      if(!in_array($fileileType, $allowedExtensions)) {
        header("HTTP/1.1 400 Bad Request");
        $error = "Seuls les fichiers images (JPG, JPEG, PNG) et les documents (PDF, TXT) sont autorisés.";
      }
    }

    if(!isset($error) || empty($error)) {
      $allowedMimeTypes = ['image/jpeg', 'image/png', 'application/pdf', 'text/plain'];
      $uploadedFileMimeType = mime_content_type($_FILES['file']['tmp_name']);
      
      if(!in_array($uploadedFileMimeType, $allowedMimeTypes)) {
        header("HTTP/1.1 400 Bad Request");
        $error = "Seuls les fichiers images (JPG, JPEG, PNG ) et les documents (PDF, TXT) sont autorisés.";
      }
    }

    if(!isset($error) || empty($error)) {
      if(move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        $message = "Le fichier " . htmlspecialchars(basename($_FILES["file"]["name"])) . " a été téléchargé avec succès.";
      }
      else {
        header("HTTP/1.1 500 Internal Server Error");
        $error = "Une erreur inconnue s'est produite lors du téléchargement.";
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
                  <div class="bg-white p-3 border border-secondary rounded mb-3">
                    <h1>Ressources partagées</h1>
                    <?php
                      $folderpath = './uploads';
                      $files = scandir($folderpath);

                      foreach ($files as $file) {
                        if ($file != "." && $file != "..") {
                          echo '<a href="./uploads/' . htmlspecialchars($file, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401) . '">' . htmlspecialchars($file, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401) . '</a>';
                          echo '<br />';
                        }
                      }
                    ?>
                  </div>
                  <div class="bg-white p-3 border border-secondary rounded">
                    <form method="POST" action="index.php?file=documents.php" enctype="multipart/form-data">
                      <div class="mb-3">
                        <label for="fileupload" class="form-label">Téléverser un document :</label>
                        <input class="form-control form-control-lg" id="fileupload" type="file" name="file">
                      </div>
                      <div class="d-grid">
                        <button type="submit" name="submit" class="btn btn-dark text-light">Téléverser</button>
                      </div>
                    </form>
                    </div>               
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