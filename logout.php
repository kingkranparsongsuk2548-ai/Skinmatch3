<?php 
    session_start(); // เรียกใช้ session เพื่อให้รู้ว่าเป็นใคร
    session_destroy(); // ล้างข้อมูลการ Login ทั้งหมดทิ้ง
    header("location: login.php"); // ส่งกลับไปหน้าเข้าสู่ระบบ
    exit();
?>