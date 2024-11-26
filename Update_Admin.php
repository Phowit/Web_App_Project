<!--zone_update.php-->
<?php
    // เชื่อมต่อกับฐานข้อมูล
    require_once("connect_db.php");

    // รับข้อมูลจากฟอร์ม
    $Admin_ID = $_POST['Admin_ID'];
    $Admin_Name = $_POST['Admin_Name'];
    $Admin_Password = $_POST['Admin_Password'];
    $Admin_Tel = $_POST['Admin_Tel'];
    $Admin_Address = $_POST['Admin_Address'];
    //$Admin_Image = $_POST['Admin_Image'];

        // เขียนคำสั่ง SQL สำหรับลบข้อมูลสมาชิก
        $sqli = "UPDATE admin 
                SET Admin_Name = '$Admin_Name',
                    Admin_Password = '$Admin_Password',
                    Admin_Tel = '$Admin_Tel',
                    Admin_Address = '$Admin_Address'
                WHERE Admin_ID = '$Admin_ID'
                ";
        // ทำการลบข้อมูล
        mysqli_query($conn,$sqli);
        echo"SQL = ".$sqli;
?>

<meta http-equiv="refresh" content = "0; url = Admin_index.php">