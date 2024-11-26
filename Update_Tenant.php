<!--zone_update.php-->
<?php
    // เชื่อมต่อกับฐานข้อมูล
    require_once("connect_db.php");

    // รับข้อมูลจากฟอร์ม
    $Tenant_ID = $_POST['Tenant_ID'];

    $Tenant_Name = $_POST['Tenant_Name'];
    $Tenant_Age = $_POST['Tenant_Age'];
    $Tenant_Tel = $_POST['Tenant_Tel'];
    $Tenant_Address = $_POST['Tenant_Address'];
    $Tanant_Email = $_POST['Tanant_Email'];

    // เขียนคำสั่ง SQL สำหรับลบข้อมูลสมาชิก
    $sqli = "   UPDATE tenant 
                SET Tenant_Name = '$Tenant_Name',
                    Tenant_Age = '$Tenant_Age',
                    Tenant_Tel = '$Tenant_Tel',
                    Tenant_Address = '$Tenant_Address',
                    Tanant_Email = '$Tanant_Email'
                WHERE Tenant_ID = '$Tenant_ID'
                ";
        // ทำการลบข้อมูล
    mysqli_query($conn,$sqli);
    echo"SQL = ".$sqli;
?>

<meta http-equiv="refresh" content = "0; url = Admin_Rental.php">