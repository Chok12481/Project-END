<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['username'])) {
    header("Location: form-login.php");
    exit;
}

$username = $_SESSION['username'];

$stmt = $conn->prepare("SELECT * FROM account WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

// ตั้งค่า session id
$_SESSION['id'] = $user['id'];

// ดึงข้อมูลกิจกรรมจากตาราง activities
$sql_activities = "SELECT * FROM activities";
$result_activities = $conn->query($sql_activities);

if (!$result_activities) {
    echo "เกิดข้อผิดพลาดในการดึงข้อมูลกิจกรรม: " . $conn->error;
    exit;
}

$profile_image = ($username === 'admin') ? 'uploads/admin_images_account.jpg' : ($user['profile_image'] ?? 'uploads/default_profile.jpg');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: 'Arial', sans-serif;
            /* เปลี่ยนสีพื้นหลังเป็นสี #FC575E → #F7B42C */
            background: linear-gradient(to bottom, #FC575E, #F7B42C);
            margin: 0;
            padding: 0;
            color: #333;
        }

        .profile-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #064635;
            margin-bottom: 10px;
        }

        h2 {
            color: #064635;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }

        th {
            font-weight: bold;
            background-color: #f2f2f2;
        }

        .upload-form {
            margin-top: 20px;
        }

        .logout-button {
            margin-top: 20px;
        }

        .logout-button button {
            background-color: #064635;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .logout-button button:hover {
            background-color: #09814A;
        }

        /* CSS เพิ่มเติมสำหรับการออกแบบ */
        .container {
            max-width: 960px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .section {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            font-size: 1.2em;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .btn-primary {
            background-color: #064635;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #09814A;
        }

        /* เพิ่มเติม: ปรับขนาดรูปโปรไฟล์ให้เล็กลง */
        .profile-image {
            width: 100px;
            height: 100px;
        }

        /* เพิ่มเติม: จัดรูปแบบตารางให้สวยงามขึ้น */
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        /* เพิ่มเติม: จัดรูปแบบปุ่มให้อยู่ตรงกลางและมีระยะห่าง */
        .logout-button {
            text-align: center;
            margin-top: 20px;
        }

        .logout-button button {
            margin: 0 10px;
        }
        .activities-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); /* ปรับขนาด minmax ตามต้องการ */
            gap: 20px;
        }

        .activity-item {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease;
        }

        .activity-item:hover {
            transform: translateY(-5px);
        }

        .activity-title {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .activity-description {
            color: #777;
        }

        .activity-date {
            font-size: 0.8em;
            color: #999;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Welcome <br>
                <?php echo htmlspecialchars($user['username']); ?>!</h2>
            <img src="<?php echo $profile_image; ?>" alt="Profile Image" class="profile-image">
        </div>

        <div class="section">
            <div class="section-title">ข้อมูลส่วนตัว</div>
            <table>
                <tr>
                    <th><i class="fas fa-user"></i> ชื่อ</th>
                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                </tr>
                <tr>
                    <th><i class="fas.fa-map-marker-alt"></i> ที่อยู่</th>
                    <td><?php echo htmlspecialchars($user['address']); ?></td>
                </tr>
                <tr>
                    <th><i class="fas fa-phone"></i> เบอร์โทร</th>
                    <td><?php echo htmlspecialchars($user['phone']); ?></td>
                </tr>
                <tr>
                    <th><i class="fas fa-briefcase"></i> อาชีพ</th>
                    <td><?php echo htmlspecialchars($user['occupation']); ?></td>
                </tr>
                <tr>
                    <th><i class="fas fa-money-bill-wave"></i> รายได้</th>
                    <td><?php echo htmlspecialchars($user['income']); ?> บาท</td>
                </tr>
                <tr>
                    <th><i class="fas fa-info-circle"></i> ข้อมูลติดต่อเพิ่มเติม</th>
                    <td><?php echo htmlspecialchars($user['contact_info']); ?></td>
                </tr>
                <tr>
                    <th><i class="fas fa-tasks"></i> กิจกรรมตอนสมัครสมาชิก</th>
                    <td><?php echo htmlspecialchars($user['activities']); ?></td>
                </tr>
            </table>
        </div>

        <!-- เพิ่มส่วนแสดงรายการกิจกรรม -->
        <div class="container">
        <div class="section">
            <div class="section-title">กิจกรรม</div>
            <div class="activities-grid">
                <?php
                if ($result_activities->num_rows > 0) {
                    while ($activity = $result_activities->fetch_assoc()) {
                        echo '<div class="activity-item">';
                        echo '<div class="activity-title">';
                        echo '<a href="activity-detail.php?activity_id=' . $activity['id'] . '">' . htmlspecialchars($activity['title']) . '</a>';
                        echo '</div>';
                        echo '<div class="activity-description">' . htmlspecialchars($activity['description']) . '</div>'; // เพิ่ม description
                        echo '<div class="activity-date">' . htmlspecialchars($activity['date']) . '</div>'; // เพิ่ม date
                        echo '<div class="activity-time">' . htmlspecialchars($activity['time']) . '</div>'; // เพิ่ม date
                        echo '</div>';
                    }
                } else {
                    echo '<div>ไม่มีกิจกรรมในขณะนี้</div>';
                }
                ?>
            </div>
        </div>

        </div>
                
        <?php
        if ($user && $user['role'] === 'admin') {
        ?>
            <div class="section">
                <div class="section-title"><i class="fas fa-upload"></i> อัปโหลดรูปภาพโปรไฟล์</div>
                <form action="upload-profile.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="profile_image" required>
                    <button type="submit" class="btn-primary">อัปโหลด</button>
                </form>
            </div>
        <?php
        }
        ?>

        <center><div class="section">
            <div class="section-title"><i class="fas fa-sign-out-alt"></i> ออกจากระบบ</div>
            <a href="logout.php">
                <button type="submit" class="btn-primary">Logout</button>
            </a>
        </div>
    </div>
</body>
</html>
<?php
$conn->close();
?>