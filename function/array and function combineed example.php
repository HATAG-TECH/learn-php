
// ===== COMBINING ARRAYS AND FUNCTIONS =====
<?php
// ===== ARRAY OF PRODUCTS =====
$products = [
    ["name" => "Phone", "price" => 500],
    ["name" => "Laptop", "price" => 1200],
    ["name" => "Tablet", "price" => 300]
];

// ===== FUNCTION TO CALCULATE TOTAL =====
function calculateTotal($price, $quantity){
    return $price * $quantity;
}

// ===== FUNCTION TO FIND PRODUCT BY NAME =====
function findProduct($products, $selectedName){
    foreach($products as $product){
        if($product["name"] == $selectedName){
            return $product;
        }
    }
    return null;
}

// ===== HANDLE FORM =====
if(isset($_POST["buy"])){

    $selectedName = $_POST["product"];
    $quantity = $_POST["quantity"];

    $product = findProduct($products, $selectedName);

    if($product){
        $total = calculateTotal($product["price"], $quantity);
    }
}
?>

<!DOCTYPE html>
<html>
<body>

<h2>Mini Shop</h2>

<form method="post">

    <label>Select Product:</label>
    <select name="product">
        <?php foreach($products as $product){ ?>
            <option value="<?php echo $product["name"]; ?>">
                <?php echo $product["name"]; ?>
            </option>
        <?php } ?>
    </select>
    <br><br>

    <label>Quantity:</label>
    <input type="number" name="quantity" required>
    <br><br>

    <input type="submit" name="buy" value="Buy">

</form>

<?php if(isset($total)){ ?>
    <h3>Order Summary</h3>
    Product: <?php echo $selectedName; ?> <br>
    Quantity: <?php echo $quantity; ?> <br>
    Total Price: $<?php echo $total; ?>
<?php } ?>

</body>
</html>


// ===== ANOTHER EXAMPLE: STUDENT GRADES =====

<?php
function calculateAverage($marks){
    $total = 0;

    foreach($marks as $mark){
        $total += $mark;
    }

    return $total / count($marks);
}

function getGrade($average){
    if($average >= 80){
        return "A";
    }
    elseif($average >= 60){
        return "B";
    }
    else{
        return "C";
    }
}

$marks = [85, 72, 90];

$average = calculateAverage($marks);
$grade = getGrade($average);

echo "Average: " . $average . "<br>";
echo "Grade: " . $grade;
?>