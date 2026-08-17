<?php 
    session_start();
    if (!isset($_SESSION['username']) || !isset($_SESSION['skin_result'])) {
        header("location: index.php");
        exit();
    }
    $result = $_SESSION['skin_result'];
    $description = $_SESSION['skin_description'];

    // --- 1. เตรียมข้อมูลความรู้ตามสภาพผิว ---
    $result_for_db = "";
    $skin_knowledge = [];

    if (strpos($result, 'ผิวแห้ง') !== false) {
        $result_for_db = "ผิวแห้ง";
        $skin_knowledge = [
            'image' => 'images/ผิวแห้ง.png',
            'bg_color' => 'rgb(255, 198, 162)', // ปรับสีพื้นหลังสำหรับผิวแห้ง
            'title' => 'รู้จัก "ผิวแห้ง" ให้ดียิ่งขึ้น',
            'points' => [
                '🔘 ผิวขาดความชุ่มชื้นและน้ำมันหล่อเลี้ยงตามธรรมชาติ',
                '🔘 มักรู้สึกตึงผิวหลังล้างหน้า และอาจมีอาการลอกเป็นขุย',
                '🔘 รูขุมขนเล็กและละเอียด แต่ผิวอาจดูหมองคล้ำไม่สดใส',
                '🔘 เกิดริ้วรอยเล็กๆ ได้ง่ายกว่าผิวประเภทอื่น'
            ]
        ];
    } elseif (strpos($result, 'ผิวมัน') !== false) {
        $result_for_db = "ผิวมัน";
        $skin_knowledge = [
            'image' => 'images/oily.png',
            'bg_color' => '#ffe7ac', // ปรับสีพื้นหลังสำหรับผิวมัน
            'title' => 'รู้จัก "ผิวมัน" ให้ดียิ่งขึ้น',
            'points' => [
                '🔘 พบน้ำมันเคลือบผิวหนาแน่น โดยเฉพาะบริเวณ T-Zone',
                '🔘 รูขุมขนมีลักษณะกว้างและเห็นชัดจากการผลิตน้ำมันมาก',
                '🔘 มักเกิดปัญหาสิวเสี้ยนและสิวอักเสบอุดตันได้ง่าย',
                '🔘 ผิวมีความหนาและทนทานต่อมลภาวะได้ดีกว่าผิวแห้ง'
            ]
        ];
    } elseif (strpos($result, 'ผิวผสม') !== false) {
        $result_for_db = "ผิวผสม";
        $skin_knowledge = [
            'image' => 'images/ผิวผสม.png',
            'bg_color' => '#91aabf', // ปรับสีพื้นหลังสำหรับผิวผสม
            'title' => 'รู้จัก "ผิวผสม" ให้ดียิ่งขึ้น',
            'points' => [
                '🔘 ผิวมันบริเวณ T-Zone (หน้าผาก จมูก คาง)',
                '🔘 ผิวแห้งหรือปกติบริเวณ U-Zone (แก้มและลำคอ)',
                '🔘 รูขุมขนกว้างเฉพาะจุดที่มัน และเล็กลงในจุดที่แห้ง',
                '🔘 ต้องการการดูแลที่แตกต่างกันในแต่ละส่วนของใบหน้า'
            ]
        ];
    } else {
        $result_for_db = "ผิวแพ้ง่าย";
        $skin_knowledge = [
            'image' => 'images/ผิวแพ้ง่าย.png',
            'bg_color' => '#edc2bb', // ปรับสีพื้นหลังสำหรับผิวแพ้ง่าย (โทนแดงระเรื่อ)
            'title' => 'รู้จัก "ผิวแพ้ง่าย" ให้ดียิ่งขึ้น',
            'points' => [
                '🔘 เกราะป้องกันผิวอ่อนแอ ไวต่อสภาพแวดล้อมและสารเคมี',
                '🔘 มักมีอาการระคายเคือง แสบแดง หรือผดผื่นบ่อยครั้ง',
                '🔘 ผิวไวต่อแสงแดดและสภาพอากาศที่เปลี่ยนแปลง',
                '🔘 ต้องการผลิตภัณฑ์ที่ปราศจากน้ำหอมและแอลกอฮอล์'
            ]
        ];
    }
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ผลการวิเคราะห์ผิว - SkinMatch</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        body { 
            background-color: <?php echo $skin_knowledge['bg_color']; ?>; 
            font-family: 'Sarabun', sans-serif; 
            padding: 20px; 
            transition: background-color 0.5s ease;
        }
        .result-card { background: white; border-radius: 25px; padding: 40px; box-shadow: 0 15px 35px rgba(0,0,0,0.1); text-align: center; max-width: 850px; margin: auto; }
        .skin-type-badge { background: linear-gradient(45deg, #6c5ce7, #a29bfe); color: white; padding: 12px 35px; border-radius: 50px; display: inline-block; font-size: 1.4rem; margin-bottom: 20px; font-weight: bold; }
        
        .knowledge-section { 
            background: #f8faff; 
            border: 2px dashed #a29bfe; 
            border-radius: 25px; 
            padding: 30px; 
            margin: 30px 0; 
            text-align: left;
        }
        .knowledge-img { 
            width: 100%; 
            height: 250px; 
            object-fit: cover; 
            border-radius: 20px; 
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }
        .knowledge-point { list-style: none; padding-left: 0; line-height: 2; color: #4a4a4a; }
        .btn-action { border-radius: 50px; padding: 12px 30px; font-weight: bold; text-decoration: none; display: inline-block; transition: 0.3s; }
        .btn-primary:hover { background-color: #5b2c6f; transform: scale(1.05); }
    </style>
</head>
<body>

    <div class="result-card">
        <h4 class="text-muted mb-3">ผลการวิเคราะห์ผิวของคุณคือ...</h4>
        <div class="skin-type-badge shadow-sm"><?php echo $result; ?></div>
        <p class="lead mb-4 text-secondary"><?php echo $description; ?></p>

        <div class="knowledge-section">
            <div class="row align-items-center">
                <div class="col-md-5 text-center mb-4 mb-md-0">
                    <img src="<?php echo $skin_knowledge['image']; ?>" class="knowledge-img">
                    <p class="mt-2 text-muted small fst-italic">* ภาพจำลองลักษณะสภาพผิว</p>
                </div>
                <div class="col-md-7">
                    <h4 class="fw-bold mb-3" style="color: #6c5ce7;">✨ <?php echo $skin_knowledge['title']; ?></h4>
                    <ul class="knowledge-point">
                        <?php foreach ($skin_knowledge['points'] as $point): ?>
                            <li><?php echo $point; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <a href="skin_quiz.php" class="btn btn-outline-secondary btn-action me-2">ทำแบบประเมินใหม่</a>
            <a href="products.php?skin_type=<?php echo $result_for_db; ?>" class="btn btn-primary btn-action shadow" style="color: white; background-color: #8e44ad; border-color: #8e44ad;">
                ดูสินค้าที่เหมาะกับคุณ ✨
            </a>
        </div>
    </div>

</body>
</html>