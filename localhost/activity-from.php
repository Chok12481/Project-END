<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<body>
    
</body>
</html>
<?php
include 'connect.php';

// ดึงข้อมูลกิจกรรมจากตาราง activities
$sql = "SELECT * FROM activities";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // มีข้อมูลกิจกรรม
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>" . $row["title"] . " (" . $row["date"] . " " . $row["time"] . ")" . "</li>"; // แสดงชื่อกิจกรรม, วันที่, และเวลา
    }
    echo "</ul>";
} else {
    // ไม่มีข้อมูลกิจกรรม
    echo "ไม่มีข้อมูลกิจกรรม";
}

$conn->close();
?>
