<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>กิจกรรม</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit&display=swap');
        body {
            font-family: 'Kanit', sans-serif;
            margin: 0;
            padding: 0;
            /* background-image: url('https://www.tripgether.com/wp-content/uploads/tripgetter/pae_3-scaled.jpg'); */
            background-size: cover;
            background-position: center;
        }

        h1 {
            text-align: center;
            margin-top: 30px;
            text-shadow: 0px 2px 4px rgba(0, 0, 0, 0.5);
            color: #1a237e;
            font-size: 50px;
        }

        .gallery {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 30px;
        }

        .gallery-item {
            position: relative;
        }

        .gallery img {
            width: 500px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .gallery img:hover {
            transform: scale(1.05);
        }

        .gallery p {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            background-color: rgba(0, 0, 0, 0.2);
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            text-align: center;
            font-size: 20px;
            max-width: 90%;
            line-height: 1.2;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }
        .right-corner {
        position: absolute;
        bottom: -150px;
        right:50px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php"><img src="imges/logo/logo.png" alt="logo" width="40"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item me-2">
                <a class="nav-link" href="index.php">หน้าหลัก</a>
            </li>
            <li class="nav-item me-2">
                <a class="nav-link" href="rooms.php">ห้องพัก</a>
            </li>
            <li class="nav-item me-2">
                <a class="nav-link active" href="activity.php">กิจกรรม</a>
            </li>
            <li class="nav-item me-2">
                <a class="nav-link" href="#">การจอง</a>
            </li>
        </ul>
        <div class="d-flex">
            <button type="button" class="btn btn-outline-dark shadow-none me-lg-3 me-2" data-bs-toggle="modal" data-bs-target="#loginModal">
                สมัคร
            </button>
            <button type="button" class="btn btn-outline-dark shadow-none" data-bs-toggle="modal" data-bs-target="#registerModal">
                เข้าสู่ระบบ
            </button>
        </div>
    </div>
    </nav>
    <h1>กิจกรรม</h1>
    <div class="gallery">
        <div class="gallery-item">
            <img src="https://www.chillpainai.com/src/wewakeup/scoop/img_scoop/scoop/kat/beautiful%20raft/500rai/11754915_841554609227662_3060870916074172922_o.jpg">
            <p>พายเรือคายัค<br>ราคา 500 บาท ต่อชั่วโมง</p>
        </div>
        <div class="gallery-item">
            <img src="https://แพกาญ.com/wp-content/uploads/2019/07/%E0%B9%81%E0%B8%9Echillsunset-12.jpg">
            <p>เล่นนํ้าที่แพ ChillSunset <br>ราคา 300 บาท ต่อชั่วโมง</p>
        </div>
        <div class="gallery-item">
            <img src="https://www.mylifemytravels.com/wp-content/uploads/2020/09/GOPR0017-1.jpg">
            <p>ล่องแพ<br>ราคา 200 บาท ครึ่งชั่วโมง</p>
        </div>
    </div>
</body>
</html>
