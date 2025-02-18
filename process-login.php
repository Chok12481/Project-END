<?php
include 'connect.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        die("Username and password are required!");
    }

    $stmt = $conn->prepare("SELECT id, password, role FROM account WHERE username = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password, $role);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            session_regenerate_id(true);
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $id;
            $_SESSION['role'] = $role;

            if ($role === 'admin') {
                // ดึงข้อมูลจาก admin.php (ตัวอย่าง: ดึงชื่อ admin)
                $admin_name = getAdminName($conn, $username); // ฟังก์ชัน getAdminName() จะถูกกำหนดในภายหลัง

                // เก็บข้อมูล admin_name ไว้ใน session
                $_SESSION['admin_name'] = $admin_name;

                header("Location: admins.php");
            } else {
                header("Location: member.php");
            }
            exit;
        } else {
            echo "<script>alert('Invalid password!'); window.location='form-login.php';</script>";
        }
    } else {
        echo "<script>alert('User not found!'); window.location='form-login.php';</script>";
    }

    $stmt->close();
    $conn->close();
}

// ฟังก์ชันสำหรับดึงชื่อ admin จากฐานข้อมูล
function getAdminName($conn, $username) {
    $stmt = $conn->prepare("SELECT name FROM account WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($admin_name);
    $stmt->fetch();
    $stmt->close();
    return $admin_name;
}
?>