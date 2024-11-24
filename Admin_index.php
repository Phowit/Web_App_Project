<?php
require_once("connect_db.php");
session_start();

// ตรวจสอบว่าผู้ใช้เข้าสู่ระบบหรือไม่
if (!isset($_SESSION['Admin_ID'])) {
  header("Location: Admin_Login.php"); // หากยังไม่ได้ล็อกอิน ย้ายไปหน้า signin.php
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Warehouse JIRAPRON</title>
  <meta
    content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
    name="viewport" />
  <link
    rel="icon"
    href="assets/img/Jirapron2.png"
    type="image/x-icon" />

  <!-- Fonts and icons -->
  <script src="assets/js/plugin/webfont/webfont.min.js"></script>
  <script>
    WebFont.load({
      google: {
        families: ["Public Sans:300,400,500,600,700"]
      },
      custom: {
        families: [
          "Font Awesome 5 Solid",
          "Font Awesome 5 Regular",
          "Font Awesome 5 Brands",
          "simple-line-icons",
        ],
        urls: ["assets/css/fonts.min.css"],
      },
      active: function() {
        sessionStorage.fonts = true;
      },
    });
  </script>

  <!-- CSS Files -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/css/plugins.min.css" />
  <link rel="stylesheet" href="assets/css/kaiadmin.min.css" />

  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link rel="stylesheet" href="assets/css/demo.css" />
</head>

<body>

  <div class="wrapper">

    <!-- Sidebar -->
    <?php require_once("Admin_Sidebar1.php"); ?>
    <!-- End Sidebar -->

    <div class="main-panel">
      <div class="main-header">
        <!-- Navbar Header -->
        <?php require_once("Admin_Nav.php"); ?>
        <!-- End Navbar -->
      </div>

      <div class="container">
        <div class="page-inner">
          <div class="row">
            <div class="col-md-12">
              <h3 class="fw-bold mb-3">ข้อมูลโกดัง ที่รับผิดชอบ </h3>
            </div>
          </div>
          <div class="row">
            <?php
            require_once("connect_db.php");
            $sql = "SELECT * FROM admin
                    INNER JOIN warehouse ON admin.Warehouse_ID = warehouse.Warehouse_ID
                    WHERE `Admin_ID` = ?";
                    
            $stmt = $conn->prepare($sql); // เตรียมคำสั่ง SQL เพื่อป้องกัน SQL Injection
            $stmt->bind_param("i", $_SESSION['Admin_ID']); // ผูกค่าพารามิเตอร์
            $stmt->execute(); // รันคำสั่ง
            $result = $stmt->get_result(); // รับผลลัพธ์จากฐานข้อมูล

            while ($row = $result->fetch_assoc()) {
              $Admin_ID = $row['Admin_ID'];
              $Admin_Name = $row['Admin_Name'];
              $Admin_Address = $row['Admin_Address'];
              $Admin_Tel = $row['Admin_Tel'];

              $Warehouse_ID = $row['Warehouse_ID'];
              $Warehouse_Name = $row['Warehouse_Name'];
              $Warehouse_Size = $row['Warehouse_Size'];
              $Warehouse_Description = $row['Warehouse_Description'];
              $Warehouse_Address = $row['Warehouse_Address'];
              $Warehouse_Image   = $row['Warehouse_Image'];
            ?>
              <div class="col-md-12">
                <div class="card card-light card-round">

                  <div class="card-header">
                    <div class="card-head-row">
                      <div class="col-md-11 col-lg-11">
                        <div class="card-title"><?php echo $row['Warehouse_Name']; ?></div>
                      </div>

                      <div class="col-md-1 col-lg-1">
                        <a>รหัสโกดัง : <?php echo $row['Warehouse_ID']; ?></a>
                      </div>
                    </div>
                    <div class="row">
                      <div class="card-category"><?php echo $row['Warehouse_Size']; ?></div>
                    </div>
                  </div>

                  <div class="card-body">

                    <div class="row">
                      <div class="col-md-4 col-lg-4">
                        <img src="assets/img/chadengle.jpg" style="height:100%;">
                      </div>

                      <div class="col-md-8 col-lg-8">
                        <a><?php echo $row['Warehouse_Description']; ?></a> <br>
                        <a><?php echo $row['Warehouse_Address']; ?></a> <br> <br>

                        <a>ผู้ดูแลโกดังรหัส : <?php echo $row['Admin_ID']; ?></a> <br>
                        <a>ชื่อผู้ดูแลโกดัง : <?php echo $row['Admin_Name']; ?></a> <br>
                        <a>ที่อยู่ติดต่อ : <?php echo $row['Admin_Address']; ?></a> <br>
                        <a>เบอร์โทร : <?php echo $row['Admin_Tel']; ?></a>
                      </div>

                    </div>
                  </div>

                </div>
              </div>
            <?php } ?>
          </div>

          <div class="row">
            <div class="col-md-4">

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery-3.7.1.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>

  <!-- jQuery Scrollbar -->
  <script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

  <!-- Chart JS -->
  <script src="assets/js/plugin/chart.js/chart.min.js"></script>

  <!-- jQuery Sparkline -->
  <script src="assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

  <!-- Chart Circle -->
  <script src="assets/js/plugin/chart-circle/circles.min.js"></script>

  <!-- Datatables -->
  <script src="assets/js/plugin/datatables/datatables.min.js"></script>

  <!-- Bootstrap Notify -->
  <script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

  <!-- jQuery Vector Maps -->
  <script src="assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
  <script src="assets/js/plugin/jsvectormap/world.js"></script>

  <!-- Sweet Alert -->
  <script src="assets/js/plugin/sweetalert/sweetalert.min.js"></script>

  <!-- Kaiadmin JS -->
  <script src="assets/js/kaiadmin.min.js"></script>

  <!-- Kaiadmin DEMO methods, don't include it in your project! -->
  <script src="assets/js/setting-demo.js"></script>
  <script src="assets/js/demo.js"></script>
  <script>
    $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
      type: "line",
      height: "70",
      width: "100%",
      lineWidth: "2",
      lineColor: "#177dff",
      fillColor: "rgba(23, 125, 255, 0.14)",
    });

    $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
      type: "line",
      height: "70",
      width: "100%",
      lineWidth: "2",
      lineColor: "#f3545d",
      fillColor: "rgba(243, 84, 93, .14)",
    });

    $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
      type: "line",
      height: "70",
      width: "100%",
      lineWidth: "2",
      lineColor: "#ffa534",
      fillColor: "rgba(255, 165, 52, .14)",
    });
  </script>
</body>

</html>