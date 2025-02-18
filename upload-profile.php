<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    die("Access Denied");
}

$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile_image'])) {
    $target_dir = "uploads/";
    // สร้างชื่อไฟล์ใหม่โดยใช้ UUID
    $file_name = uniqid() . "_" . basename($_FILES["profile_image"]["name"]);
    $target_file = $target_dir . $file_name;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $allowed_types = ["jpg", "jpeg", "png", "gif"];
    if (!in_array($imageFileType, $allowed_types)) {
        die("Only JPG, JPEG, PNG & GIF files are allowed.");
    }

    if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
        $stmt = $conn->prepare("UPDATE account SET profile_image = ? WHERE username = ?");
        $stmt->bind_param("ss", $target_file, $username);
        $stmt->execute();
        $stmt->close();

        // เปลี่ยน URL ที่ redirect ไปเป็น admins.php
        echo "<script>alert('อัปโหลดรูปภาพสำเร็จ!'); window.location='admins.php';</script>";
    } else {
        echo "<script>alert('อัปโหลดรูปภาพไม่สำเร็จ!'); window.location='admins.php';</script>";
    }
}

$conn->close();
?>