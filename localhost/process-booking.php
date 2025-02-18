<?php
session_start();
include("connect.php");

if (!isset($_SESSION['username'])) { 
    header("Location: form-login.php");
    exit();
}
// ดึง ID ผู้ใช้จากและ username จาก session
if (isset($_GET['activity_id'])) {
    $activity_id = $_GET['activity_id'];
    $user_id = $_SESSION['id']; 
    $username = $_SESSION['username']; 

//เคยจองหรือยัง
    $sql_check = "SELECT * FROM bookings WHERE activity_id = ? AND user_id = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("ii", $activity_id, $user_id);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        echo "คุณได้ทำการจองกิจกรรมนี้ไปแล้ว";
        exit();
    }

    $sql_select_title = "SELECT title FROM activities WHERE id = ?";
    $stmt_select_title = $conn->prepare($sql_select_title);
    $stmt_select_title->bind_param("i", $activity_id);
    $stmt_select_title->execute();
    $result_select_title = $stmt_select_title->get_result();

    if ($result_select_title->num_rows > 0) {
        $row_title = $result_select_title->fetch_assoc();
        $title = $row_title['title'];
    } else {
        $title = "ท่านยังไม่ได้จองกิจกรรม"; 
    }

    $sql_insert = "INSERT INTO bookings (activity_id, user_id, username, title, booking_date) VALUES (?, ?, ?, ?, CURRENT_TIMESTAMP)";
    $stmt_insert = $conn->prepare($sql_insert);
    $stmt_insert->bind_param("iiss", $activity_id, $user_id, $username, $title);

    if ($stmt_insert->execute()) {
        echo "ทำการจองกิจกรรมสำเร็จ";
        header("Location: activity-detail.php?activity_id=" . $activity_id);
        exit();
    } else {
        echo "เกิดข้อผิดพลาดในการจองกิจกรรม: " . $conn->error;
    }
} else {
    echo "ไม่ได้ระบุ ID กิจกรรม";
}

$conn->close();
?>
