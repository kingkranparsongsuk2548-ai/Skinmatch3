<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>สมัครสมาชิกสำเร็จ</title>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { 
            margin: 0; 
            height: 100vh; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            background: linear-gradient(-45deg, #f6dfff, #e0c3fc, #ffffff, #f6dfff); 
            background-size: 400% 400%; 
            animation: gradientBG 15s ease infinite; 
            font-family: 'Kanit', sans-serif; 
        }
        @keyframes gradientBG { 0% { background-position: 0% 50%; } 50% { background-position: 100% 50%; } 100% { background-position: 0% 50%; } }

        .success-card { 
            background: #ffffff; 
            backdrop-filter: blur(15px); 
            padding: 40px; 
            border-radius: 25px; 
            box-shadow: 0 15px 35px rgba(142, 68, 173, 0.2); 
            text-align: center; 
            width: 90%; 
            max-width: 400px;
            position: relative;
            
            /* แสงวิ่งรอบกรอบ */
            border: 4px solid transparent;
            background-clip: padding-box, border-box;
            background-origin: border-box;
            background-image: linear-gradient(#fff, #fff), linear-gradient(120deg, #8e44ad, #d6b4fc, #8e44ad);
            background-size: 100% 100%, 200% 200%;
            animation: borderRotate 3s linear infinite, fadeInUp 1s ease-out;
        }

        @keyframes borderRotate {
            0% { background-position: 0% 50%; }
            100% { background-position: 200% 50%; }
        }

        @keyframes fadeInUp { 0% { opacity: 0; transform: translateY(30px); } 100% { opacity: 1; transform: translateY(0); } }

        h2 { color: #8e44ad; font-weight: 600; }
        
        .btn-go { 
            background: linear-gradient(to right, #8e44ad, #d6b4fc); 
            color: white; 
            padding: 12px 30px; 
            border-radius: 12px; 
            text-decoration: none; 
            display: inline-block; 
            margin-top: 20px; 
            font-weight: 600; 
            transition: 0.3s;
            border: none;
            cursor: pointer;
        }
        
        .btn-go:active { transform: scale(0.95); }
        .btn-go:hover { transform: scale(1.05); box-shadow: 0 5px 15px rgba(142, 68, 173, 0.3); }
    </style>
</head>
<body>
    <div class="success-card">
        <h2>สมัครสมาชิกสำเร็จ! </h2>
        <p>ยินดีต้อนรับเข้าสู่ SkinBuddy</p>
        <a href="login.php" class="btn-go">ไปหน้าเข้าสู่ระบบ</a>
    </div>
</body>
</html>