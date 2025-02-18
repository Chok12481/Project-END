<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $occupation = $_POST['occupation'];
    $income = $_POST['income'];
    $contact_info = $_POST['contact_info'];

    // รับค่ากิจกรรมที่เลือก
    $activities = isset($_POST['activities']) ? implode(",", $_POST['activities']) : '';

    // การจัดการรูปภาพ
    $profile_image = 'uploads/default_profile.jpg'; // กำหนดรูปเริ่มต้น
    if (isset($_FILES["profile_image"]) && $_FILES["profile_image"]["error"] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["profile_image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // ตรวจสอบว่าเป็นไฟล์รูปภาพจริงหรือไม่
        $check = getimagesize($_FILES["profile_image"]["tmp_name"]);
        if ($check === false) {
            echo "ไม่ใช่ไฟล์รูปภาพ";
            exit;
        }

        // อนุญาตเฉพาะบางนามสกุลไฟล์
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "อนุญาตเฉพาะไฟล์ JPG, JPEG, PNG & GIF เท่านั้น";
            exit;
        }

        // ย้ายไฟล์ไปยัง directory ที่กำหนด
        if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
            $profile_image = $target_file;
        } else {
            echo "เกิดข้อผิดพลาดในการอัปโหลดไฟล์";
            exit;
        }
    }

    // เตรียมคำสั่ง SQL
    $stmt = $conn->prepare("INSERT INTO account (email, username, password, address, phone, occupation, income, contact_info, profile_image, activities) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // hash password ก่อนบันทึก
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // ผูกตัวแปรกับคำสั่ง SQL
    $stmt->bind_param("ssssssssss", $email, $username, $hashed_password, $address, $phone, $occupation, $income, $contact_info, $profile_image, $activities);

    // execute the query
    if ($stmt->execute()) {
        echo "สมัครสมาชิกสำเร็จ";
        header("Location: form-login.php");
    } else {
        echo "เกิดข้อผิดพลาดในการสมัครสมาชิก: " . $stmt->error;
    }

    // close connection
    $stmt->close();
    $conn->close();
}
?>
