<?php
  if(isset($_GET['error']) && !empty($_GET['error'])) {
    echo '<div class="text-center pt-2 text-danger">';
    echo $_GET['error'];
    echo '</div>';
  }
  if(isset($error) && !empty($error)) {
    echo '<div class="text-center pt-2 text-danger">';
    echo $error;
    echo '</div>';
  }
  if(isset($_GET['message']) && !empty($_GET['message'])) {
    echo '<div class="text-center pt-2 text-success">';
    echo $_GET['message'];
    echo '</div>';
  }
  if(isset($message) && !empty($message)) {
    echo '<div class="text-center pt-2 text-success">';
    echo $message;
    echo '</div>';
  }
?>