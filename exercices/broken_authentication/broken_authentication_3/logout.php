<?php
  session_start();
  $params = session_get_cookie_params();
  setcookie(session_name(), '', 0, $params['path'], $params['domain'], $params['secure'], isset($params['httponly']));

  
  header('Location: index.php');
  die;
?>