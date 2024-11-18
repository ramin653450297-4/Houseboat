<?php 
session_start();
if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php"); 
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>House boat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
    <style>
        *{
            font-family: 'Kanit', sans-serif;
        }
        .custom-bg{
            background-color: #1a237e;
        }
        .custom-bg:hover{
            background-color: #111755;
        }
        .availability-form{
            margin-top: -50px ;
            z-index: 2;
            position: relative;
            text-align: center
        }
        @media screen and (max-width: 575px) {
            .availability-form{
                margin-top: 25px;
                padding: 0 35px;
            }
        }
        .map-container{
            overflow:hidden;
            padding-bottom:56.25%;
            position:relative;
            height:0;
            }
            .map-container iframe{
            left:0;
            top:0;
            height:100%;
            width:100%;
            position:absolute;
            }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="home.php"><img src="imges/logo/logo.png" alt="logo" width="40"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item me-2">
                <a class="nav-link active" href="home.php">หน้าหลัก</a>
            </li>
            <li class="nav-item me-2">
                <a class="nav-link" href="roomcus.php">ห้องพัก</a>
            </li>
            <li class="nav-item me-2">
                <a class="nav-link" href="activitycus.php">กิจกรรม</a>
            </li>
            <li class="nav-item me-2">
                <a class="nav-link" href="cusbooking.php">การจอง</a>
            </li>
            <li class="nav-item me-2">
                <a class="nav-link" href="menu.php">เมนู</a>
            </li>
        </ul>
        <div class="d-flex">
            <a class="navbar-brand" href="showdetail.php"><img src="imges/logo/user.png" alt="logo" width="30"></a>
            <a href="logout.php" class="btn btn-outline-danger shadow-none">ออกจากระบบ</a>
        </div>
    </div>
    </nav>

    <!-- Cover -->
    <div class="container-fluid px-lg-4 mt-4">
        <div class="swiper swiper-container">
            <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img src="imges/cover/1.jpg" class="w-100 d-block"/>
            </div>
            <div class="swiper-slide">
                <img src="imges/cover/2.jpg" class="w-100 d-block"/>
            </div>
            <div class="swiper-slide">
                <img src="imges/cover/3.jpg" class="w-100 d-block"/>
            </div>
            <div class="swiper-slide">
                <img src="imges/cover/4.jpg" class="w-100 d-block"/>
            </div>
            <div class="swiper-slide">
                <img src="imges/cover/5.jpg" class="w-100 d-block"/>
            </div>
            <div class="swiper-slide">
                <img src="imges/cover/6.jpg" class="w-100 d-block"/>
            </div>
        </div>
    </div>

    <!-- check availability form -->

    <div class="container availability-form mx-auto">
            <div class="row">
                <div class="col-lg-8 bg-white shadow shadow p-4 rounded">
                <h5 class="mb-4">ค้นหาห้องพัก</h5>
                    <form name="formsearch" action="searchroomcus.php" method="post">
                        <div class="row align-items-end">
                            <div class="col-lg-3 mb-3">
                                <label class="form-label">เช็คอิน</label>
                                <input type="date" class="form-control shadow-none" name="check_in" id="check_in" min="<?php echo date('Y-m-d'); ?>">
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label class="form-label">เช็คเอ้าท์</label>
                                <input type="date" class="form-control shadow-none" name="check_out" id="check_out" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>">
                            </div>
                            
                            <div class="col-lg-3 mb-3">
                                <label class="form-label">จํานวนคน</label>
                                <select class="form-select shadow-none " name="amount" value="<?php echo $amount; ?>">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </div>
                            <div class="col-lg-1 mb-lg-3 mt-2">
                                <button type="submit" class="btn text-white shadow-none custom-bg">ค้นหา</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </div>
    <div class="container mt-4">
        <div class="d-inline-block">
        <h1>HouseBoat</h1>
        <img src="https://lh3.googleusercontent.com/p/AF1QipPqoUcCmCj0PTCqaQh-khU3hg-2RtSCFIL9CyCe=s1360-w1360-h1020" class="float-start rounded mt-4 me-5" height="250">
        <img src="https://www.rattanacholhotel.com/wp-content/uploads/2022/03/extra-sha-plusLOGO-SHA-EXTRA-PLUS-3.jpg" class="mx-auto rounded mt-4 me-5" height="250">
        <img src="https://lh3.googleusercontent.com/p/AF1QipPw1P06w_uDxRLv0p8Td1J31cSb1piagsE-kBMo=s1360-w1360-h1020" class="float-end rounded mt-4 " height="250">
        <h1 class="mt-4">MAP</h1>
        <div id="map-container-google-1" class="z-depth-1-half map-container mt-4" style="height: 500px">
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15760.26319552153!2d98.631874!3d9.057763!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30512d1171885e57%3A0xe1464a0720e523c4!2s500Rai%20Floating%20Resort!5e0!3m2!1sen!2sth!4v1708417721866!5m2!1sen!2sth" frameborder="0"
            style="border:0" allowfullscreen></iframe>
        </div>
    </div>
        <br>
    </div>
    <br>
   <div class="container p-5 my-5 border">
    <div class="row">
        <h2><center>ข้อมูลเพิ่มเติม</center></h2>
          <div class="col-sm-4 mt-4">
          <i class="fa-brands fa-pagelines"><h3>ธรรมชาติ</h3></i>
            <p>หลีกหนีความวุ่นวายจากโลกภายนอก ให้ธรรมชาติได้บำบัด พื้นที่สีเขียว</p>
          </div>
          <div class="col-sm-4  mt-4">
          <i class="fa-solid fa-camera-retro"><h3>จุดไฮไลท์</h3></i>
            <p>จุดไฮไลท์ไม่ได้มีแค่สายน้ำเรือนแพ ยังมีความอร่อยให้เลือกอีกมากมาย มีหลายโซนไว้บริการลูกค้า โชนล่องแพ โซนคาเฟ่ และร้านอาหาร</p>
          </div>
          <div class="col-sm-4  mt-4">
          <i class="fa-solid fa-headset"><h3>ติดต่อเรา</h3></i>        
            <p>สามารถติดต่อเราผ่านช่องทาง</p>
            <p>Facebook , Line, Email</p>
          </div>
        </div>
      </div>
      
      

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
    var swiper = new Swiper(".swiper-container", {
      spaceBetween: 30,
      effect: "fade",
      loop: true,
      autoplay: {
        deplay: 3500,
        disableOnInteraction: false,
      }
    });
  </script>


</body>
</html>