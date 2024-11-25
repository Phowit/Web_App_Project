<!--zone_update.php-->
<?php
    // เชื่อมต่อกับฐานข้อมูล
    require_once("connect_db.php");

    // รับข้อมูลจากฟอร์ม
    $Warehouse_ID = $_POST['Warehouse_ID'];
    $Warehouse_Name = $_POST['Warehouse_Name'];
    $Warehouse_Size = $_POST['Warehouse_Size'];
    $Warehouse_Description = $_POST['Warehouse_Description'];
    $Warehouse_Address = $_POST['Warehouse_Address'];

        // เขียนคำสั่ง SQL สำหรับลบข้อมูลสมาชิก
        $sqli = "UPDATE Warehouse 
                SET Warehouse_Name = '$Warehouse_Name',
                    Warehouse_Size = '$Warehouse_Size',
                    Warehouse_Description = '$Warehouse_Description',
                    Warehouse_Address = '$Warehouse_Address'
                WHERE Warehouse_ID = '$Warehouse_ID'
                ";
        // ทำการลบข้อมูล
        mysqli_query($conn,$sqli);
        echo"SQL = ".$sqli;
?>

<meta http-equiv="refresh" content = "0; url = Admin_index.php">