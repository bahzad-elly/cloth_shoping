<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "cloth_shop";

try {
    $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8",$user,$pass);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
