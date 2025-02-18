<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    die("Access denied");
}

?>
