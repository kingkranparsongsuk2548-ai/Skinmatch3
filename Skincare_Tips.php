<?php
    // หน้า FAQ & Skincare Tips (SkinBuddy) - โทนม่วงชมพูพาสเทล 💜🩷
    // สามารถ include 'header.php' หรือ 'navbar.php' ของเพื่อนมาใส่ตรงนี้ได้เลยน้า
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เกร็ดความรู้ & FAQ - SkinBuddy</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Kanit', 'Sarabun', sans-serif;
        }
        /* พื้นหลังปรับเป็นไล่เฉดม่วงพาสเทลอ่อนๆ ไปชมพูพาสเทล */
        body {
            background: linear-gradient(135deg, #f3e8ff 0%, #ffe4e1 100%);
            color: #4a4a4a;
            margin: 0;
            padding: 20px;
            min-height: 100vh;
        }
        .faq-container {
            max-width: 700px;
            margin: 40px auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 24px;
            box-shadow: 0 10px 25px rgba(186, 104, 200, 0.25);
            border: 2px solid #f3e8ff;
        }
        h1 {
            text-align: center;
            background: linear-gradient(45deg, #ab47bc, #ff69b4);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 8px;
            font-size: 26px;
        }
        .subtitle {
            text-align: center;
            color: #8e8e93;
            margin-bottom: 20px;
            font-size: 14px;
        }

        /* Style สำหรับแท็บเลือกหมวดหมู่ (Filter Category Tabs) - ม่วงชมพูพาสเทล */
        .category-tabs {
            display: flex;
            justify-content: center;
            gap: 8px;
            flex-wrap: wrap;
            margin-bottom: 25px;
        }
        .tab-btn {
            background-color: #fcf8ff;
            border: 1.5px solid #e1bee7;
            color: #ab47bc;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .tab-btn:hover {
            background-color: #f3e8ff;
            border-color: #ce93d8;
            transform: translateY(-2px);
        }
        .tab-btn.active {
            background: linear-gradient(135deg, #ce93d8, #ff80ab);
            color: #ffffff;
            border-color: transparent;
            box-shadow: 0 4px 12px rgba(171, 71, 188, 0.3);
        }

        /* Style สำหรับกล่อง Accordion */
        .faq-item {
            border: 2px solid #f3e8ff;
            border-radius: 16px;
            margin-bottom: 15px;
            overflow: hidden;
            transition: 0.3s;
        }
        .faq-item:hover {
            border-color: #ce93d8;
        }
        .faq-question {
            background-color: #fcf8ff;
            color: #8e24aa;
            padding: 18px 20px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            user-select: none;
        }
        .faq-question::after {
            content: '💜';
            font-size: 14px;
            transition: transform 0.3s ease;
        }
        .faq-item.active .faq-question::after {
            transform: rotate(180deg);
        }
        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out, padding 0.3s ease;
            background-color: #ffffff;
            padding: 0 20px;
            color: #555;
            line-height: 1.6;
            font-size: 15px;
        }
        .faq-item.active .faq-answer {
            padding: 15px 20px 20px 20px;
            overflow-y: auto;
        }

        /* Style สำหรับกล่องถามคำถามเพิ่มเติม */
        .ask-box {
            margin-top: 35px;
            padding: 20px;
            background-color: #fcf8ff;
            border: 2px dashed #ce93d8;
            border-radius: 20px;
            text-align: center;
        }
        .ask-box h3 {
            margin: 0 0 8px 0;
            color: #8e24aa;
            font-size: 18px;
        }
        .ask-box p {
            margin: 0 0 15px 0;
            color: #777;
            font-size: 13px;
        }
        .ask-form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .ask-input {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid #e1bee7;
            border-radius: 12px;
            font-family: inherit;
            font-size: 14px;
            outline: none;
            resize: vertical;
            transition: 0.3s;
        }
        .ask-input:focus {
            border-color: #ab47bc;
            box-shadow: 0 0 8px rgba(171, 71, 188, 0.2);
        }
        .send-btn {
            background: linear-gradient(135deg, #ab47bc, #ff69b4);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 12px;
            font-weight: bold;
            font-size: 14px;
            cursor: pointer;
            transition: 0.3s;
            box-shadow: 0 4px 10px rgba(171, 71, 188, 0.25);
        }
        .send-btn:hover {
            opacity: 0.95;
            transform: scale(1.02);
        }

        .back-btn {
            display: block;
            width: fit-content;
            margin: 25px auto 0;
            padding: 10px 24px;
            background: linear-gradient(135deg, #ce93d8, #ff80ab);
            color: white;
            text-decoration: none;
            border-radius: 20px;
            font-weight: bold;
            transition: 0.3s;
            box-shadow: 0 4px 10px rgba(206, 147, 216, 0.3);
        }
        .back-btn:hover {
            transform: scale(1.05);
            opacity: 0.95;
        }

        /* 🌸 Style สำหรับ Custom Modal ป็อปอัปพาสเทลกลางหน้าจอ 🌸 */
        .custom-modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(74, 20, 140, 0.25);
            backdrop-filter: blur(4px);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }
        .custom-modal-overlay.show {
            opacity: 1;
            visibility: visible;
        }
        .custom-modal {
            background: #ffffff;
            width: 90%;
            max-width: 420px;
            padding: 30px 25px;
            border-radius: 24px;
            text-align: center;
            box-shadow: 0 15px 30px rgba(171, 71, 188, 0.3);
            transform: scale(0.8);
            transition: transform 0.3s ease;
            border: 2px solid #f3e8ff;
        }
        .custom-modal-overlay.show .custom-modal {
            transform: scale(1);
        }
        .modal-icon {
            font-size: 45px;
            margin-bottom: 10px;
        }
        .modal-title {
            color: #ab47bc;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .modal-desc {
            color: #666;
            font-size: 14px;
            line-height: 1.5;
            margin-bottom: 20px;
        }
        .modal-btn {
            background: linear-gradient(135deg, #ab47bc, #ff69b4);
            color: white;
            border: none;
            padding: 10px 28px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 14px;
            cursor: pointer;
            transition: 0.3s;
        }
        .modal-btn:hover {
            transform: scale(1.05);
            opacity: 0.95;
        }
    </style>
</head>
<body>

<div class="faq-container">
    <h1>💡 เกร็ดความรู้ & FAQ สกินแคร์</h1>
    <p class="subtitle">รวมคำถามยอดฮิตและทริกดูแลผิวสไตล์ SkinBuddy</p>

    <!-- แถบปุ่มเลือกหมวดหมู่ -->
    <div class="category-tabs">
        <button class="tab-btn active" onclick="filterCategory('all', this)">✨ ทั้งหมด</button>
        <button class="tab-btn" onclick="filterCategory('routine', this)">🧴 ขั้นตอนการทา</button>
        <button class="tab-btn" onclick="filterCategory('skin-issues', this)">🥊 ปัญหาผิว/สิว</button>
        <button class="tab-btn" onclick="filterCategory('ingredients', this)">🧪 ส่วนผสม</button>
    </div>

    <!-- รายการ FAQ (กำหนด data-category ให้แต่ละข้อ) -->
    <div class="faq-item" data-category="routine">
        <div class="faq-question">✨ เรียงลำดับการทาสกินแคร์อย่างไรให้ถูกต้อง?</div>
        <div class="faq-answer">
            หลักการง่าย ๆ คือ <strong>"ทาจากเนื้อบางเบา ไปหาเนื้อเข้มข้น"</strong> จ้า<br><br>
            ☀️ <strong>ตอนเช้า:</strong> คลีนซิ่ง ➔ โทนเนอร์ ➔ เซรั่ม ➔ มอยส์เจอไรเซอร์ ➔ <u>กันแดด (สำคัญมาก!)</u><br><br>
            🌙 <strong>ตอนกลางคืน:</strong> คลีนซิ่ง/คลีนซิ่งออยล์ ➔ โทนเนอร์ ➔ เซรั่ม/ยาทาสิว ➔ มอยส์เจอไรเซอร์
        </div>
    </div>

    <div class="faq-item" data-category="ingredients">
        <div class="faq-question">🌿 คนผิวแพ้ง่าย (Sensitive Skin) ควรเลี่ยงส่วนผสมอะไรบ้าง?</div>
        <div class="faq-answer">
            ควรหลีกเลี่ยงสกินแคร์ที่มีส่วนผสมของ <strong>น้ำหอม (Fragrance)</strong>, <strong>แอลกอฮอล์เข้มข้น (Alcohol Denat)</strong>, พาราเบน, และสารแต่งสีสังเคราะห์ รวมถึงไม่ควรสครับผิวแรง ๆ เพราะอาจทำให้เกราะป้องกันผิว (Skin Barrier) เสียหายได้จ้า
        </div>
    </div>

    <div class="faq-item" data-category="skin-issues">
        <div class="faq-question">💧 ผิวมันจำเป็นต้องทามอยส์เจอไรเซอร์ไหม?</div>
        <div class="faq-answer">
            <strong>จำเป็นอย่างยิ่งจ้า!</strong> ผิวมันหลายคนเกิดจากภาวะ "ผิวขาดน้ำ" ทำให้ต่อมไขมันต้องผลิตน้ำมันออกมาเยอะเกินไป การเลือกใช้น้ำมันหรือมอยส์เจอไรเซอร์เนื้อเจล (Gel Cream) บางเบา จะช่วยเติมความชุ่มชื้นและปรับสมดุลลดความมันบนใบหน้าได้ดีมาก ๆ เลยน้า
        </