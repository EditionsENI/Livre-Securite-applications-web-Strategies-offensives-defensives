<?php
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
  $params = session_get_cookie_params();
  setcookie(session_name(), '', 0, $params['path'], $params['domain'], $params['secure'], isset($params['httponly']));
  $_SESSION = array();

  header("Location: index.php?lang=" . $lang);
  die;
?>