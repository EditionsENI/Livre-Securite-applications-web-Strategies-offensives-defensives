<?php
  if(isset($_GET['error']) && !empty($_GET['error'])) {
    echo '<div class="text-center pt-2 text-danger">';
    echo htmlspecialchars($_GET['error'], ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401);
    echo '</div>';
  }
  if(isset($error) && !empty($error)) {
    echo '<div class="text-center pt-2 text-danger">';
    echo htmlspecialchars($error, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401);
    echo '</div>';
  }
  if(isset($_GET['message']) && !empty($_GET['message'])) {
    echo '<div class="text-center pt-2 text-success">';
    echo htmlspecialchars($_GET['message'], ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401);
    echo '</div>';
  }
  if(isset($message) && !empty($message)) {
    echo '<div class="text-center pt-2 text-success">';
    echo htmlspecialchars($message, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401);
    echo '</div>';
  }
?>