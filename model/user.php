<?php
  class User{
    private int $id;
    private string $LastName;
    private string $FirstName;
    private string $Email;
    private string $Password;
    private int $isAdmin;
    public function __construct($ID, $ln, $fn, $mail, $pwd,$admin){
      $this->id = $ID;
      $this->LastName = $ln;
      $this->FirstName = $fn;
      $this->Email = $mail;
      $this->Password = $pwd;
      $this->isAdmin = $admin;
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
    public function getAdminStatus(){
      return $this->isAdmin;
    }
  }

 ?>
