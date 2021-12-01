<?php
    function CreationCoupon($i){
        $bdd = new PDO('mysql:host=localhost;dbname=projet_web;charset=utf8', 'root', '');
        $j = 0;
        while($j < $i){
            $code = random_bytes(5);
            $selectID = $bdd->query("SELECT id FROM users ORDER BY rand() LIMIT 1");
            $selectID->execute();
            $A = $selectID->fetch();
            $insertnewcoupon = $bdd->prepare("INSERT INTO coupon(code, status, userid) VALUES(?, ?, ?)");
            $insertnewcoupon->execute(array($code,0,$A['id']));
            $j++;
        }
    }


?>