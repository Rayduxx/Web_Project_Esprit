<?php
class config{
  private static $pdo = NULL;
  public static function getConnexion(){
    if(!isset(self::$pdo)){
                try{
                    self::$pdo = new PDO('mysql:host=localhost;dbname=projet_web;charset=utf8', 'root','',
                        [
                            PDO::ATTR_ERRMODE =>PDO::ERRMODE_EXCEPTION,
                            PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC
                    ]);
                } catch (Exception $e){
                    die('Erreur :'. $e->getMessage());
                }
            }
            return self::$pdo;
        }
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
if(isset($_COOKIE['accept_cookie'])) {
  $showcookie = false;
} else {
  $showcookie = true;
}
?>
