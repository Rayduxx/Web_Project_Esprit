<?php
  class User{
    private int $id;
    private string $LastName;
    private string $FirstName;
    private string $Email;
    private string $Password;
    public function __construct($ID, $ln, $fn, $mail, $pwd){
      $this->id = $ID;
      $this->LastName = $ln;
      $this->FirstName = $fn;
      $this->Email = $mail;
      $this->Password = $pwd
    }
    public function getId(){
      return $this->id;
    }
    public function getLastName(){
      return $this->LastName;
    }
    public function getFirstName(){
      return $this->FirstName;
    }
    public function getEmail(){
      return $this->Email;
    }
    public function getPassword(){
      return $this->Password;
    }
  }

 ?>
