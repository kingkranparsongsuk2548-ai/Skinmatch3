<?php
include 'config.php'; // ไฟล์กุญแจสำคัญที่เชื่อมกับ skin_match_db

// รับค่าสภาพผิวจาก URL (ถ้ามี) เพื่อเปิด Tab ให้ตรงกับผลลัพธ์
$selected_skin = isset($_GET['skin_type']) ? $_GET['skin_type'] : 'ผิวมัน';

// รายการสภาพผิวที่เรามีในฐานข้อมูล
$skin_types = ['ผิวมัน', 'ผิวแห้ง', 'ผิวผสม', 'ผิวแพ้ง่าย'];
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Routine ของฉัน - SkinMatch</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        body { background-color: #f8f4ff; font-family: 'Sarabun', sans-serif; }
        .nav-pills .nav-link { color: #8e44ad; border: 2px solid #8e44ad; margin: 5px; border-radius: 50px; font-weight: bold; }
        .nav-pills .nav-link.active { background-color: #8e44ad; border-color: #8e44ad; color: white; }
        .product-card { border: none; border-radius: 20px; transition: 0.3s; box-shadow: 0 5px 15px rgba(142, 68, 173, 0.1); background: white; }
        .product-card:hover { transform: translateY(-10px); box-shadow: 0 8px 25px rgba(142, 68, 173, 0.2); }
        .step-num { background: #8e44ad; color: white; width: 35px; height: 35px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-weight: bold; margin-bottom: 10px; }
        .category-label { color: #8e44ad; font-weight: bold; font-size: 0.75rem; text-transform: uppercase; }
        .card-link { text-decoration: none !important; color: inherit; }
        h1.fw-bold { color: #5b2c6f !important; }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold">💜 SkinMatch Routine 💜</h1>
        <p class="text-muted">สูตรดูแลผิว 4 ขั้นตอนที่จัดมาเพื่อคุณ (คลิกที่การ์ดเพื่อดูสินค้าเพิ่ม)</p>
    </div>

    <ul class="nav nav-pills justify-content-center mb-5" id="pills-tab" role="tablist">
        <?php foreach ($skin_types as $index => $type_name): ?>
        <li class="nav-item" role="presentation">
            <button class="nav-link <?php echo ($type_name == $selected_skin) ? 'active' : ''; ?>" 
                    id="tab-<?php echo $index; ?>" 
                    data-bs-toggle="pill" 
                    data-bs-target="#content-<?php echo $index; ?>" 
                    type="button" role="tab">
                <?php echo $type_name; ?>
            </button>
        </li>
        <?php endforeach; ?>
    </ul>

    <div class="tab-content" id="pills-tabContent">
        <?php foreach ($skin_types as $index => $type_name): ?>
        <div class="tab-pane fade <?php echo ($type_name == $selected_skin) ? 'show active' : ''; ?>" 
             id="content-<?php echo $index; ?>" role="tabpanel">
            
            <div class="row g-4">
                <?php 
                // ดึงข้อมูล 4 ขั้นตอนแรกของสภาพผิวนั้นๆ มาโชว์เป็นตัวอย่าง
                $sql = "SELECT * FROM products WHERE skin_type = '$type_name' GROUP BY category ORDER BY id ASC LIMIT 4";
                $result = mysqli_query($conn, $sql);
                $step_count = 1;

                if(mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)): 
                ?>
                <div class="col-md-3">
                    <a href="category_view.php?type=<?php echo urlencode($type_name); ?>&cat=<?php echo urlencode($row['category']); ?>" class="card-link">
                        <div class="card product-card h-100 text-center p-3">
                            <div><span class="step-num"><?php echo $step_count++; ?></span></div>
                            <img src="<?php echo $row['routine_image']; ?>" class="card-img-top rounded-4" style="height: 150px; object-fit: cover;" onerror="this.src='https://via.placeholder.com/200?text=Set+Image'">
                            
                            <div class="card-body">
                                <div class="category-label mb-1"><?php echo $row['category']; ?></div>
                                
                                <h6 class="fw-bold mb-2 text-dark">
                                    <?php 
                                        // ตั้งชื่อหัวข้อตามหมวดหมู่
                                        if($row['category'] == 'cleanser') echo "เจลล้างหน้าคุมมัน";
                                        elseif($row['category'] == 'serum') echo "เซรั่มลดสิวอุดตัน";
                                        elseif($row['category'] == 'cream') echo "เจลบำรุงเนื้อบางเบา";
                                        elseif($row['category'] == 'sunscreen') echo "กันแดดเนื้อแมตต์";
                                        else echo $row['name']; 
                                    ?>
                                </h6>

                                <p class="small text-muted mb-0"><?php echo $row['description']; ?></p>
                                <div class="mt-3" style="font-size: 0.75rem; color: #8e44ad; font-weight: bold;">
                                    จิ้มเพื่อดูหมวดนี้เพิ่ม ✨
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <?php 
                    endwhile; 
                } else {
                    echo "<div class='text-center text-muted'>ยังไม่มีข้อมูลสินค้าสำหรับสภาพผิวนี้</div>";
                }
                ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="text-center mt-5">
        <a href="index.php" class="btn btn-outline-secondary px-4" style="border-radius: 50px; color: #8e44ad; border-color: #8e44ad;">กลับหน้าหลัก</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>