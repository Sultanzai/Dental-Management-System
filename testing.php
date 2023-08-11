<?php
// $pass ="Khatira@2023";
// $pass = "Azka@2023";
$pass = "NewUser";
$hash = password_hash($pass, PASSWORD_DEFAULT);

echo "Hashed Password Generated: ".$hash;

$test ='$2y$10$T647f5iSqWFRUBbomIWYGuANtLtg73QMrZTmUORNvyn.yPY50vWWm';

if(password_verify($pass, $test)){
    echo " <br> SUCCESS";
}
else{
    echo " <br> Failed";
}

?>