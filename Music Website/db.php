<?php
//must be replaced with individual server and database info
$dsn = 'mysql:host=localhost;dbname=music';
$username = 'root';
$password = '';
$options = [];
try {
    $connection = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
}
