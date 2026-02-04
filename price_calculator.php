<?php
// Run only when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $itemName = $_POST["item"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];

    // Arithmetic operation
    $total = $price * $quantity;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Price Calculator</title>
    <style>
        body { font-family: Arial; background:#f2f2f2; }
        .box {
            width: 350px;
            margin: 60px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 8px gray;
        }
        input { width: 100%; padding: 8px; margin: 8px 0; }
        button { padding: 10px; width: 100%; }
        .result { margin-top:15px; font-weight: bold; }
    </style>
</head>
<body>

<div class="box">
    <h2>Item Price Calculator</h2>

    <form method="POST">
        <label>Item Name:</label>
        <input type="text" name="item" required>

        <label>Price per Item:</label>
        <input type="number" name="price" required>

        <label>Quantity:</label>
        <input type="number" name="quantity" required>

        <button type="submit">Calculate</button>
    </form>

    <?php if (isset($total)) { ?>
        <div class="result">
            Item: <?php echo $itemName; ?> <br>
            Total Price: <?php echo $total; ?>
        </div>
    <?php } ?>

</div>

</body>
</html>
