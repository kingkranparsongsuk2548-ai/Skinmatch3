<?php 
    session_start();
    include 'config.php'; // ไฟล์นี้ต้องเชื่อมต่อกับ skin_match_db นะคะ
    if (!isset($_SESSION['username'])) {
        header("location: login.php");
        exit();
    }
    $username = $_SESSION['username'];
    // ดึงข้อมูลสินค้าที่ User คนนี้กดใจไว้
    $sql = "SELECT * FROM favorites WHERE username = '$username' ORDER BY created_at DESC";
    $result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สินค้าที่กดใจ - SkinMatch</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background-color: #fdfaff; font-family: 'Sarabun', sans-serif; }
        .nav-custom { background: white; border-bottom: 1px solid rgba(142, 68, 173, 0.1); }
        .fav-card { border: none; border-radius: 20px; transition: 0.3s; box-shadow: 0 5px 15px rgba(0,0,0,0.05); overflow: hidden; }
        .fav-card:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(142, 68, 173, 0.1); }
    </style>
</head>
<body>
    <nav class="navbar nav-custom sticky-top">
        <div class="container">
            <a href="index.php" class="text-decoration-none text-dark"><i class="fas fa-arrow-left me-2"></i> กลับหน้าหลัก</a>
            <span class="fw-bold" style="color: #8e44ad;">MY FAVORITES</span>
        </div>
    </nav>

    <div class="container py-5">
        <h2 class="fw-bold mb-4" style="color: #8e44ad;"><i class="fas fa-heart text-danger me-2"></i> รายการที่คุณถูกใจ</h2>
        
        <div class="row g-4">
            <?php if(mysqli_num_rows($result) > 0): ?>
                <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <div class="col-md-4 col-lg-3">
                        <div class="card fav-card h-100">
                            <img src="img/<?php echo $row['product_img']; ?>" class="card-img-top" alt="product" onerror="this.src='https://via.placeholder.com/300x300?text=SkinCare'">
                            <div class="card-body">
                                <h6 class="fw-bold"><?php echo $row['product_name']; ?></h6>
                                <p class="text-muted small"><?php echo $row['product_detail']; ?></p>
                                <button class="btn btn-sm btn-outline-danger w-100 rounded-pill">ลบออก</button>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <i class="fas fa-heart-broken fa-4x mb-3 text-muted"></i>
                    <p class="text-muted">ยังไม่มีรายการที่กดใจเลยจ้า</p>
                    <a href="index.php" class="btn btn-primary rounded-pill">กลับไปหน้าแรก</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>