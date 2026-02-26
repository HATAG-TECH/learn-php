// example of function with parameters and return value
<?php
function calculateTotal($price, $quantity){
    return $price * $quantity;
}

$total = calculateTotal(100, 3);
echo "Total: " . $total;
?>

// example of function with form input
<?php
function calculateTotal($price, $quantity){
    return $price * $quantity;
}

if(isset($_POST["submit"])){
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];
    $total = calculateTotal($price, $quantity);
}
?>

<form method="post">
    Price: <input type="number" name="price"><br>
    Quantity: <input type="number" name="quantity"><br>
    <input type="submit" name="submit">
</form>

<?php
if(isset($total)){
    echo "Total: " . $total;
}
?>