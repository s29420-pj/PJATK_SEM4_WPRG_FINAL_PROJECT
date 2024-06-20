<?php
require_once './config.php';

$connection = new mysqli(DB_NAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}