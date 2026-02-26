// example of function with parameters and return value
<?php
function calculateTotal($price, $quantity){
    return $price * $quantity;
}

$total = calculateTotal(100, 3);
echo "Total: " . $total;
?>