<?php 
    session_start();
    include 'config.php';
    if (!isset($_SESSION['username'])) {
        header("location: login.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าแรก - SkinMatch</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* --- เพิ่มลูกเล่น Fade In --- */
        body {
            animation: fadeInAnimation ease 2s;
            animation-iteration-count: 1;
            animation-fill-mode: forwards;
        }
        @keyframes fadeInAnimation {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        :root {
            --main-purple: #8e44ad;
            --soft-purple: #a29bfe;
            --bg-cream: #fdfaff;
        }
        body { 
            background-color: var(--bg-cream); 
            font-family: 'Sarabun', sans-serif; 
            overflow-x: hidden; 
            transition: margin-left .5s; 
        }
        
        /* --- Sidebar --- */
        .sidebar {
            height: 100%; width: 0; position: fixed; z-index: 1001; top: 0; left: 0;
            background: linear-gradient(180deg, var(--main-purple) 0%, #6c5ce7 100%);
            overflow-x: hidden; transition: 0.5s; padding-top: 60px;
            box-shadow: 4px 0 25px rgba(142, 68, 173, 0.3);
        }
        .sidebar a {
            padding: 15px 30px; text-decoration: none; font-size: 1.1rem; color: rgba(255,255,255,0.9);
            display: block; transition: 0.3s; border-radius: 0 50px 50px 0; margin-right: 10px;
        }
        .sidebar a:hover { background: rgba(255,255,255,0.2); color: white; padding-left: 40px; }
        .sidebar-trigger { position: fixed; top: 0; left: 0; width: 15px; height: 100%; z-index: 1000; }

        /* --- Navbar & Hero Banner --- */
        .navbar { background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); border-bottom: 1px solid rgba(142, 68, 173, 0.1); }
        .navbar-brand { color: var(--main-purple) !important; letter-spacing: 1px; font-weight: bold; }
        
        .hero-banner {
            border-radius: 40px; overflow: hidden;
            box-shadow: 0 25px 60px rgba(142, 68, 173, 0.2);
            margin-top: 30px; border: 6px solid white;
            position: relative;
        }
        .banner-content {
            min-height: 450px; display: flex; flex-direction: column;
            justify-content: center; align-items: center; color: white;
            padding: 60px; text-align: center; position: relative;
            background: linear-gradient(135deg, #a29bfe 0%, #6c5ce7 50%, #8e44ad 100%);
            overflow: hidden;
        }
        .banner-content::before {
            content: ""; position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background-image: url('https://www.transparenttextures.com/patterns/cubes.png');
            opacity: 0.1; z-index: 1;
        }

        .floating-icon {
            position: absolute; opacity: 0.3; z-index: 2;
            animation: float 4s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(10deg); }
        }

        .btn-pulse {
            animation: pulse-animation 2s infinite;
            background: white; color: var(--main-purple) !important; font-weight: bold;
            padding: 15px 40px; border-radius: 50px; border: none; transition: 0.3s;
            z-index: 3; position: relative; text-decoration: none;
        }
        @keyframes pulse-animation {
            0% { transform: scale(1); box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.7); }
            70% { transform: scale(1.05); box-shadow: 0 0 0 15px rgba(255, 255, 255, 0); }
            100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(255, 255, 255, 0); }
        }
        
        .how-card {
            background: white; border: none; border-radius: 25px;
            padding: 30px; transition: 0.4s; text-align: center; box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }
        .how-card:hover { transform: translateY(-10px); }
        .how-icon { width: 80px; height: 80px; background: #f4eaff; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; }

        .article-card {
            border-radius: 20px; overflow: hidden; background: white;
            transition: 0.3s; border: 1px solid rgba(142, 68, 173, 0.1);
        }
        .article-card:hover { transform: scale(1.02); }
        .article-img { height: 120px; width: 120px; background: #f0ebff; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }

        .tip-box {
            background: linear-gradient(135deg, #a29bfe 0%, #6c5ce7 100%);
            color: white; border-radius: 30px; padding: 40px; margin-top: 60px;
        }
    </style>
</head>
<body>

    <div id="mySidebar" class="sidebar" onmouseleave="closeNav()">
        <div class="text-center mb-4"><i class="fas fa-magic fa-3x text-white opacity-50"></i></div>
        <a href="index.php"><i class="fas fa-home me-2"></i> หน้าหลัก</a>
        <a href="products.php"><i class="fas fa-sparkles me-2"></i> ดู Routine ของฉัน</a>
        <a href="skin_quiz.php"><i class="fas fa-clipboard-list me-2"></i> ทำแบบประเมินผิว</a>
        <a href="favorites.php"><i class="fas fa-heart me-2"></i> สินค้าที่กดใจ</a>
        <a href="profile.php"><i class="fas fa-user-circle me-2"></i> โปรไฟล์ของฉัน</a>
        <hr class="mx-3 text-white">
        <a href="logout.php" class="text-warning"><i class="fas fa-sign-out-alt me-2"></i> ออกจากระบบ</a>
    </div>

    <div class="sidebar-trigger" onmouseover="openNav()"></div>

    <div id="main">
        <nav class="navbar navbar-expand-lg sticky-top">
            <div class="container">
                <a class="navbar-brand" href="#">SkinBuddy</a>
                <div class="ms-auto d-flex align-items-center">
                    <span class="me-3 text-muted">สวัสดีคุณ, <strong class="text-primary"><?php echo $_SESSION['username']; ?></strong> ✨</span>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class="hero-banner">
                <div class="banner-content">
                    <i class="fas fa-sparkles floating-icon" style="top: 15%; left: 10%; font-size: 2rem;"></i>
                    <i class="fas fa-magic floating-icon" style="bottom: 20%; right: 15%; font-size: 2.5rem; animation-delay: 1s;"></i>
                    <i class="fas fa-star floating-icon" style="top: 25%; right: 10%; font-size: 1.5rem; animation-delay: 2s;"></i>
                    <i class="fas fa-leaf floating-icon" style="bottom: 15%; left: 15%; font-size: 2rem; animation-delay: 1.5s;"></i>

                    <div style="z-index: 3;">
                        <h1 class="display-5 fw-bold mb-3">Routine ที่ออกแบบมาเพื่อคุณ 📣</h1>
                        <p class="lead mb-4 opacity-75">ลดความยุ่งยากในการเลือกซื้อสกินแคร์</p>
                        <a href="skin_quiz.php" class="btn btn-pulse btn-lg">เริ่มวิเคราะห์ผิวเลย <i class="fas fa-arrow-right ms-2"></i></a>
                    </div>
                </div>
            </div>

            <div class="mt-5 pt-5">
                <h2 class="fw-bold text-center mb-5" style="color: var(--main-purple);">เริ่มต้นผิวสวยใน 3 ขั้นตอน </h2>
                <div class="row g-4 justify-content-center">
                    <div class="col-md-4">
                        <div class="how-card h-100">
                            <div class="how-icon"><i class="fas fa-file-alt fa-2x" style="color: var(--main-purple);"></i></div>
                            <h6 class="fw-bold">1. ทำแบบทดสอบ</h6>
                            <p class="text-muted small mb-0">ตอบคำถามสั้นๆ เพื่อให้เรารู้จักผิวคุณ</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="how-card h-100">
                            <div class="how-icon"><i class="fas fa-poll fa-2x" style="color: var(--main-purple);"></i></div>
                            <h6 class="fw-bold">2. ดูผลวิเคราะห์</h6>
                            <p class="text-muted small mb-0">รู้สภาพผิวและสเตปที่ควรดูแล</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="how-card h-100">
                            <div class="how-icon"><i class="fas fa-spa fa-2x" style="color: var(--main-purple);"></i></div>
                            <h6 class="fw-bold">3. ดู Routine แนะนำ</h6>
                            <p class="text-muted small mb-0">รับสกินแคร์ที่คัดมาเพื่อคุณ</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-5 pt-5">
                <div class="d-flex justify-content-between align-items-end mb-4">
                    <h2 class="fw-bold mb-0" style="color: var(--main-purple);">เคล็ดลับดูแลผิวที่คุณควรรู้ 💡</h2>
                    <a href="#" class="text-decoration-none text-muted">ดูทั้งหมด <i class="fas fa-chevron-right ms-1"></i></a>
                </div>
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="article-card d-flex p-3">
                            <div class="article-img rounded-3 shadow-sm me-3">
                                <i class="fas fa-water fa-3x text-primary opacity-50"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-2">วิธีล้างหน้าสำหรับผิวผสม</h5>
                                <p class="text-muted small">เทคนิคการคุมความมันช่วง T-Zone และเพิ่มความชุ่มชื้นให้แก้ม...</p>
                                <a href="#" class="btn btn-sm btn-outline-primary rounded-pill">อ่านต่อ</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="article-card d-flex p-3">
                            <div class="article-img rounded-3 shadow-sm me-3" style="background: #fff0f5;">
                                <i class="fas fa-heart fa-3x text-danger opacity-50"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-2">5 ส่วนผสมที่คนผิวแห้งต้องเลิฟ</h5>
                                <p class="text-muted small">รวม Hyaluronic Acid และ Ceramide ตัวช่วยล็อคผิวฉ่ำวาว...</p>
                                <a href="#" class="btn btn-sm btn-outline-primary rounded-pill">อ่านต่อ</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tip-box shadow">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h3 class="fw-bold mb-2">💡 Quick Skin Tip:</h3>
                        <p class="fs-5 mb-0 opacity-75">"น้ำ" คือกุญแจสำคัญ! การดื่มน้ำวันละ 8 แก้ว ช่วยให้ผิวดูอิ่มน้ำและลดปัญหาผิวแห้งกร้านได้จริง</p>
                    </div>
                    <div class="col-md-4 text-end mt-3 mt-md-0">
                        <i class="fas fa-water fa-5x opacity-25"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openNav() {
            document.getElementById("mySidebar").style.width = "280px";
            document.getElementById("main").style.marginLeft = "280px";
        }
        function closeNav() {
            document.getElementById("mySidebar").style.width = "0";
            document.getElementById("main").style.marginLeft = "0";
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <?php include 'footer.php'; ?>
</body>
</html>