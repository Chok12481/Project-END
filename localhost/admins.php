<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    die("Access Denied.");
}

// ดึง username ของ admin จาก session
$username = $_SESSION['username'];

// ดึงข้อมูล admin จากฐานข้อมูล
$stmt = $conn->prepare("SELECT * FROM account WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

// ตรวจสอบว่ามีข้อมูล admin หรือไม่
if ($result->num_rows > 0) {
    $admin = $result->fetch_assoc();
} else {
    die("Admin not found."); // หรือจัดการข้อผิดพลาดอื่นๆ ตามความเหมาะสม
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="styles.css">
    <title>ระบบหลังบ้าน</title>
    <style>
        /* CSS สำหรับ member.php และ form-login.php */
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to bottom, #FC575E, #F7B42C);
            margin: 0;
            padding: 0;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
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
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Welcome ADMIN <br>
                <?php echo htmlspecialchars($admin['name']); ?>!</h2>
        </div>

        <div class="section">
            <div class="section-title">ข้อมูลส่วนตัว</div>
            <table>
                <tr>
                    <th><font color="black">ID</th>
                    <td><?php echo $admin['id']; ?></td>
                </tr>
                <tr>
                    <th><font color="black">Username</th>
                    <td><?php echo $admin['username']; ?></td>
                </tr>
                <tr>
                    <th><font color="black">Email</th>
                    <td><?php echo $admin['email']; ?></td>
                </tr>
                <tr>
                    <th><font color="black">name</th>
                    <td><?php echo $admin['name']; ?></td>
                </tr>
            </table>
            <a href="manage_members.php">
                <button type="submit" class="btn-primary">Manage Members</button><br>
            </a>
            <a href="report.php">ออกรายงาน</a>
        </div>

        <div class="section">
            <div class="section-title">ออกจากระบบ</div>
            <a href="logout.php">
                <button type="submit" class="btn-primary">Logout</button>
            </a>
        </div>
    </div>
</body>

</html>