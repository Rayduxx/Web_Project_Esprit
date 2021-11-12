<?php
session_start();
try {
    $bdd = new PDO('mysql:host=localhost;dbname=projet_web;charset=utf8', 'root', '');
}
catch(Exception $e)
{
	die('Echec de connexion à la base de donnée : '.$e->getMessage());
}
function encryptCookie($value){
   if(!$value){return false;}
   $key = 'JCYJhBa3SQtrt1RxWWmBsC8qifO28A40';
   $text = $value;
   $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
   $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
   $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $text, MCRYPT_MODE_ECB, $iv);
   return trim(base64_encode($crypttext));
}
function decryptCookie($value){
   if(!$value){return false;}
   $key = 'JCYJhBa3SQtrt1RxWWmBsC8qifO28A40';
   $crypttext = base64_decode($value);
   $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
   $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
   $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $crypttext, MCRYPT_MODE_ECB, $iv);
   return trim($decrypttext);
}

if(!isset($_SESSION['id']) AND isset($_COOKIE['email'],$_COOKIE['password']) AND !empty($_COOKIE['email']) AND !empty($_COOKIE['password'])) {
    $email = $_COOKIE['email'];
    $mdp = $_COOKIE['password'];
    $requser = $bdd->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $requser->execute(array($email,$mdp));
    $userexist = $requser->rowCount();
    if($userexist == 1)
    {
        $userinfo = $requser->fetch();
        $_SESSION['id'] = $userinfo['id'];
        $_SESSION['email'] = $userinfo['email'];
        $_SESSION['email'] = $userinfo['email'];
    }
}
if(isset($_COOKIE['accept_cookie'])) {
      $showcookie = false;
    } else {
      $showcookie = true;
    }
?>
