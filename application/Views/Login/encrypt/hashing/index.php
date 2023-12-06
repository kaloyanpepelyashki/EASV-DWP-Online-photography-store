<?php
$setPass = $_GET['setPass'];
$iterations = ['cost' => 15];
$Hpass = password_hash($setPass, PASSWORD_BCRYPT, $iterations);

echo "This is the hashed password: " . $Hpass . "<br>";
echo "The length of the string is " . strlen($Hpass);
?>