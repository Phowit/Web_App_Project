<?php
    // ตรวจสอบว่ามีการส่งข้อมูลมาจากฟอร์มหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // เชื่อมต่อฐานข้อมูล
    require_once("connect_db.php");

    // รับข้อมูลจากฟอร์ม
    $Interested_Name = $_POST['Interested_Name'];
    $Interested_Email = $_POST['Interested_Email'];
    $Interested_Tel = $_POST['Interested_Tel'];
    $Warehouse_ID = $_POST['Warehouse_ID'];
    $Interested_status = "รอดำเนินการ";

    // เตรียมคำสั่ง SQL
    $sqli = "insert into interested(Interested_Name, Interested_Email, Interested_Tel, Warehouse_ID, Interested_status)";
    $sqli .= "values('$Interested_Name','$Interested_Email','$Interested_Tel','$Warehouse_ID','$Interested_status')";

    mysqli_query($conn,$sqli); 
    echo"SQL = ".$sqli;

    $conn->close();
}

?>
<meta http-equiv="refresh" content = "0; url =User_Interested.php">