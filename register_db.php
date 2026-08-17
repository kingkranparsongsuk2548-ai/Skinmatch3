<?php
include('config.php');

if (isset($_POST['btn_register'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    // 1. เช็ครหัสผ่านตรงกันไหม
    if ($password !== $password_confirm) {
        header("location: register.php?error=password_mismatch");
        exit();
    }

    // 2. เช็คความยาวรหัสผ่าน (6 ตัวขึ้นไป)
    if (strlen($password) < 6) {
        header("location: register.php?error=password_too_short");
        exit();
    }

    // 3. บันทึกข้อมูล
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password_hash')";

    if (mysqli_query($conn, $sql)) {
        // บันทึกสำเร็จ ส่งไปหน้า Success Page ที่เราทำไว้
        header("location: register_success.php");
        exit();
    } else {
        // บันทึกพลาด ส่ง error ไปบอกที่หน้า register
        header("location: register.php?error=db_error");
        exit();
    }
    
} else {
    // ถ้าไม่ได้กดปุ่มสมัครสมาชิก ให้ดีดกลับไปหน้า register
    header("location: register.php");
    exit();
}

?>
