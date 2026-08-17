<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$conn = mysqli_connect("sql309.infinityfree.com", "if0_42676494", "eKotHM7n0g6vZ", "if0_42676494_skin_match_db");
if (!$conn) {
    die("เชื่อมต่อฐานข้อมูลล้มเหลว: " . mysqli_connect_error());
}
?>