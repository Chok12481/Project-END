<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    die("<center><h1><br><br><br><br><br><br><br><br><br><br>คุณไม่ใช่แอดมินนะครับ!");
}
setlocale(LC_ALL, 'th_TH.utf8');
$sql = "SELECT
    a.id,
    a.username,
    a.email,
    
DATE_FORMAT(a.created_at, '%b. %d, %Y %H:%i') AS created_at_formatted,
DATE_FORMAT(a.updated_at, '%b. %d, %Y %H:%i') AS updated_at_formatted,
    act.title AS latest_activity,
DATE_FORMAT(b.booking_date, '%b. %d, %Y %H:%i') AS latest_booking_date
FROM
    account a
LEFT JOIN (
    SELECT
    user_id,
    MAX(booking_date) AS latest_booking
FROM
    bookings
GROUP BY
    user_id
    ) AS sub ON a.id = sub.user_id
LEFT JOIN bookings b ON a.id = b.user_id AND sub.latest_booking = b.booking_date
LEFT JOIN activities act ON b.activity_id = act.id
WHERE a.role = 'member'";

$result = $conn->query($sql);

if (!$result) {
    echo "Error: " . $conn->error;
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title> จัดการสมาชิก </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" 
    integrity="YOUR_INTEGRITY_HASH" 
    crossorigin="anonymous" 
    referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #FC575E, #F7B42C);
            margin: 0;
            padding: 0;
            color: #475467;
        }

        .container {
            width: 95%;
            max-width: 1200px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 6px;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            padding: 20px;
        }

        .top-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            margin-bottom: 20px;
        }

        .top-nav h1 {
            font-size: 20px;
            margin: 0;
            color: #475467;
        }

        .top-nav-links {
            display: none;
        }

        .search-action-area {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .search-container {
            display: flex;
            align-items: center;
        }

        .search-input {
            padding: 8px 12px;
            border: 1px solid #d0d5dd;
            border-radius: 6px;
            width: 300px;
            font-size: 14px;
            color: #475467;
            background-color: #f9fafb;
        }

        .search-input::placeholder {
            color: #98a2b3;
        }

        .action-buttons {
            display: flex;
            align-items: center;
        }

        .action-buttons a {
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 14px;
            color: #475467;
            transition: background-color 0.2s ease;
        }

        .action-buttons a:hover {
            background-color: #f2f4f7;
        }

        .add-members-button {
            background-color: #34d399;
            color: #fff;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 14px;
            margin-left: 10px;
            text-decoration: none;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px 16px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
            font-size: 14px;
            color: #475467;
        }

        th {
            font-weight: 600;
            color: #6b7280;
        }

        tr:hover {
            background-color: #f9fafb;
        }

        .action-icons {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .action-icons a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 24px;
            height: 24px;
            text-decoration: none;
            border-radius: 4px;
            color: #6b7280;
        }

        .action-icons a:hover {
            background-color: #f2f4f7;
        }
        </style>
</head>

<body>
<div class="container">
<div class="top-nav">
<h1>สมาชิก</h1>
<div class="top-nav-links">
</div>
</div>
<div class="search-action-area">
<div class="search-container">
    <input type="text" id="searchInput" class="search-input" placeholder="ค้นหาสมาชิก...">
</div>
<div class="action-buttons">
    <a href="form-register.php" class="add-members-button">เพิ่มสมาชิก</a></div>
</div>

<table id="memberTable">
<thead>
    <tr>
    <th>ชื่อ</th>
    <th>อีเมล</th>
    <th>กิจกรรมล่าสุดที่จอง</th>
    <th>วันที่จองล่าสุด</th>
    <th>วันที่สมัคร</th>
    <th>แก้ไขล่าสุด</th>
    <th>แก้ไข</th>
    </tr>
</thead>
<tbody>
<?php
    if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
?>
    <tr>
    <td><?php echo $row['username']; ?></td>
    <td><?php echo $row['email']; ?></td>
    <td><?php echo $row['latest_activity'] ? $row['latest_activity'] : 'ไม่มี'; ?></td>
    <td><?php echo $row['latest_booking_date'] ? $row['latest_booking_date'] : 'ไม่มี'; ?></td>
    <td><?php echo $row['created_at_formatted']; ?></td>
    <td><?php echo $row['updated_at_formatted']; ?></td>
    <td class="action-icons">
    <a href="edit_member.php?id=<?php echo $row['id']; ?>" title="แก้ไข">
    <i class="fas fa-pencil-alt"></i></a>
    <a href="delete_member.php?id=<?php echo $row['id']; ?>" onclick="return confirm('คุณแน่ใจหรือไม่ว่าต้องการลบสมาชิกคนนี้?')" title="ลบ">
    <i class="fas fa-trash-alt"></i>
    </a>
    </td>
    </tr>
<?php
    }
    } else {
        echo "<tr><td colspan='7'>ไม่มีสมาชิกในขณะนี้</td></tr>";
    }
?>
    </tbody>
    </table>
</div>

<script>
    const searchInput = document.getElementById('searchInput');
    const tableRows = document.querySelectorAll('#memberTable tbody tr');
    searchInput.addEventListener('input', function() {
    const searchTerm = searchInput.value.toLowerCase();

    tableRows.forEach(row => {
    const rowData = row.textContent.toLowerCase();
if (rowData.includes(searchTerm)) {
    row.style.display = '';
    } else {
    row.style.display = 'none';
    }
    });
});
</script>
</body>
</html>