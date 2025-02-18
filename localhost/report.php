<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    die("Access Denied.");
}

if (isset($_GET['year'])) {
    $year = $_GET['year'];
    $sql_bookings = "SELECT a.title, COUNT(b.user_id) AS total_bookings 
                     FROM activities a
                     LEFT JOIN bookings b ON a.id = b.activity_id
                     WHERE YEAR(b.booking_date) = '$year'
                     GROUP BY a.title";
    $result_bookings = $conn->query($sql_bookings);
}

$sql_members = "SELECT * FROM account WHERE role = 'member'";
$result_members = $conn->query($sql_members);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายงาน</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        .container {
            margin-top: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        form {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <button onclick="history.back()"><a href="#" onclick="history.back()">ย้อนกลับ</button></a>
    <div class="container">
        <h1>รายงานสรุปการจองกิจกรรมประจำปี</h1>
        <form method="get">
            <div class="form-group">
                <label for="year">ปี:</label>
                <input type="number" name="year" id="year" class="form-control" value="<?php echo isset($year) ? $year : date('Y'); ?>">
            </div>
            <button type="submit" class="btn btn-primary">ดูรายงาน</button>
        </form>

        <?php if (isset($result_bookings) && $result_bookings->num_rows > 0) : ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>กิจกรรม</th>
                        <th>จำนวนผู้จอง</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row_bookings = $result_bookings->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo $row_bookings['title']; ?></td>
                            <td><?php echo $row_bookings['total_bookings']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
<?php elseif (isset($year)) : ?>
<p>ไม่มีข้อมูลการจองในปี <?php echo $year; ?></p>
<?php endif; ?>
<h1>รายงานการสมัครสมาชิกและการเข้าร่วมกิจกรรม</h1>
<?php if ($result_members->num_rows > 0) : ?>
    <table class="table">
    <thead>
    <tr>
    <th>ชื่อผู้ใช้</th>
    <th>อีเมล</th>
    <th>กิจกรรมที่เข้าร่วม</th>
    </tr>
    </thead>
<tbody>
<?php while ($row_members = $result_members->fetch_assoc()) : ?>
    <tr>
        <td><?php echo $row_members['username']; ?></td>
        <td><?php echo $row_members['email']; ?></td>
        <td><?php echo $row_members['activities']; ?></td>
    </tr>
<?php endwhile; ?>
</tbody></table>
<?php else : ?>
    <p>ไม่มีข้อมูลสมาชิก</p>
<?php endif; ?>
</div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>