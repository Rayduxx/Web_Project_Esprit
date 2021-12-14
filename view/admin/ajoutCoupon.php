<?php
include_once "../../controller/couponC.php";
if(isset($_POST['formCoupon'])){
$nombre = htmlspecialchars($_POST['nombre']);
if(!empty($_POST['nombre'])){
CreationCoupon($nombre);

}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>generer coupon</title>
</head>
<body>
    <form method="post">
        <input type="number" id="nombre" name="nombre" value="1">
        <button type="submit" name="formCoupon" >create Coupon</button>
    </form>
</body>
</html>

