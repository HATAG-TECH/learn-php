<?php
// Student marks
$math = 85;
$physics = 72;
$chemistry = 90;

// Arithmetic + Assignment
$total = $math + $physics + $chemistry;
$count = 3;

$average = $total / $count;  // Arithmetic

// Increment operator (bonus mark)
$average++;  // Add 1 bonus mark

// Comparison + Logical operators
$passed = ($math >= 50 && $physics >= 50 && $chemistry >= 50);

// Ternary operator for grade
$grade = ($average >= 80) ? "A" :
         (($average >= 60) ? "B" : "C");

// Null coalescing (if nickname not set)
$nickname = null;
$displayName = $nickname ?? "Student";

// String concatenation + output
echo "Name: " . $displayName . "<br>";
echo "Total Marks: " . $total . "<br>";
echo "Average (with bonus): " . $average . "<br>";
echo "Grade: " . $grade . "<br>";

// Final result using logical + ternary
$result = ($passed) ? "PASSED" : "FAILED";
echo "Final Result: " . $result;
?>
