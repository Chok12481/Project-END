<?php
session_start();
include 'connect.php';
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    die("<center><h1><br><br><br><br><br><br><br><br><br><br>คุณไม่ใช่แอดมินนะครับ!");
}

// ตรวจสอบว่ามีการส่ง ID มาหรือไม่
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // ป้องกัน SQL Injection โดยใช้ prepared statement
    $sql = "SELECT * FROM account WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id); // "i" หมายถึง integer
    $stmt->execute();
    $result = $stmt->get_result();

    // ตรวจสอบว่าพบสมาชิกหรือไม่
    if ($result->num_rows > 0) {
        $member = $result->fetch_assoc();
    } else {
        // หากไม่พบสมาชิก ให้กำหนดค่า $member เป็น array ว่าง หรือ redirect ไปหน้าอื่น
        $member = []; // หรือ header("Location: manage_members.php"); exit();
        echo "<script>alert('ไม่พบสมาชิก'); window.location.href='manage_members.php';</script>";
    }
    $stmt->close();
} else {
    // หากไม่มี ID ให้ redirect ไปหน้าอื่น หรือแสดงข้อความผิดพลาด
    header("Location: manage_members.php");
    exit();
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];

    // รับค่าจากฟอร์ม
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password']; // เพิ่มฟิลด์ password
    $address = $_POST['address']; // เพิ่มฟิลด์ address
    $phone = $_POST['phone']; // เพิ่มฟิลด์ phone
    $occupation = $_POST['occupation']; // เพิ่มฟิลด์ occupation
    $income = $_POST['income']; // เพิ่มฟิลด์ income
    $contact_info = $_POST['contact_info']; // เพิ่มฟิลด์ contact_info
    $activities = $_POST['activities'] ?? ''; // รับค่า activities
    $role = $_POST['role']; // เพิ่มฟิลด์ role

    // ปรับปรุงคำสั่ง SQL ให้รวมฟิลด์อื่นๆ
    $sql = "UPDATE account SET 
            username = ?, 
            email = ?, 
            password = ?,
            address = ?,
            phone = ?,
            occupation = ?,
            income = ?,
            contact_info = ?,
            activities = ?,
            role = ?
            WHERE id = ?";

    // ใช้ prepared statement เพื่อป้องกัน SQL Injection
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssi", $username, $email, $password, $address, $phone, $occupation, $income, $contact_info, $activities, $role, $id);

    if ($stmt->execute()) {
        header("Location: manage_members.php");
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();
?>


<!DOCTYPE html>
<html>
<head>
    <title> เพิ่ม ลบ แก้ไข ข้อมูลสมาชิก </title>
    <style>
        /* ปรับปรุง CSS ตามความเหมาะสม */
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #FC575E, #F7B42C);
            margin: 0;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            width: 50%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #3e8e41;
        }
    </style>
</head>
<body>
    <form method="post">
        <h1>เพิ่ม ลบ แก้ไข ข้อมูลสมาชิก</h1>

        <!-- ตรวจสอบว่า $member ถูกกำหนดค่าก่อน -->
        <?php if (isset($member)): ?>
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($member['id']); ?>">

            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($member['username'] ?? ''); ?>"><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($member['email'] ?? ''); ?>"><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($member['password'] ?? ''); ?>"><br>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($member['address'] ?? ''); ?>"><br>

            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($member['phone'] ?? ''); ?>"><br>

            <label for="occupation">Occupation:</label>
            <input type="text" id="occupation" name="occupation" value="<?php echo htmlspecialchars($member['occupation'] ?? ''); ?>"><br>

            <label for="income">Income:</label>
            <input type="text" id="income" name="income" value="<?php echo htmlspecialchars($member['income'] ?? ''); ?>"><br>

            <label for="contact_info">Contact Info:</label>
            <input type="text" id="contact_info" name="contact_info" value="<?php echo htmlspecialchars($member['contact_info'] ?? ''); ?>"><br>

            <label for="activities">Activities:</label>
            <select id="activities" name="activities">
                <option value="ร้องเพลง" <?php if (($member['activities'] ?? '') == 'ร้องเพลง') echo 'selected'; ?>>ร้องเพลง</option>
                <option value="เต้น" <?php if (($member['activities'] ?? '') == 'เต้น') echo 'selected'; ?>>เต้น</option>
                <option value="ฝึกสอนดนตรีไทย" <?php if (($member['activities'] ?? '') == 'ฝึกสอนดนตรีไทย') echo 'selected'; ?>>ฝึกดนตรีไทย</option>
                <option value="ฝึกสอนฟุตซอล" <?php if (($member['activities'] ?? '') == 'ฝึกสอนฟุตซอล') echo 'selected'; ?>>ฝึกฟุตซอล</option>
                <option value="ฝึกฝีมือส่งเสริมอาชีพ" <?php if (($member['activities'] ?? '') == 'ฝึกฝีมือส่งเสริมอาชีพ') echo 'selected'; ?>>ฝึกฝีมือส่งเสริมอาชีพ</option>
            </select><br>

            <label for="role">Role:</label>
            <select id="role" name="role">
                <option value="admin" <?php if (($member['role'] ?? '') == 'admin') echo 'selected'; ?>>Admin</option>
                <option value="member" <?php if (($member['role'] ?? '') == 'member') echo 'selected'; ?>>Member</option>
            </select><br>

            <button type="submit" name="update"> ปรับ </button>
        <?php else: ?>
            <p>ไม่พบข้อมูลสมาชิก</p>
        <?php endif; ?>
    </form>
</body>
</html>
