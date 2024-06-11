<?php
  define('WEP_APP_PAGE_TO_ROOT', './' );
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome !</title>
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
            <img src="./img/howto.png"></img>
          </div>
        </div>
      </div>
    </div>
    <script src="./js/bootstrap.min.js"></script>
  </body>
</html>