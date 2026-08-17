<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ข้อมูลสภาพผิว - SkinMatch</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f0f2f5; font-family: 'Sarabun', sans-serif; padding: 30px; }
        .sidebar { background: white; padding: 20px; border-radius: 20px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
        .nav-link { color: #6c5ce7; font-weight: bold; border-radius: 10px; margin-bottom: 10px; }
        .nav-link.active { background-color: #6c5ce7 !important; color: white !important; }
        .content-card { background: white; padding: 40px; border-radius: 20px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center mb-4">คู่มือดูแลผิวฉบับ SkinMatch</h2>
    <div class="row">
        <div class="col-md-3 sidebar">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist">
                <a class="nav-link active" data-bs-toggle="pill" href="#dry">ผิวแห้ง</a>
                <a class="nav-link" data-bs-toggle="pill" href="#oily">ผิวมัน</a>
                <a class="nav-link" data-bs-toggle="pill" href="#combo">ผิวผสม</a>
                <a class="nav-link" data-bs-toggle="pill" href="#sensitive">ผิวแพ้ง่าย</a>
            </div>
        </div>

        <div class="col-md-9">
            <div class="tab-content content-card">
                <div class="tab-pane fade show active" id="dry">
                    <h3>รู้จัก "ผิวแห้ง"</h3>
                    <p>รายละเอียดการดูแลผิวแห้ง...</p>
                </div>
                <div class="tab-pane fade" id="oily">
                    <h3>รู้จัก "ผิวมัน"</h3>
                    <p>รายละเอียดการดูแลผิวมัน...</p>
                </div>
                <div class="tab-pane fade" id="combo">
                    <h3>รู้จัก "ผิวผสม"</h3>
                    <p>รายละเอียดการดูแลผิวผสม...</p>
                </div>
                <div class="tab-pane fade" id="sensitive">
                    <h3>รู้จัก "ผิวแพ้ง่าย"</h3>
                    <p>รายละเอียดการดูแลผิวแพ้ง่าย...</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>