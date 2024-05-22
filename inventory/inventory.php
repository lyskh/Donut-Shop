<?php
$servername = "localhost";
$username = "geov";
$password = "cea120323";
$dbname = "donut_shop";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

