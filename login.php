<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>เข้าสู่ระบบ - SkinBuddy</title>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body { margin: 0; height: 100vh; display: flex; justify-content: center; align-items: center; background: linear-gradient(-45deg, #f6dfff, #e0c3fc, #ffffff, #f6dfff); background-size: 400% 400%; animation: gradientBG 15s ease infinite; font-family: 'Kanit', sans-serif; }
        @keyframes gradientBG { 0% { background-position: 0% 50%; } 50% { background-position: 100% 50%; } 100% { background-position: 0% 50%; } }
        .login-card { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(15px); padding: 40px; border-radius: 25px; box-shadow: 0 15px 35px rgba(142, 68, 173, 0.2); width: 100%; max-width: 420px; transition: transform 0.2s ease-out; }
        h3 { font-weight: 600; text-align: center; margin-bottom: 30px; background: linear-gradient(120deg, #8e44ad 30%, #ffffff 50%, #8e44ad 70%); background-size: 200% auto; -webkit-background-clip: text; -webkit-text-fill-color: transparent; animation: shimmer 4s linear infinite; }
        @keyframes shimmer { 0% { background-position: -100% center; } 100% { background-position: 100% center; } }
        
        .error-box { background: rgba(231, 76, 60, 0.15); border: 1px solid rgba(231, 76, 60, 0.3); color: #c0392b; padding: 12px; border-radius: 12px; text-align: center; margin-bottom: 20px; font-size: 0.9rem; animation: shake 0.5s ease-in-out; }
        @keyframes shake { 0%, 100% { transform: translateX(0); } 20% { transform: translateX(-5px); } 40% { transform: translateX(5px); } 60% { transform: translateX(-5px); } 80% { transform: translateX(5px); } }
        
        .input-container { position: relative; margin-bottom: 20px; }
        .form-label { color: #555; margin-bottom: 5px; display: block; }
        .form-control { width: 100%; padding: 12px 40px; border-radius: 12px; border: 2px solid #ddd; box-sizing: border-box; transition: all 0.4s ease; }
        .form-control:focus { border-color: #8e44ad; box-shadow: 0 0 12px rgba(142, 68, 173, 0.4); outline: none; }
        .icon-left { position: absolute; left: 15px; top: 38px; color: #8e44ad; }
        .eye-icon { position: absolute; right: 15px; top: 38px; cursor: pointer; color: #888; transition: 0.3s; }
        
        .btn-login { background: linear-gradient(to right, #8e44ad, #d6b4fc); border: none; padding: 12px; width: 100%; color: white; border-radius: 12px; font-weight: 600; margin-top: 10px; cursor: pointer; transition: 0.3s; display: flex; justify-content: center; align-items: center; gap: 8px; }
        .btn-login:hover { transform: scale(1.02); }
        
        /* สไตล์สำหรับปุ่มตอนกำลังโหลด */
        .btn-loading { pointer-events: none; opacity: 0.8; transform: scale(1) !important; }
        .spinning-icon { animation: spin 1s linear infinite; display: inline-block; }
        @keyframes spin { 100% { transform: rotate(360deg); } }

        .text-center { margin-top: 20px; text-align: center; }
        a { color: #8e44ad; font-weight: bold; text-decoration: none; }
    </style>
</head>
<body>

    <div class="login-card" id="card">
        <h3>เข้าสู่ระบบ SkinBuddy</h3>
        
        <?php if(isset($_GET['error'])): ?>
            <div class="error-box">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <?php 
                    if($_GET['error'] == 'wrong_pass') echo "รหัสผ่านไม่ถูกต้องค่ะ!";
                    elseif($_GET['error'] == 'user_not_found') echo "ไม่พบชื่อผู้ใช้นี้ในระบบค่ะ!";
                ?>
            </div>
        <?php endif; ?>

        <!-- เพิ่ม id="loginForm" เพื่อดักจับตอนกดปุ่ม -->
        <form action="login_db.php" method="POST" id="loginForm">
            <div class="input-container">
                <label class="form-label">ชื่อผู้ใช้ (Username)</label>
                <i class="bi bi-person-fill icon-left"></i>
                <input type="text" name="username" class="form-control" placeholder="กรอกชื่อผู้ใช้..." required>
            </div>

            <div class="input-container">
                <label class="form-label">รหัสผ่าน (Password)</label>
                <i class="bi bi-key-fill icon-left"></i>
                <input type="password" name="password" id="password" class="form-control" placeholder="กรอกรหัสผ่าน..." required>
                <i class="bi bi-eye-fill eye-icon" id="togglePassword"></i>
            </div>

            <!-- เพิ่ม id="loginBtn" ไว้เปลี่ยนข้อความ -->
            <button type="submit" name="btn_login" class="btn-login" id="loginBtn">เข้าสู่ระบบ</button>
        </form>
        <div class="text-center">
            <small>ยังไม่มีบัญชี? <a href="register.php">สมัครสมาชิกที่นี่</a></small>
        </div>
    </div>

    <script>
        // Parallax Effect
        const card = document.getElementById('card');
        document.addEventListener('mousemove', (e) => {
            const x = (window.innerWidth / 2 - e.pageX) / 25;
            const y = (window.innerHeight / 2 - e.pageY) / 25;
            card.style.transform = `rotateY(${-x}deg) rotateX(${y}deg)`;
        });

        // Toggle Password
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');
        togglePassword.addEventListener('click', function () {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('bi-eye-fill');
            this.classList.toggle('bi-eye-slash-fill');
        });

        // ระบบ Loading ตอนกดปุ่มเข้าสู่ระบบ
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            // เช็คว่ากรอกข้อมูลครบตาม required หรือยัง
            if (this.checkValidity()) {
                const btn = document.getElementById('loginBtn');
                // เปลี่ยนข้อความและใส่ไอคอนหมุน
                btn.innerHTML = '<i class="bi bi-arrow-repeat spinning-icon"></i> กำลังเข้าสู่ระบบ...';
                // ทำให้ปุ่มกดย้ำไม่ได้ (ป้องกันบัคกดรัว)
                btn.classList.add('btn-loading');
            }
        });
    </script>
</body>
</html>