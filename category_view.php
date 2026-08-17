<?php
include 'config.php';

// รับค่าที่ส่งมาจากหน้า products.php
$skin_type = isset($_GET['type']) ? $_GET['type'] : '';
$category = isset($_GET['cat']) ? $_GET['cat'] : '';

// ดึงสินค้าทั้งหมดในหมวดนั้นๆ โดยกรองจากสภาพผิวและหมวดหมู่พร้อมกัน
$sql = "SELECT * FROM products WHERE skin_type = '$skin_type' AND category = '$category'";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เลือก <?php echo $category; ?> - SkinMatch</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        body { background-color: #f8f4ff; font-family: 'Sarabun', sans-serif; color: #2d3436; }
        .header-section { 
            background: linear-gradient(135deg, #8e44ad 0%, #a29bfe 100%); 
            color: white; 
            padding: 60px 0; 
            border-radius: 0 0 50px 50px;
            margin-bottom: 40px;
            box-shadow: 0 4px 15px rgba(108, 92, 231, 0.2);
        }
        .product-item-card { 
            border: none; 
            border-radius: 25px; 
            box-shadow: 0 8px 30px rgba(0,0,0,0.05); 
            transition: 0.3s; 
            background: white;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }
        .product-item-card:hover { 
            transform: translateY(-10px); 
            box-shadow: 0 15px 35px rgba(108, 92, 231, 0.2); 
        }
        .product-img-container {
            width: 100%;
            height: 300px; 
            overflow: hidden;
            background: #ffffff; 
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px; 
        }
        .product-img-container img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain; 
            transition: 0.5s;
        }
        .btn-back { border-radius: 50px; color: #8e44ad; border: 2px solid #8e44ad; font-weight: bold; background: white; text-decoration: none; display: inline-block; }
        .btn-back:hover { background: #8e44ad; color: white; }
        .btn-purple { background: #8e44ad; color: white; border-radius: 15px; border: none; font-weight: bold; padding: 12px; transition: 0.3s; text-decoration: none; display: block; width: 100%; }
        .btn-purple:hover { background: #5b2c6f; box-shadow: 0 5px 15px rgba(142, 68, 173, 0.4); color: white; }
        .product-name { 
            color: #2d3436; 
            font-weight: 700; 
            font-size: 1.15rem; 
            margin-bottom: 20px; 
            min-height: 55px; 
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            line-height: 1.4;
        }
    </style>
</head>
<body>

<div class="header-section text-center">
    <div class="container">
        <h2 class="fw-bold mb-2">เลือก <?php echo strtoupper($category); ?> ที่ใช่</h2>
        <p class="mb-0">สำหรับสภาพผิว: <strong><?php echo $skin_type; ?></strong></p>
    </div>
</div>

<div class="container py-3">
    <div class="mb-4">
        <a href="products.php?skin_type=<?php echo urlencode($skin_type); ?>" class="btn btn-back px-4">← กลับไปหน้า Routine</a>
    </div>

    <div class="row g-4">
        <?php 
        if(mysqli_num_rows($result) > 0):
            while($row = mysqli_fetch_assoc($result)): 
        ?>
        <div class="col-md-6 col-lg-4"> 
            <div class="card product-item-card h-100">
                <div class="product-img-container">
                    <img src="<?php echo $row['image_url']; ?>" 
                         onerror="this.src='https://via.placeholder.com/400x300?text=No+Image'">
                </div>
                <div class="card-body p-4 text-center d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="product-name"><?php echo $row['name']; ?></h5>
                        </div>
                    
                    <a href="product_detail.php?id=<?php echo $row['id']; ?>" class="btn btn-purple">
                        ดูรายละเอียดสินค้า
                    </a>
                </div>
            </div>
        </div>
        <?php 
            endwhile; 
        else:
            echo '<div class="col-12 text-center py-5"><h5 class="text-muted">ขออภัย ยังไม่มีสินค้าในหมวดนี้เพิ่มในระบบ 💜</h5></div>';
        endif; 
        ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>