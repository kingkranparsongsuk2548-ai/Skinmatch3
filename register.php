<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>สมัครสมาชิก - SkinBuddy</title>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body { margin: 0; height: 100vh; display: flex; justify-content: center; align-items: center; background: linear-gradient(-45deg, #f6dfff, #e0c3fc, #ffffff, #f6dfff); background-size: 400% 400%; animation: gradientBG 15s ease infinite; font-family: 'Kanit', sans-serif; }
        @keyframes gradientBG { 0% { background-position: 0% 50%; } 50% { background-position: 100% 50%; } 100% { background-position: 0% 50%; } }
        .register-card { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(15px); padding: 40px; border-radius: 25px; box-shadow: 0 15px 35px rgba(142, 68, 173, 0.2); width: 100%; max-width: 420px; transition: transform 0.2s ease-out; }
        h3 { font-weight: 600; text-align: center; margin-bottom: 25px; background: linear-gradient(120deg, #8e44ad 30%, #ffffff 50%, #8e44ad 70%); background-size: 200% auto; -webkit-background-clip: text; -webkit-text-fill-color: transparent; animation: shimmer 4s linear infinite; }
        @keyframes shimmer { 0% { background-position: -100% center; } 100% { background-position: 100% center; } }
        
        /* สไตล์กล่อง Error (สั่นได้เหมือนหน้า Login) */
        .error-box { background: rgba(231, 76, 60, 0.15); border: 1px solid rgba(231, 76, 60, 0.3); color: #c0392b; padding: 12px; border-radius: 12px; text-align: center; margin-bottom: 20px; font-size: 0.9rem; animation: shake 0.5s ease-in-out; }
        @keyframes shake { 0%, 100% { transform: translateX(0); } 20% { transform: translateX(-5px); } 40% { transform: translateX(5px); } 60% { transform: translateX(-5px); } 80% { transform: translateX(5px); } }

        .input-container { position: relative; margin-bottom: 15px; }
        .form-label { color: #555; margin-bottom: 5px; display: block; font-size: 0.9rem; }
        .form-control { width: 100%; padding: 12px 40px; border-radius: 12px; border: 2px solid #ddd; box-sizing: border-box; transition: all 0.4s ease; }
        .form-control:focus { border-color: #8e44ad; box-shadow: 0 0 12px rgba(142, 68, 173, 0.4); outline: none; }
        .icon-left { position: absolute; left: 15px; top: 35px; color: #8e44ad; }
        .btn-register { background: linear-gradient(to right, #8e44ad, #d6b4fc); border: none; padding: 12px; width: 100%; color: white; border-radius: 12px; font-weight: 600; margin-top: 15px; cursor: pointer; transition: 0.3s; }
        .btn-register:hover { transform: scale(1.02); }
        .text-center { margin-top: 20px; text-align: center; font-size: 0.9rem; }
        a { color: #8e44ad; font-weight: bold; text-decoration: none; }
    </style>
</head>
<body>
    <div class="register-card" id="card">
        <h3>สมัครสมาชิก SkinBuddy</h3>

        <?php if(isset($_GET['error'])): ?>
            <div class="error-box">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <?php 
                    if($_GET['error'] == 'password_mismatch') echo "รหัสผ่านไม่ตรงกันค่ะ!";
                    elseif($_GET['error'] == 'password_too_short') echo "รหัสผ่านต้องอย่างน้อย 6 ตัวค่ะ!";
                    elseif($_GET['error'] == 'db_error') echo "เกิดข้อผิดพลาดในการสมัครสมาชิกค่ะ!";
                ?>
            </div>
        <?php endif; ?>

        <form action="register_db.php" method="POST">
            <div class="input-container">
                <label class="form-label">ชื่อผู้ใช้ (Username)</label>
                <i class="bi bi-person-fill icon-left"></i>
                <input type="text" name="username" class="form-control" placeholder="ตั้งชื่อผู้ใช้..." required>
            </div>
            <div class="input-container">
                <label class="form-label">รหัสผ่าน (Password)</label>
                <i class="bi bi-key-fill icon-left"></i>
                <input type="password" name="password" class="form-control" placeholder="ตั้งรหัสผ่าน..." required>
            </div>
            <div class="input-container">
                <label class="form-label">ยืนยันรหัสผ่าน (Confirm Password)</label>
                <i class="bi bi-key-fill icon-left"></i>
                <input type="password" name="password_confirm" class="form-control" placeholder="กรอกรหัสผ่านอีกครั้ง..." required>
            </div>
            <button type="submit" name="btn_register" class="btn-register">สมัครสมาชิก</button>
        </form>
        <div class="text-center">
            มีบัญชีแล้ว? <a href="login.php">เข้าสู่ระบบที่นี่</a>
        </div>
    </div>
</body>
</html>