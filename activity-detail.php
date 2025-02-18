<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: form-login.php");
    exit();
}

include("connect.php");

if (isset($_GET['activity_id'])) {
    $activity_id = $_GET['activity_id'];

    $sql = "SELECT * FROM activities WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $activity_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $activity = $result->fetch_assoc();
    } else {
        echo "ไม่พบกิจกรรม";
        exit();
    }
} else {
    echo "ไม่ได้ระบุ ID กิจกรรม";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายละเอียดกิจกรรม - <?php echo $activity['title']; ?></title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
    <center>
    <div class="container">
        <h2><?php echo $activity['title']; ?></h2>
        <img src="<?php echo $activity['image']; ?>" alt="<?php echo $activity['title']; ?>" style="max-width: 300px;">
        <p><?php echo $activity['description']; ?></p>
        <p><strong>วันที่:</strong> <?php echo $activity['date']; ?></p>
        <p><strong>เวลา:</strong> <?php echo $activity['time']; ?></p>
        <p><strong>สถานที่:</strong> <?php echo $activity['location']; ?></p>
        <p><strong>จำนวนที่นั่ง:</strong> <?php echo $activity['capacity']; ?></p>

        <a href="process-booking.php?activity_id=<?php echo $activity['id']; ?>">จองกิจกรรม</a>
        <a href="member.php">กลับไปยังหน้าสมาชิก</a>
    </div>
</body>
</html>
