<?php
session_start();
include 'connect.php';
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    die("Access Denied.");
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM account WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        header("Location: manage_members.php"); 
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>