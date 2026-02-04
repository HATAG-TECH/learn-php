

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="index.php" method="post">

        <!-- <label for="quantity">quantity</label>
        <input type="text" name="quantity" id="quantity"> -->

        <label for="x">x:</label>
        <input type="text" name="x" id="x"> <br>
         <label for="y">y:</label>
        <input type="text" name="y" id="y">
        <input type="submit" value="total">
    </form>
</body>
</html>
<?php
echo "PHP is working!<br>";

$name = "Hatag";
$age = 20;
$price=30;
$country = "Ethiopia";
// $quantity=$_POST["quantity"];
$x=$_POST["x"];
$y=abs($_POST["y"]);
// $total=abs($price*$quantity);
$result=null;
$result=pow($x,$y);
echo "result:" . $result ."<br>";
// echo "total is:{$total}";
echo "My name is " . $name . "<br>";
echo "I am " . $age . " years old.<br>";
echo "I live in " . $country;
?>
