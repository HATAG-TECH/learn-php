<?php
$score = 85; // Change this value (0–100)

if ($score >= 90 && $score <= 100) {
    echo "Grade: A - Excellent";
} elseif ($score >= 80) {
    echo "Grade: B - Very Good";
} elseif ($score >= 70) {
    echo "Grade: C - Good";
} elseif ($score >= 60) {
    echo "Grade: D - Pass";
} elseif ($score >= 0) {
    echo "Grade: F - Fail";
} else {
    echo "Invalid Score";
}
?>