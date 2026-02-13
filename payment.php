<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<form action="payment.php" method="post">

    <input type="radio" name="credit-card" value="Master-Card">Master-Card <br>
    <input type="radio" name="credit-card" value="Visa">Visa <br>
    <input type="radio" name="credit-card" value="American-Express">American-Express <br>
    <input type="submit" name="confirm" value="confirm">

</form>

</body>
</html>


<?php

$selected=$_POST["credit-card"];
$confirmed=$_POST["confirm"];
if(isset($confirmed)){
    echo "you selected {$selected}";
}

?>