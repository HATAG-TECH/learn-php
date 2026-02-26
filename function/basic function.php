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