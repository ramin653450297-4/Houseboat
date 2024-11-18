<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking action</title>
</head>
<body>
<?php 
    require 'server.php';
    session_start();

    if(isset($_GET['check_in']) && isset($_GET['check_out']) && isset($_GET['amount']) && isset($_GET['rm_id'])) {
        $check_in = $_GET['check_in'];
        $check_out = $_GET['check_out'];
        $amount = $_GET['amount'];
        $rm_id = $_GET['rm_id'];
        $am_name = $_GET['am_name'];
        $am_email = $_GET['am_email'];
        $am_tel = $_GET['am_tel'];
        $add_bed = isset($_GET['add_bed']) ? 1 : 0;

        $stmt = $conn->prepare("INSERT INTO anonybooking (rm_id, check_in, check_out, amount, am_name, am_email, am_tel, add_bed) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssi", $rm_id, $check_in, $check_out, $amount, $am_name, $am_email, $am_tel, $add_bed);

        if ($stmt->execute() === TRUE) {
            $_SESSION['am_name'] = $am_name;

            header('Location: payment.php?am_name=' . urlencode($am_name));
            exit();
        } else {
            echo "เกิดข้อผิดพลาด " . $conn->error;
        }

        $stmt->close();
        $conn->close();
    }
?>

</body> 
</html>
