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
  }
?>