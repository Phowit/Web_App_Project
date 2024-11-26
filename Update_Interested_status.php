<!--zone_update.php-->
<?php
    // เชื่อมต่อกับฐานข้อมูล
    require_once("connect_db.php");

    // รับข้อมูลจากฟอร์ม
    $Interested_ID = $_POST['Interested_ID'];
    $Interested_status = $_POST['Interested_status'];

        // เขียนคำสั่ง SQL สำหรับลบข้อมูลสมาชิก
        $sqli = "UPDATE Interested 
                SET Interested_status = '$Interested_status'
                WHERE Interested_ID = '$Interested_ID'
                ";
        // ทำการลบข้อมูล
        mysqli_query($conn,$sqli);
        echo"SQL = ".$sqli;
?>

<meta http-equiv="refresh" content = "0; url = Admin_Interested.php">