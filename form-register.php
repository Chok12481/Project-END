
<!DOCTYPE html>
 <html lang="en">
 <head>
    <link rel="stylesheet" href="style-activity.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าสมัครสมาชิก</title>
    <style>
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

        form {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"],
        input[type="number"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        textarea {
            height: 100px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #45a049;
        }

        .activities {
            margin-bottom: 15px;
        }

        .activities label {
            display: inline-block;
            margin-right: 10px;
        }

        .login-link {
            text-align: center;
            margin-top: 10px;
        }
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            appearance: none; 
            -webkit-appearance: none; 
            -moz-appearance: none; 
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/></svg>') no-repeat right 10px center; /* เพิ่มลูกศรลงใน dropdown */
            padding-right: 30px; 
        }

        select:focus {
            outline: none;
            border-color: #4CAF50; 
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.3);
        }
        input[type="email"] {
            width: 100%; 
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
    </style>
 </head>
 <body>
 <form action="process-register.php" method="post" enctype="multipart/form-data">
  <h2> สมัครสมาชิก </h2>
  <input type="email" name="email" placeholder="Email" required>
  <input type="text" name="username" placeholder="Username" required>
  <input type="password" name="password" placeholder="Password" required>
  <input type="text" name="address" placeholder="ที่อยู่" required>
  <input type="text" name="phone" placeholder="เบอร์โทร" required>
  <input type="text" name="occupation" placeholder="อาชีพ" required>
  <input type="number" name="income" placeholder="รายได้ (บาท)" required>
  <textarea name="contact_info" placeholder="ข้อมูลติดต่อเพิ่มเติม (เช่น Facebook, Line)"></textarea>

  <label for="profile_image">รูปโปรไฟล์:</label>
  <input type="file" name="profile_image" id="profile_image" accept="image/*">

  <div class="activities">
    <label>เลือกกิจกรรมที่ต้องการเข้าร่วม:</label><br>
    <div class="activity">
      <input type="checkbox" name="activities[]" value="ร้องเพลง" id="singing">
      <label for="singing">ร้องเพลง</label>
    </div>
    <div class="activity">
      <input type="checkbox" name="activities[]" value="เต้น" id="dancing">
      <label for="dancing">เต้น</label>
    </div>
    <div class="activity">
      <input type="checkbox" name="activities[]" value="ฝึกสอนดนตรีไทย" id="thai-music">
      <label for="thai-music">ฝึกดนตรีไทย</label>
    </div>
    <div class="activity">
      <input type="checkbox" name="activities[]" value="ฝึกสอนฟุตซอล" id="futsal">
      <label for="futsal">ฝึกฟุตซอล</label>
    </div>
    <div class="activity">
      <input type="checkbox" name="activities[]" value="ฝึกฝีมือส่งเสริมอาชีพ" id="career">
      <label for="career">ฝึกฝีมือส่งเสริมอาชีพ</label>
    </div>
  </div>

  <button type="submit"> สมัคร </button>

  <div class="login-link">
    <p>มีบัญชีอยู่แล้ว? <a href="form-login.php">เข้าสู่ระบบที่นี่</a></p>
  </div>
</form>
</body>

</html>