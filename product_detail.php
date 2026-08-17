<?php
include 'config.php';

// รับ ID สินค้าจาก URL
$id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : '';

// ดึงข้อมูลสินค้าตัวที่เลือก
$sql = "SELECT * FROM products WHERE id = '$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    echo "<div style='text-align:center; margin-top:50px;'><h3>ไม่พบข้อมูลสินค้า</h3><a href='products.php'>กลับหน้าหลัก</a></div>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row['name']; ?> - SkinMatch</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background-color: #f8f4ff; font-family: 'Sarabun', sans-serif; overflow-x: hidden; }
        
        /* Animation */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .reveal { animation: fadeInUp 0.8s ease-out forwards; }
        .delay-1 { animation-delay: 0.2s; opacity: 0; }
        .delay-2 { animation-delay: 0.4s; opacity: 0; }

        .detail-card { 
            background: white; 
            border-radius: 30px; 
            border: none; 
            box-shadow: 0 15px 45px rgba(142, 68, 173, 0.08); 
            overflow: hidden;
            transition: 0.4s;
        }

        .img-container { overflow: hidden; border-radius: 20px; background: white; padding: 20px; }
        .product-img { 
            max-width: 100%; 
            height: 400px; 
            object-fit: contain; 
            transition: transform 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
        }
        .img-container:hover .product-img { transform: scale(1.05); }
        
        .btn-back { 
            border-radius: 50px; 
            color: #8e44ad; 
            border: 2px solid #8e44ad; 
            text-decoration: none; 
            display: inline-block; 
            padding: 8px 25px; 
            transition: 0.3s;
            font-weight: bold;
            background: white;
        }
        .btn-back:hover { background: #8e44ad; color: white; transform: translateX(-5px); }
        
        /* ปรับปุ่มถูกใจให้เป็นแบบกดแล้วลิ้งค์ไปบันทึก */
        .btn-fav { 
            border-radius: 15px; 
            border: 2px solid #ff7675; 
            color: #ff7675; 
            background: white; 
            transition: all 0.3s; 
            padding: 10px 20px; 
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
        }
        .btn-fav:hover { background: #ff7675; color: white; }
        
        .price-tag { color: #8e44ad; font-size: 2.2rem; font-weight: 700; margin: 15px 0; }
        .badge-cat { background: #f1f2f6; color: #8e44ad; padding: 8px 18px; border-radius: 12px; font-weight: bold; letter-spacing: 1px; }
    </style>
</head>
<body>
<div class="container py-5">
    <a href="javascript:history.back()" class="btn-back mb-4 reveal">← กลับ</a>
    
    <div class="card detail-card p-4 p-md-5 reveal delay-1">
        <div class="row align-items-center">
            <div class="col-md-5 text-center">
                <div class="img-container">
                    <img src="<?php echo $row['image_url']; ?>" class="product-img" onerror="this.src='https://via.placeholder.com/400?text=SkinMatch'">
                </div>
            </div>
            
            <div class="col-md-7 reveal delay-2">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <span class="badge-cat"><?php echo strtoupper($row['category']); ?></span>
                    
                    <a href="add_to_favorite.php?p_id=<?php echo $row['id']; ?>" class="btn-fav">
                        <i class="fa-regular fa-heart"></i> ถูกใจ
                    </a>
                </div>
                
                <h1 class="fw-bold text-dark mb-2"><?php echo $row['name']; ?></h1>
                <h5 class="mb-4" style="color: #8e44ad; font-weight: 300;">เหมาะสำหรับสภาพผิว: <strong><?php echo $row['skin_type']; ?></strong></h5>
                
                <div class="price-tag">฿<?php echo number_format($row['price']); ?></div>
                
                <hr style="opacity: 0.1;">
                
                <div class="product-detail-content py-3">
                    <h6 class="fw-bold text-dark mb-3"><i class="fa-solid fa-sparkles text-warning"></i> รายละเอียดสินค้า:</h6>
                    <p class="text-muted" style="line-height: 1.8; font-size: 1.05rem;">
                        <?php 
                        echo !empty($row['description']) ? nl2br($row['description']) : "กำลังเตรียมข้อมูลรายละเอียดผลิตภัณฑ์เพื่อการดูแลผิวที่ดีที่สุดสำหรับคุณ..."; 
                        ?>
                    </p>
                </div>

                <div class="mt-4">
                    <a href="products.php?skin_type=<?php echo urlencode($row['skin_type']); ?>" class="btn btn-primary btn-lg w-100" style="background: linear-gradient(135deg, #8e44ad 0%, #a29bfe 100%); border: none; border-radius: 20px; padding: 18px; font-weight: bold; box-shadow: 0 10px 20px rgba(142, 68, 173, 0.2); color: white; text-decoration: none; display: block; text-align: center;">
                        ดูสกินแคร์ตัวอื่นใน Routine ✨
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>