<?php
session_start();
include('config.php');

// สั่งให้ระบบหน่วงเวลา 1.5 วินาที เพื่อให้เห็น Animation Loading ที่ปุ่ม
sleep(1.5); 

if (isset($_POST['btn_login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        
        if (password_verify($password, $row['password'])) {
            // ล็อกอินสำเร็จ
            $_SESSION['username'] = $row['username'];
            header("location: welcome.php");
            exit();
        } else {
            // รหัสผ่านผิด ส่งค่า error ไปที่ login.php
            header("location: login.php?error=wrong_pass");
            exit();
        }
    } else {
        // ไม่พบชื่อผู้ใช้ ส่งค่า error ไปที่ login.php
        header("location: login.php?error=user_not_found");
        exit();
    }
} else {
    // ถ้าไม่ได้กดปุ่ม login ให้กลับไปหน้า login
    header("location: login.php");
    exit();
}
?>