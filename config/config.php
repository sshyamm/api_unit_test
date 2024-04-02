<?php

// Database configuration
$dbHost = 'localhost'; // Change this to your database host
$dbName = 'music_academy'; // Change this to your database name
$dbUser = 'root'; // Change this to your database username
$dbPassword = ''; // Change this to your database password

// Establish database connection
try {
    $db = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPassword);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}
