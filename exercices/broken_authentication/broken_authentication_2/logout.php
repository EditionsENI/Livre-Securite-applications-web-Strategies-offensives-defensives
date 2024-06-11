<?php
  ini_set("session.cookie_httponly", 1);
  session_start();
  $params = session_get_cookie_params();
  setcookie(session_name(), '', 0, $params['path'], $params['domain'], $params['secure'], isset($params['httponly']));
  $_SESSION = array();

  header('Location: index.php');
  die;
?>