<?php
session_start();
include 'config.php';

// ตรวจสอบว่าเข้าสู่ระบบหรือยัง
if (!isset($_SESSION['username'])) {
    echo "<script>alert('กรุณาเข้าสู่ระบบก่อนเลือกรายการโปรดนะจ๊ะ 💜'); window.location.href='login.php';</script>";
    exit();
}

$username = $_SESSION['username'];
$p_id = isset($_GET['p_id']) ? mysqli_real_escape_string($conn, $_GET['p_id']) : '';

if ($p_id != '') {
    // 1. ตรวจสอบว่ามีสินค้านี้ในตาราง favorites หรือยัง
    $check_sql = "SELECT * FROM favorites WHERE username = '$username' AND product_id = '$p_id'";
    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        // ถ้ามีอยู่แล้ว ให้เด้งไปหน้า favorites.php เลยโดยไม่ต้องแจ้งเตือนซ้ำ (หรือจะเก็บ alert ไว้ก็ได้ตามชอบจ้า)
        header("location: favorites.php");
        exit();
    } else {
        // 2. ถ้ายังไม่มี ให้ดึงข้อมูลจากตาราง products มาบันทึกลง favorites
        $product_sql = "SELECT * FROM products WHERE id = '$p_id'";
        $product_result = mysqli_query($conn, $product_sql);
        $product = mysqli_fetch_assoc($product_result);

        if ($product) {
            $name = mysqli_real_escape_string($conn, $product['name']);
            $img = mysqli_real_escape_string($conn, $product['image_url']);
            // ตรวจสอบชื่อ column รายละเอียดในตาราง products ของหนู (เช่น detail หรือ description)
            $detail = mysqli_real_escape_string($conn, $product['detail']); 

            $insert_sql = "INSERT INTO favorites (username, product_id, product_name, product_img, product_detail) 
                           VALUES ('$username', '$p_id', '$name', '$img', '$detail')";
            
            if (mysqli_query($conn, $insert_sql)) {
                // บันทึกสำเร็จแล้วให้เด้งไปหน้า favorites.php ทันที
                header("location: favorites.php");
                exit();
            } else {
                echo "เกิดข้อผิดพลาดในการบันทึก: " . mysqli_error($conn);
            }
        }
    }
} else {
    header("location: index.php");
}
?>