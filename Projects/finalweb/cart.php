<?php
session_start();
require 'server.php';

if(isset($_SESSION['cus_user'])) {
    // echo "ผู้ใช้เข้าสู่ระบบอยู่";
} else {
    echo "ไม่มีผู้ใช้เข้าสู่ระบบ";
}

if(isset($_GET['check_in']) && isset($_GET['check_out']) && isset($_GET['rm_id'])) {
    $check_in = $_GET['check_in'];
    $check_out = $_GET['check_out'];
    $rm_id = $_GET['rm_id'];
}

if(isset($_POST['mn_id']) && isset($_POST['amount'])) {
    $mn_id = $_POST['mn_id'];
    $amount = $_POST['amount'];
    
    $_SESSION['cart'][] = array(
        'mn_id' => $mn_id,
        'amount' => $amount
    );
}
if(isset($_POST['in_id']) && isset($_POST['amount'])) {
    $in_id = $_POST['in_id'];
    $amount = $_POST['amount'];

    $_SESSION['cart'][] = array(
        'in_id' => $in_id,
        'amount' => $amount
    );

}
if(isset($_GET['delete_index'])) {
    $index = $_GET['delete_index'];
    unset($_SESSION['cart'][$index]);
    header("Location: cart.php");
    exit();
}

// ดึงข้อมูล check_in และ check_out จากฐานข้อมูล
$sql_booking = "SELECT check_in, check_out ,rm_id,cus_name FROM detailbooking WHERE cus_name = '".$_SESSION['cus_name']."'";
$result_booking = mysqli_query($conn, $sql_booking);
$row_booking = mysqli_fetch_assoc($result_booking);
$check_in = $row_booking['check_in'];
$check_out = $row_booking['check_out'];
$rm_id = $row_booking['rm_id'];
$cus_name = $row_booking['cus_name'];
        
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตะกร้าสินค้า</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

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
            position: relative;
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
        padding: 5px 10px;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        position: fixed;
        bottom: 50px;
        right: 100px;
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
    </style>
</head>
<body>

    <div class="container">
    <center><h1>ตะกร้าสินค้าของห้อง <?php echo $rm_id; ?></h1></center>
        <?php
        // ตรวจสอบว่ามีรายการในตะกร้าหรือไม่
        if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            // หากมีรายการ ให้แสดงตารางของรายการที่อยู่ในตะกร้า
            ?>
            <table>
                <tr>
                    <th>รายการ</th>
                    <th>จำนวน</th>
                    <th>ราคาต่อหน่วย</th>
                    <th>ราคารวม</th>
                    <th>ลบ</th>
                </tr>
                <?php


                $totalPrice = 0; // ตัวแปรเพื่อเก็บราคารวมทั้งหมด
                foreach($_SESSION['cart'] as $index => $item) {
                    if(isset($item['mn_id'])) {
                        // ดึงข้อมูลของเมนูจากฐานข้อมูล
                        $mn_id = $item['mn_id'];
                        $amount = $item['amount'];
                        $sql_menu = "SELECT * FROM menu WHERE mn_id = '$mn_id'";
                        $result_menu = mysqli_query($conn, $sql_menu);
                        $row_menu = mysqli_fetch_assoc($result_menu);
                        
                        // คำนวณราคารวมของแต่ละรายการ
                        $itemTotal = $row_menu['price'] * $amount;
                        $totalPrice += $itemTotal; // เพิ่มราคารวมลงในตัวแปรทั้งหมด
                        ?>
                        <tr>
                            <td><?= $row_menu['mn_name'] ?></td>
                            <td><?= $amount ?></td>
                            <td><?= number_format($row_menu['price'], 2) ?></td>
                            <td><?= number_format($itemTotal, 2) ?></td>
                            <td><a href="cart.php?delete_index=<?php echo $index; ?>" onclick="return confirm('คุณต้องการลบรายการนี้ใช่หรือไม่?');">ลบ</a>
</td>
                        </tr>
                        <?php
                    } elseif(isset($item['in_id'])) {
                        // ดึงข้อมูลของวัตถุดิบจากฐานข้อมูล
                        $in_id = $item['in_id'];
                        $amount = $item['amount'];
                        $sql_ingre = "SELECT * FROM ingredients WHERE in_id = '$in_id'";
                        $result_ingre = mysqli_query($conn, $sql_ingre);
                        $row_ingre = mysqli_fetch_assoc($result_ingre);
                        
                        // คำนวณราคารวมของแต่ละรายการ
                        $itemTotal = $row_ingre['in_price'] * $amount;
                        $totalPrice += $itemTotal; 
                        ?>
                        <tr>
                            <td><?= $row_ingre['in_name'] ?></td>
                            <td><?= $amount ?></td>
                            <td><?= number_format($row_ingre['in_price'], 2) ?></td>
                            <td><?= number_format($itemTotal, 2) ?></td>
                            <td><a href="cart.php?delete_index=<?php echo $index; ?>" onclick="return confirm('คุณต้องการลบรายการนี้ใช่หรือไม่?');">ลบ</a>
                        </tr>
                        <?php
                    }
                }
                ?>
                <tr>
                    <td colspan="3" style="text-align: right;">รวมทั้งหมด</td>
                    <td><?= number_format($totalPrice, 2) ?></td>
                    <td></td>
                </tr>
            </table><br><br>
         
            <form method="post" action="bookingmenu.php">
    <div class="right-corner">
        <label for="receive">เลือกวันที่รับเมนู:</label>
        <input type="date" id="receive" name="receive" min="<?php echo $check_in; ?>" max="<?php echo $check_out; ?>" required>
        <input type="hidden" name="rm_id" id="rm_id" value="<?= $rm_id ?>">
        <input type="hidden" name="cus_name" id="cus_name" value="<?= $cus_name ?>">
        <?php foreach($_SESSION['cart'] as $item): ?>
            <?php if(isset($item['mn_id'])): ?>
                <input type="hidden" name="mn_id[]" value="<?= $item['mn_id'] ?>">
            <?php elseif(isset($item['in_id'])): ?>
                <input type="hidden" name="in_id[]" value="<?= $item['in_id'] ?>">
            <?php endif; ?>
            <input type="hidden" name="amount[]" value="<?= $item['amount'] ?>">
        <?php endforeach; ?>
        <input type="hidden" name="totalPrice" value="<?= $totalPrice ?>">
        <button type="submit">จองอาหาร</button>
    </div>
</form>
            <?php
        } else {
            echo "<p style='text-align:center;'>ไม่มีรายการในตะกร้า</p>";
        }
        ?>
    </div>

</body>
</html>
