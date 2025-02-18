<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> หน้าเข้าสู่ระบบ </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: 'Arial', sans-serif;
            /* เปลี่ยนสีพื้นหลังเป็นสี #FC575E → #F7B42C */
            background: linear-gradient(to bottom, #FC575E, #F7B42C);
            margin: 0;
            padding: 0;
            color: #333;
            display: flex;
            /* เปลี่ยนเป็น flex container */
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            overflow: hidden;
            /* ป้องกัน scrollbar */
            position: relative;
            /* จำเป็นสำหรับ positioning ดาวตก */
            background-blend-mode: screen;
            /* เพิ่ม blend mode */
        }

        .container {
            display: flex;
            /* ให้ container เป็น flex container */
            width: 80%;
            /* ปรับขนาด container */
            max-width: 1200px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .image-side {
            flex: 1;
            /* ให้ image side ขยายเต็มที่ */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .full-side-image {
            max-width: 100%;
            /* ให้รูปภาพมีขนาดไม่เกิน container */
            max-height: 100%;
            object-fit: contain;
            /* ปรับขนาดรูปภาพให้พอดีกับ container โดยไม่ crop */
        }

        .form-side {
            flex: 1;
            /* ให้ form side ขยายเต็มที่ */
            text-align: center;
            padding: 20px;
        }

        .form-image {
            width: 200px;
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            background-color: #064635;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #09814A;
        }

        a {
            color: #064635;
            text-decoration: none;
        }

        @keyframes shootingStar {
            0% {
                transform: translateX(0) translateY(0) rotate(45deg);
                opacity: 0.8;
                /* แก้ไข opacity เป็นค่าที่ถูกต้อง */
            }

            100% {
                transform: translateX(-800px) translateY(800px) rotate(45deg);
                /* เพิ่มระยะการเคลื่อนที่ */
                opacity: 0;
                /* แก้ไข opacity เป็นค่าที่ถูกต้อง */
            }
        }

        .star {
            position: absolute;
            top: var(--star-top);
            left: var(--star-left);
            width: var(--star-size);
            height: var(--star-size);
            background: linear-gradient(to right, rgba(255, 255, 255, 0.5), transparent);
            /* ทำ gradient ให้เหมือนหาง */
            border-radius: 50%;
            opacity: 0;
            animation: shootingStar var(--star-duration) linear infinite;
            /* ลองเปลี่ยนเป็น ease-in หรือ ease-out */
            animation-delay: var(--star-delay);
            will-change: transform, opacity;
            /* ช่วยเรื่อง performance */
        }
    </style>

</head>

<body>
    <div class="container">
        <div class="image-side">
            <img src="uploads/โครตอันตราย.png" alt="Your Image" class="full-side-image">
        </div>
        <div class="form-side">
            <img src="uploads/rpu.png" alt="rpu" class="form-image">
            <form action="process-login.php" method="post">
                <input type="text" name="username" placeholder="Username" required><br><br>
                <input type="password" name="password" placeholder="Password" required><br><br>
                <button type="submit"> เข้าสู่ระบบ </button>
            </form>
            <p> ยังไม่มีบัญชีใช่ไหม? | <a href="form-register.php"> ลงทะเบียนที่นี่ </a></p>
        </div>
    </div>
    <script>
        window.onload = function() {
            console.log('JavaScript is running'); 

            const body = document.querySelector('body');
            const numStars = 1000; 

            for (let i = 0; i < numStars; i++) {
                let star = document.createElement('div');
                star.className = 'star';

                let x = Math.random() * 100;
                let y = Math.random() * 100;
                let size = Math.random() * 2 + 0.5; 
                let speed = Math.random() * 3 + 2; 
                let delay = Math.random() * 10; 

                star.style.left = x + '%';
                star.style.top = y + '%';
                star.style.width = size + 'px';
                star.style.height = size + 'px';
                star.style.animationDuration = speed + 's';
                star.style.animationDelay = delay + 's';

                body.appendChild(star);
                console.log(star); 
            }
        }
    </script>
</body>

</html>
