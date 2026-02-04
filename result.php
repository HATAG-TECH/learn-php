<?php
// ===== PHP LOGIC PART =====
$math = 85;
$physics = 72;
$chemistry = 90;

$total = $math + $physics + $chemistry;
$average = ($total / 3);
$average++; // bonus mark

$passed = ($math >= 50 && $physics >= 50 && $chemistry >= 50);

$grade = ($average >= 80) ? "A" :
         (($average >= 60) ? "B" : "C");

$nickname = null;
$name = $nickname ?? "Student";

$result = ($passed) ? "PASSED" : "FAILED";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Result</title>
    <style>
        body { font-family: Arial; background:#f2f2f2; }
        .card {
            width: 400px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px gray;
        }
        h2 { text-align: center; }
        .pass { color: green; font-weight: bold; }
        .fail { color: red; font-weight: bold; }
    </style>
</head>
<body>

<div class="card">
    <h2>Student Report</h2>

    <p><strong>Name:</strong> <?php echo $name; ?></p>
    <p><strong>Math:</strong> <?php echo $math; ?></p>
    <p><strong>Physics:</strong> <?php echo $physics; ?></p>
    <p><strong>Chemistry:</strong> <?php echo $chemistry; ?></p>

    <hr style="height:20px;background-color:light-gray">

    <p><strong>Total:</strong> <?php echo $total; ?></p>
    <p><strong>Average (with bonus):</strong> <?php echo $average; ?></p>
    <p><strong>Grade:</strong> <?php echo $grade; ?></p>

    <p>
        <strong>Final Result:</strong>
        <span class="<?php echo ($passed) ? 'pass' : 'fail'; ?>">
            <?php echo $result; ?>
        </span>
    </p>
</div>

</body>
</html>
