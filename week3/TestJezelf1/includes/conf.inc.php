<?php
$host = "localhost";
$user = "root";
$pasw = "";
$db = "php1w32";

$PDO = new PDO("mysql:host=$host; dbname=$db","$user", "$pasw");
$PDO->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
?>