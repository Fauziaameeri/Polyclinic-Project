<?php

// Connect to database
$username = "shortcir_grcuser";
$password = "OkJTn=,{CL,7";
$hostname = "localhost";
$database = "shortcir_onydex";

$cnxn = @mysqli_connect($hostname, $username, $password, $database)
or die("Oops! We weren't able to connect to the database");
