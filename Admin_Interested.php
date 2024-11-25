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

  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
    }

    /* The Modal (background) */
    .modal {
      display: none;
      position: fixed;
      z-index: 1;
      padding-top: 3%;
      padding-left: 20%;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgb(0, 0, 0);
      background-color: rgba(0, 0, 0, 0.4);
    }

    /* Modal Content */
    .modal-content {
      position: relative;
      background-color: #fefefe;
      margin: auto;
      padding: 0;
      border: 1px solid #888;
      width: 80%;
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
      -webkit-animation-name: animatetop;
      -webkit-animation-duration: 0.4s;
      animation-name: animatetop;
      animation-duration: 0.4s
    }

    /* Add Animation */
    @-webkit-keyframes animatetop {
      from {
        top: -300px;
        opacity: 0
      }

      to {
        top: 0;
        opacity: 1
      }
    }

    @keyframes animatetop {
      from {
        top: -300px;
        opacity: 0
      }

      to {
        top: 0;
        opacity: 1
      }
    }

    /* The Close Button */
    .close {
      color: white;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }

    .close:hover,
    .close:focus {
      color: #000;
      text-decoration: none;
      cursor: pointer;
    }

    .modal-header {
      padding: 2px 16px;
      background-color: #5cb85c;
      color: white;
    }

    .modal-body {
      padding: 2px 16px;
    }

    .modal-footer {
      padding: 2px 16px;
      background-color: #5cb85c;
      color: white;
    }
  </style>
</head>

<body>
  <div class="wrapper">

    <!-- Sidebar -->
    <?php require_once("Admin_Sidebar2.php"); ?>
    <!-- End Sidebar -->

    <div class="main-panel">
      <div class="main-header">
        <!-- Navbar Header -->
        <?php require_once("Admin_Nav.php"); ?>
        <!-- End Navbar -->
      </div>

      <div class="container">
        <?php
        require_once("connect_db.php");
        $sql = "SELECT * FROM `interested` 
                INNER JOIN warehouse ON interested.Warehouse_ID = warehouse.Warehouse_ID
                INNER JOIN admin ON warehouse.Warehouse_ID = admin.Warehouse_ID
                WHERE Admin_ID = ?";

        $stmt = $conn->prepare($sql); // เตรียมคำสั่ง SQL เพื่อป้องกัน SQL Injection
        $stmt->bind_param("i", $_SESSION['Admin_ID']); // ผูกค่าพารามิเตอร์
        $stmt->execute(); // รันคำสั่ง
        $result = $stmt->get_result(); // รับผลลัพธ์จากฐานข้อมูล

        while ($row = $result->fetch_assoc()) {
          $Interested_ID = $row['Interested_ID'];
          $Interested_Name = $row['Interested_Name'];
          $Interested_Email = $row['Interested_Email'];
          $Interested_Tel = $row['Interested_Tel'];
          $DT_record = date_create_from_format(format: "Y-m-d H:i:s", datetime: $row["DT_record"]) ->format(format: "d/m/Y");
          $Interested_status = $row['Interested_status'];

          $Warehouse_ID = $row['Warehouse_ID']; //ตัวเชื่อม 2 table ระหว่าง interested กับ Warehouse 

          $Warehouse_Name = $row['Warehouse_Name'];
          $Warehouse_Size = $row['Warehouse_Size'];
          $Warehouse_Description = $row['Warehouse_Description'];
          $Warehouse_Address = $row['Warehouse_Address'];
          $Warehouse_Image = $row['Warehouse_Image'];
          $Rental_ID = $row['Rental_ID'];
        ?>
          <div class="col-md-12" style="padding: 10px;">
            <div class="card card-light card-round">

              <div class="card-body">
                <div class="row">

                  <div class="col-md-4 col-lg-4">
                    <img src="assets/img/chadengle.jpg" style="height:100%;">
                  </div>
                  <div class="col-md-6 col-lg-6">
                    <p>ผู้ส่งความสนใจเช่า : <?php echo $Interested_Name; ?></p>
                    <p>วันที่ส่งความสนใจ : <?php echo $DT_record; ?></p>
                    <p>ชื่อโกดัง : <?php echo $Warehouse_Name; ?></p>
                    <p>ขนาดโกดัง : <?php echo $Warehouse_Size; ?></p>
                    <p>คำอธิบาย : <?php echo $Warehouse_Description; ?></p>
                    <p>ที่ตั้งโกดัง : <?php echo $Warehouse_Address; ?></p>
                  </div>
                  <div class="col-md-2 col-lg-2">
                    <div class="row card card-stats card-success card-round">
                        <a>สถานะ</a>
                        <a><?php echo $Interested_status; ?></a>
                    </div>
                  </div>

                </div>
              </div>

            </div>
          </div>
        <?php } ?>
      </div>

      <footer class="footer">
        <div class="container-fluid d-flex justify-content-between">
          <nav class="pull-left">
            <ul class="nav">
              <li class="nav-item">
                <a class="nav-link" href="http://www.themekita.com">
                  ThemeKita
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"> Help </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"> Licenses </a>
              </li>
            </ul>
          </nav>
          <div class="copyright">
            2024, made with <i class="fa fa-heart heart text-danger"></i> by
            <a href="http://www.themekita.com">ThemeKita</a>
          </div>
          <div>
            Distributed by
            <a target="_blank" href="https://themewagon.com/">ThemeWagon</a>.
          </div>
        </div>
      </footer>
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