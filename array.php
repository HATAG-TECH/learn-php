<?php

$foods=array("Avocado","Potato","garlic","Onion","Banana");
// echo $foods[0]."<br>";
// echo $foods[1]."<br>";
// echo $foods[2]."<br>";
// echo $foods[3]."<br>";
// echo $foods[4]."<br>";
// echo $foods[5]."<br>";
// $foods[4]="Mango";
// array_push($foods,"Tomato","pineapapple");
// array_pop($foods);
// array_shift($foods);
// $foods=array_reverse($foods);
foreach($foods as $food){
    echo $food."<br>";
}
echo count($foods);


$capitals=array("Ethiopia"=>"Addis Ababa",
                "USA"=>"Washington D.C",
                "Rusia"=>"Moscow",
                "Turkiye"=>"Ankara",
                "Eritrea"=>"Asmara");


// $capitals["China"]="bejing";
// array_pop($capitals);
// array_shift($capitals);  
// $keys=array_keys($capitals);
// echo "<br> <strong> Country Capital-City </strong> <br>";
//  foreach($keys as $key){
//                     echo "{$key} <br>";
//                 }




// $values=array_values($capitals);
// echo "<br> <strong> Country Capital-City </strong> <br>";
//  foreach($values as $value){
//                     echo "{$value} <br>";
//                 }



// $flipped=array_flip($capitals);
// echo "<br> <strong> Country Capital-City </strong> <br>";
//  foreach($flipped as $key=>$value){
//                     echo "{$key} = {$value} <br>";
//                 }


// $reversed=array_reverse($capitals);
// echo "<br> <strong> Country Capital-City </strong> <br>";
//  foreach($reversed as $key=>$value){
//                     echo "{$key} = {$value} <br>";
//                 }



                echo "<br> <strong> Country Capital-City </strong> <br>";
                foreach($capitals as $key=>$value){
                    echo "{$key} <b> = </b>{$value} <br>";
                }

echo count($capitals);








?>