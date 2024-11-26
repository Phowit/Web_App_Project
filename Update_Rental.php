<!--zone_update.php-->
<?php
    // เชื่อมต่อกับฐานข้อมูล
    require_once("connect_db.php");

    // รับข้อมูลจากฟอร์ม
    $Rental_ID = $_POST['Rental_ID'];

    $Rental_Name = $_POST['Rental_Name'];
    $Rental_Start = $_POST['Rental_Start'];
    $Rental_End = $_POST['Rental_End'];
    $Rental_Price = $_POST['Rental_Price'];
    $RentanPayment_Date = $_POST['RentanPayment_Date'];
    $Rental_Description = $_POST['Rental_Description'];
    $Rental_Warn = $_POST['Rental_Warn'];
    $Late_Fees = $_POST['Late_Fees'];
    $Date_Closing_Warehouse = $_POST['Date_Closing_Warehouse'];
    $Rental_Status = $_POST['Rental_Status'];

    // เขียนคำสั่ง SQL สำหรับลบข้อมูลสมาชิก
    $sqli = "   UPDATE rental 
                SET Rental_Name = '$Rental_Name',
                    Rental_Start = '$Rental_Start',
                    Rental_End = '$Rental_End',
                    Rental_Price = '$Rental_Price',
                    RentanPayment_Date = '$RentanPayment_Date',
                    Rental_Description = '$Rental_Description',
                    Rental_Warn = '$Rental_Warn',
                    Late_Fees = '$Late_Fees',
                    Date_Closing_Warehouse = '$Date_Closing_Warehouse',
                    Rental_Status = '$Rental_Status'
                WHERE Rental_ID = '$Rental_ID'
                ";
        // ทำการลบข้อมูล
    mysqli_query($conn,$sqli);
    echo"SQL = ".$sqli;
?>

<meta http-equiv="refresh" content = "0; url = Admin_Rental.php">