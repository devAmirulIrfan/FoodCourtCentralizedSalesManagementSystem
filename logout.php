<?php
session_start();
echo "this is logout";
print_r($_SESSION);

// unset all the variables
session_unset();

// destroy the session
session_destroy();

// Set the location
header('Location:./');
?>