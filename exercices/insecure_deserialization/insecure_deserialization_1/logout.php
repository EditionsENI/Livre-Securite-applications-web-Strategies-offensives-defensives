<?php
  define('WEP_APP_PAGE_TO_ROOT', './../../../' );
  include_once __DIR__ . '/config/const.php';
  include_once __DIR__ . '/inc/user.php';
  
  session_start();
  setcookie(EXERCICE, '', time() - 3600);
  $params = session_get_cookie_params();
  setcookie(session_name(), '', 0, $params['path'], $params['domain'], $params['secure'], isset($params['httponly']));
  $_SESSION = array();

  header('Location: index.php');
  die;
?>