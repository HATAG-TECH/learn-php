<?php
$students = [
    ["name" => "Habtamu", "scores" => [70, 80, 90]],
    ["name" => "Etag", "scores" => [50, 55, 60]]
];

foreach ($students as $student) {
    $total = 0;
    $count = count($student["scores"]);

    foreach ($student["scores"] as $score) {
        $total += $score;
    }

    $average = $total / $count;

    echo "Name: " . $student["name"] . "<br>";
    echo "Average: " . $average . "<br>";

    if ($average >= 60) {
        echo "Status: Pass<br><br>";
    } else {
        echo "Status: Fail<br><br>";
    }
}
?>