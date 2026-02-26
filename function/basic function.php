// basic function
<?php
function sayHello(){
    echo "Hello Hatag!";
}

sayHello(); // calling the function
?>

// function with parameter

<?php
function greet($name){
    echo "Hello " . $name . "<br>";
}

greet("Hatag");
greet("John");
?>

// function with return value
<?php
function add($a, $b){
    return $a + $b;
}

$result = add(10, 5);
echo $result; // 15
?>
// function with default parameter
<?php
function greet($name = "Guest"){                    
    echo "Hello " . $name . "<br>";
}   
greet(); // Hello Guest
greet("Hatag"); // Hello Hatag
?>  
// function with variable number of arguments
<?php
function sum(...$numbers){
    $total = 0;
    foreach($numbers as $number){
        $total += $number;
    }
    return $total;
}   
echo sum(1, 2, 3); // 6
echo sum(4, 5); // 9
echo sum(10); // 10
?>  