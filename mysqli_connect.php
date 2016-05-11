<?php # Script 8.2 - mysqli_connect.php

// This file contains the database access information. 
// This file also establishes a connection to MySQL 
// and selects the database.

// Set the database access information as constants:
DEFINE ('DB_USER', 'fses16g9');
DEFINE ('DB_PASSWORD', 'fses16g9');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'fses16g9');

// Make the connection:
$dbc = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );

?>