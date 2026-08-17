<?php 
    session_start();
    if (!isset($_SESSION['username'])) { header("location: login.php"); exit(); }
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>แบบประเมินผิว - SkinBuddy</title>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            background: linear-gradient(-45deg, #f6dfff, #e0c3fc, #ffffff, #f6dfff); 
            background-attachment: fixed;
            font-family: 'Kanit', sans-serif; 
            padding-bottom: 50px; 
        }
        .quiz-card { 
            background: rgba(255, 255, 255, 0.7); 
            backdrop-filter: blur(10px); 
            border-radius: 20px; 
            padding: 30px; 
            border: none; 
            margin-bottom: 25px; 
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            animation: fadeInUp 0.8s ease-out;
        }
        @keyframes fadeInUp { 0% { opacity: 0; transform: translateY(30px); } 100% { opacity: 1; transform: translateY(0); } }
        
        h5 { color: #8e44ad; font-weight: 600; margin-bottom: 20px; }
        
        .option-box { 
            border: 2px solid rgba(142, 68, 173, 0.2); 
            border-radius: 12px; 
            padding: 15px 20px; 
            margin-bottom: 10px; 
            cursor: pointer; 
            transition: 0.3s; 
            display: block; 
            background: rgba(255,255,255,0.5);
        }
        .option-box:hover { border-color: #8e44ad; background-color: #fff; transform: translateX(5px); }
        
        .btn-check:checked + .option-box { 
            border-color: #8e44ad; 
            background-color: #e8d0f7; 
            box-shadow: 0 0 15px rgba(142, 68, 173, 0.3);
            font-weight: bold;
        }
        
        .btn-submit { 
            background: linear-gradient(to right, #8e44ad, #d6b4fc); 
            border: none; 
            color: white; 
            padding: 15px 40px; 
            border-radius: 15px; 
            font-weight: 600; 
            transition: 0.3s; 
        }
        .btn-submit:hover { transform: scale(1.05); box-shadow: 0 5px 20px rgba(142,68,173,0.4); }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="text-center mb-4 fw-bold" style="color: #8e44ad;">วิเคราะห์สภาพผิวของคุณ ✨</h2>
                <form action="process_quiz.php" method="POST">
                    
                    <div class="quiz-card">
                        <h5>1. หลังจากล้างหน้าเสร็จและซับให้แห้ง ทิ้งไว้ 30 นาที ผิวของคุณรู้สึกอย่างไร?</h5>
                        <input type="radio" class="btn-check" name="q1" id="q1a" value="A" required>
                        <label class="option-box" for="q1a">A: รู้สึกตึงผิวมาก บางครั้งมีขุยขาวๆ ขึ้นที่แก้มหรือรอบปาก</label>
                        <input type="radio" class="btn-check" name="q1" id="q1b" value="B">
                        <label class="option-box" for="q1b">B: ผิวเริ่มมีความมันวาวทั่วใบหน้า รูขุมขนดูชัดขึ้น</label>
                        <input type="radio" class="btn-check" name="q1" id="q1c" value="C">
                        <label class="option-box" for="q1c">C: มันช่วงหน้าผากและจมูก (T-Zone) แต่ช่วงแก้มยังรู้สึกแห้งหรือตึงอยู่</label>
                        <input type="radio" class="btn-check" name="q1" id="q1d" value="D">
                        <label class="option-box" for="q1d">D: มีรอยแดง คัน หรือรู้สึกยิบๆ แสบผิวเล็กน้อย</label>
                    </div>

                    <div class="quiz-card">
                        <h5>2. ในช่วงบ่ายของวันปกติ ผิวหน้าของคุณมักจะมีสภาพเป็นอย่างไร?</h5>
                        <input type="radio" class="btn-check" name="q2" id="q2a" value="A" required>
                        <label class="option-box" for="q2a">A: ผิวดูหมองคล้ำ ไม่สดใส และอาจมีอาการลอกเป็นแผ่นเล็กๆ</label>
                        <input type="radio" class="btn-check" name="q2" id="q2b" value="B">
                        <label class="option-box" for="q2b">B: หน้ามันเยิ้มจนต้องใช้กระดาษซับมัน หรือเครื่องสำอางหลุดง่าย</label>
                        <input type="radio" class="btn-check" name="q2" id="q2c" value="C">
                        <label class="option-box" for="q2c">C: หน้ามันเฉพาะช่วงจมูกและหน้าผาก แต่ส่วนอื่นยังดูปกติ</label>
                        <input type="radio" class="btn-check" name="q2" id="q2d" value="D">
                        <label class="option-box" for="q2d">D: ผิวเห่อแดงง่ายเมื่อเจอแดด หรือรู้สึกระคายเคืองเมื่ออากาศเปลี่ยน</label>
                    </div>

                    <div class="quiz-card">
                        <h5>3. เมื่อส่องกระจกใกล้ๆ คุณสังเกตเห็นรูขุมขนเป็นอย่างไร?</h5>
                        <input type="radio" class="btn-check" name="q3" id="q3a" value="A" required>
                        <label class="option-box" for="q3a">A: รูขุมขนเล็กมากจนแทบมองไม่เห็น ผิวดูละเอียดแต่ขาดความเงา</label>
                        <input type="radio" class="btn-check" name="q3" id="q3b" value="B">
                        <label class="option-box" for="q3b">B: รูขุมขนกว้างและเห็นชัดเจนเกือบทั่วใบหน้า มักมีสิวเสี้ยนร่วมด้วย</label>
                        <input type="radio" class="btn-check" name="q3" id="q3c" value="C">
                        <label class="option-box" for="q3c">C: รูขุมขนกว้างเฉพาะบริเวณจมูกและหน้าแก้มส่วนกลาง</label>
                        <input type="radio" class="btn-check" name="q3" id="q3d" value="D">
                        <label class="option-box" for="q3d">D: รูขุมขนดูไม่ชัด แต่ผิวมีรอยจ้ำแดงหรือผดผื่นเล็กๆ ขึ้นง่าย</label>
                    </div>

                    <div class="quiz-card">
                        <h5>4. เมื่อคุณเปลี่ยนสกินแคร์หรือลองใช้ผลิตภัณฑ์ใหม่ ผิวของคุณมักจะ...</h5>
                        <input type="radio" class="btn-check" name="q4" id="q4a" value="A" required>
                        <label class="option-box" for="q4a">A: ไม่ค่อยรู้สึกอะไร แต่อาจจะรู้สึกว่าครีมไม่ค่อยซึมเข้าผิว</label>
                        <input type="radio" class="btn-check" name="q4" id="q4b" value="B">
                        <label class="option-box" for="q4b">B: ไม่ค่อยแพ้ แต่อาจจะกังวลเรื่องการอุดตันหรือสิวขึ้นมากกว่า</label>
                        <input type="radio" class="btn-check" name="q4" id="q4c" value="C">
                        <label class="option-box" for="q4c">C: มักจะมีอาการแสบ ร้อน หรือแดงในทันทีที่ใช้</label>
                        <input type="radio" class="btn-check" name="q4" id="q4d" value="D">
                        <label class="option-box" for="q4d">D: ใช้ได้ปกติ ไม่ค่อยมีอาการแพ้หรือระคายเคือง</label>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn-submit">ส่งคำตอบเพื่อวิเคราะห์ผิว</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>