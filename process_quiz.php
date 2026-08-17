<?php
session_start();
include('config.php'); // --- เพิ่ม: ดึงไฟล์เชื่อมต่อฐานข้อมูลมาใช้ ---

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $answers = [$_POST['q1'], $_POST['q2'], $_POST['q3'], $_POST['q4']];
    
    // นับจำนวนคำตอบแต่ละประเภท
    $counts = array_count_values($answers);
    
    $result = "";
    $description = "";

    // LOGIC: ถ้ามีการตอบ D แม้เพียงข้อเดียว หรือตอบ D มากที่สุด -> ผิวแพ้ง่าย
    if (in_array("D", $answers)) {
        $result = "ผิวแพ้ง่าย (Sensitive Skin)";
        $description = "ผิวของคุณบอบบางและระคายเคืองได้ง่าย ควรเลือกใช้ผลิตภัณฑ์ที่ปราศจากน้ำหอม แอลกอฮอล์ และสารเคมีรุนแรง";
    } else {
        // หาค่าที่ตอบมากที่สุด (A, B, หรือ C)
        $max_val = "A";
        $max_count = 0;
        foreach ($counts as $key => $val) {
            if ($val > $max_count) {
                $max_count = $val;
                $max_val = $key;
            }
        }

        if ($max_val == "A") {
            $result = "ผิวแห้ง (Dry Skin)";
            $description = "ผิวของคุณขาดน้ำมันตามธรรมชาติ มักรู้สึกตึงและเป็นขุย ควรเน้นการเติมความชุ่มชื้นด้วยมอยส์เจอไรเซอร์เนื้อเข้มข้น";
        } elseif ($max_val == "B") {
            $result = "ผิวมัน (Oily Skin)";
            $description = "ผิวของคุณมีการผลิตน้ำมันมากเกินไป ทำให้รูขุมขนกว้างและเกิดสิวง่าย ควรใช้ผลิตภัณฑ์เนื้อเจลหรือเซรั่มที่คุมมัน";
        } elseif ($max_val == "C") {
            $result = "ผิวผสม (Combination Skin)";
            $description = "ผิวของคุณมีความมันบริเวณ T-Zone (หน้าผาก จมูก) แต่แห้งบริเวณแก้ม ควรดูแลผิวแบบแยกส่วนเพื่อความสมดุล";
        }
    }

    // --- เริ่มโค้ดที่เพิ่มใหม่: บันทึกผลลง Database ---
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        // อัปเดตสภาพผิวลงในตาราง users ตาม ID ของคนที่ล็อคอินอยู่
        $update_sql = "UPDATE users SET skin_type = '$result' WHERE id = '$user_id'";
        mysqli_query($conn, $update_sql);
    }
    // --- จบโค้ดที่เพิ่มใหม่ ---

    // เก็บผลลัพธ์ไว้แสดงในหน้าถัดไป
    $_SESSION['skin_result'] = $result;
    $_SESSION['skin_description'] = $description;

    header("location: result.php");
    exit();
}
?>