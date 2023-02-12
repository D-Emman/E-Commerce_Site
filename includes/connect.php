<?php

$con = mysqli_connect('localhost','Emmanuel','learningnode','mystore');
if(!$con){
    // die(mysqli_error($con))
    echo "connection Unsuccessful";
}

?>