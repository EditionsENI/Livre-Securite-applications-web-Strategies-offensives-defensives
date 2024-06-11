<?php
  class User {
    public $username;
    public $password;
    public $firstname;
    public $lastname;
    public $role;

    public function __construct($username, $password, $firstname, $lastname, $role = "user") {
      $this->username = $username;
      $this->firstname = $firstname;
      $this->lastname = $lastname;
      $this->password = $password;
      $this->role = $role;
    }

    public function __toString() {
      return "<p>Merci " . htmlspecialchars($this->firstname, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401) . " " . htmlspecialchars($this->lastname, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401) . " d'avoir utilisé notre nouvelle fonctionnalité \"Remember Me !\".</p>";
    }
  }
?>