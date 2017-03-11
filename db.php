<?php

// properties for the connection
$host = "localhost";
$dbName = "susan-warehouse";
$user = "root";
$password = "";

// connect the base
$db = new PDO("mysql:host={$host};dbname={$dbName};charset=utf8", $user, $password);