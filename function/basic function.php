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