<?php
session_start(); 
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { 
            margin: 0; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
            background: radial-gradient(circle, #ffffff 0%, #f6dfff 100%); 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            flex-direction: column; 
        }
        
        .logo {
            width: 500px; 
            opacity: 0;
            transition: all 1.5s ease;
            filter: drop-shadow(0px 10px 20px rgba(142, 68, 173, 0.2));
            margin-bottom: 20px;
        }

        #welcome-text { 
            font-size: 3.5rem; 
            font-weight: 800; 
            background: linear-gradient(120deg, #8e44ad 30%, #ffffff 50%, #8e44ad 70%);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 4px 15px rgba(142, 68, 173, 0.2);
            
            /* ปรับจาก 2s เป็น 4s ให้แสงวิ่งช้าลงและดูนุ่มนวลขึ้น */
            animation: shimmer 4s linear infinite;
            
            opacity: 0;      
            transition: all 1.5s ease; 
        }

        @keyframes shimmer {
            0% { background-position: -100% center; }
            100% { background-position: 100% center; }
        }
    </style>
</head>
<body>

    <img src="images/โลโก้อุอิอา.png" class="logo" id="logo">
    <div id="welcome-text">Welcome to SkinBuddy</div>
    
    <script>
        window.onload = function() {
            const logo = document.getElementById('logo');
            const text = document.getElementById('welcome-text');

            // 1. Fade In (แสดงผล)
            setTimeout(function() {
                logo.style.opacity = '1';
                text.style.opacity = '1';
            }, 500);

            // 2. Fade Out (ชะลอให้นานขึ้น เป็น 4.5 วินาที)
            setTimeout(function() {
                logo.style.opacity = '0';
                text.style.opacity = '0';
            }, 4500); 

            // 3. เปลี่ยนหน้า (ชะลอไปที่ 6 วินาที)
            setTimeout(function() {
                window.location.href = 'index.php';
            }, 6000); 
        };
    </script>
</body>
</html>