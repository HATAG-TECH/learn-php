<?php
$nums = [12, 5, 78, -3, 42];

$min = $nums[0];
$max = $nums[0];

foreach ($nums as $num) {
    if ($num < $min) {
        $min = $num;
    }
    if ($num > $max) {
        $max = $num;
    }
}

echo "Minimum = " . $min . "<br>";
echo "Maximum = " . $max;
?>