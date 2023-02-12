<?php
//sessions
session_start();
$_SESSION['username'] = "Emma";
$_SESSION['password'] = "coding";
echo "Session data is saved";
?>