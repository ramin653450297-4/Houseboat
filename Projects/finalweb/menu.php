<!DOCTYPE html>
<html lang="en">
<head>
<?php
    require 'server.php';
    session_start();
    if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        header("Location: login.php"); 
        exit;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['check_in']) && isset($_POST['check_out'])) {
            $_SESSION['check_in'] = $_POST['check_in'];
            $_SESSION['check_out'] = $_POST['check_out'];
        }
        if(isset($_GET['cus_name']) && isset($_GET['rm_id'])) {
            $cus_name = $_GET['cus_name'];
            $rm_id = $_GET['rm_id'];
        }
    }
    
    
   
?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ชุดหมูกระทะ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit&display=swap');

        body {
            font-family: 'Kanit', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            margin-top: 50px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative; /* ให้เป็น relative เพื่อให้สามารถกำหนดตำแหน่งให้กับไอคอนตะกร้าได้ */
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr); 
            gap: 20px; 
        }

        .menu-item {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .menu-item img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            background-color: white;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #004080;
            color: #fff;
        }

        button {
            background-color: #004080;
            font-family: 'Kanit', sans-serif;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 20px;
        }

        button:hover {
            background-color: #2980b9;
            font-family: 'Kanit', sans-serif;
        }
        .right-corner {
            position: absolute;
            bottom: 10px; 
            right: 20px; 
        }
        .right-top {
            position: absolute;
            top: 10px; 
            right: 20px; 
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
                <a class="nav-link" href="home.php">หน้าหลัก</a>
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
                <a class="nav-link active" href="menu.php">เมนู</a>
            </li>
        </ul>
        <div class="d-flex">
            <a class="navbar-brand" href="showdetail.php"><img src="imges/logo/user.png" alt="logo" width="30"></a>
            <a href="logout.php" class="btn btn-outline-danger shadow-none">ออกจากระบบ</a>
        </div>
    </div>
    </nav>
    <div class="container">
    <a href="cart.php" class="right-top mt-4" style="color: black;">
        <i class="fa-solid fa-cart-plus" style="font-size: 24px; color: black;"></i>
    </a>

        <center><h1 class="mt-4">เซ็ตหมูกระทะ</h1></center>
        <div class="menu-grid">
        
            <?php
            $sql = "SELECT * FROM menu";
            $result = mysqli_query($conn, $sql);
            
            
            while ($row = mysqli_fetch_array($result)) {
            ?>
            <div class="menu-item mt-4">
                <h4><?= $row["mn_name"] ?></h4>
                <p>ไซส์: <?= nl2br($row["size"]) ?></p>
                <p>ราคา: <?= number_format($row["price"], 2) ?></p>
                <img src="imges/menu/<?= $row["mn_name"] ?>.jpg" alt="<?= $row["mn_name"] ?>" width="300" height="300">
                <p>รายละเอียด: <?= nl2br($row["note"]) ?></p>
                <form action="addmenu.php" method="post">
                    <input type="hidden" name="mn_id" value="<?= $row["mn_id"] ?>">
                    <label for="amount">เลือกจำนวน :</label>
                    <select name="amount" id="amount">
                        <?php
                        for ($i = 1; $i <= 10; $i++) {
                            echo "<option value='$i'>$i</option>";
                        }
                        ?>
                    </select>
                    
                    <button type="submit">เลือก</button>
                </form></div>
                <?php    } ?>
                
        
        <?php $sqlIn = "SELECT * FROM ingredients";
         $resultIn = mysqli_query($conn, $sqlIn);
         
         while ($rowIn = mysqli_fetch_array($resultIn)) {
         ?>
         <div class="menu-item mt-4">
             <h4><?= $rowIn["in_name"] ?></h4>
             <p>จำนวน: <?= nl2br($rowIn["in_unit"]) ?></p>
             <p>ราคา: <?= number_format($rowIn["in_price"], 2) ?></p>
             <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($rowIn["in_picture"]) . '" alt="ingredients Picture"> ';  ?>
             <form action="addmenu.php" method="post">
                 <input type="hidden" name="in_id" value="<?= $rowIn["in_id"] ?>">
                 <label for="amount">เลือกจำนวน :</label>
                 <select name="amount" id="amount">
                     <?php
                     for ($i = 1; $i <= 10; $i++) {
                         echo "<option value='$i'>$i</option>";
                     }
                     ?>
                 </select>
                 <button type="submit">เลือก</button>
             </form>
             </div>
             
         <?php
         }
         ?>
         </div>
    </div>
    
</body>
</html>
