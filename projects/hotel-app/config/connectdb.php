<?php
require 'config.php';

try {
  $dsn = 
    "mysql:host=$host;dbname=$db;charset=UTF8";
  $pdo = new PDO($dsn, $user, $pass);
  
// if($pdo) {
// echo "success"; //to get that connect works
// }
}

catch(PDOException $e) {
  echo $e->getMessage();
  
}

// -> arrow operator is used to access a method from an object arrow

// => double arrow operator, often used to bind values in an associative array

// :: it is used when accessing a property from a method ir in some cases private and global constants

?>