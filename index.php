

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="index.php" method="get">

        <label for="quantity">quantity</label>
        <input type="text" name="quantity" id="quantity">
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
$quantity=$_GET["quantity"];
$total=$price*$quantity;
echo "total is:{$total}";
echo "My name is " . $name . "<br>";
echo "I am " . $age . " years old.<br>";
echo "I live in " . $country;
?>
