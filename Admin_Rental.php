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
      padding-top: 10%;
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
        $sql = "SELECT *
                FROM product
                INNER JOIN tenant ON product.Tenant_ID = tenant.Tenant_ID
                INNER JOIN rental ON tenant.Tenant_ID = rental.Tenant_ID
                INNER JOIN warehouse ON rental.Rental_ID = warehouse.Rental_ID
                INNER JOIN admin ON warehouse.Warehouse_ID = admin.Warehouse_ID
                WHERE Admin_ID = ?
";

        $stmt = $conn->prepare($sql); // เตรียมคำสั่ง SQL เพื่อป้องกัน SQL Injection
        $stmt->bind_param("i", $_SESSION['Admin_ID']); // ผูกค่าพารามิเตอร์
        $stmt->execute(); // รันคำสั่ง
        $result = $stmt->get_result(); // รับผลลัพธ์จากฐานข้อมูล

        while ($row = $result->fetch_assoc()) {
            $Product_ID = $row['Product_ID'];     //ตัวเชื่อม Tenant
            $Product_Name = $row['Product_Name'];
            $Stock = $row['Stock'];
            $Description = $row['Description'];
  
            $Tenant_ID = $row['Tenant_ID'];       //ตัวเชื่อม Rental
            $Tenant_Name = $row['Tenant_Name'];
            $Tenant_Age = $row['Tenant_Age'];
            $Tenant_Tel = $row['Tenant_Tel'];
            $Tenant_Address = $row['Tenant_Address'];
            $Tanant_Email = $row['Tanant_Email'];
  
            $Rental_ID = $row['Rental_ID'];
            $Rental_Name = $row['Rental_Name'];
            $Rental_Start = $row['Rental_Start'];
            $Rental_End = $row['Rental_End'];
            $Rental_Price = $row['Rental_Price'];
            $RentanPayment_Date = $row['RentanPayment_Date'];
            $Rental_Description = $row['Rental_Description'];
            $Rental_Warn = $row['Rental_Warn'];
            $Late_Fees = $row['Late_Fees'];
            $Date_Closing_Warehouse = $row['Date_Closing_Warehouse'];
            $Rental_Status = $row['Rental_Status'];
            $Tenant_ID = $row['Tenant_ID'];
  
            $Warehouse_Name = $row['Warehouse_Name'];
        ?>
          <div class="col-md-12" style="padding: 10px;">
            <div class="card card-light card-round">

              <div class="card-body">
                <div class="row">

                  <div class="col-md-4 col-lg-4">
                    <img src="assets/img/chadengle.jpg" style="height:100%;">
                  </div>
                  <div class="col-md-6 col-lg-6">
                    <a>ผู้ส่งความสนใจเช่า : <?php echo $Interested_Name; ?> (รหัส : <?php echo $Interested_ID; ?>)</a> <br>
                    <a>อีเมล : <?php echo $Interested_Email; ?></a> <br>
                    <a>เบอร์โทร : <?php echo $Interested_Tel; ?></a> <br>
                    <a>วันที่ส่งความสนใจ : <?php echo $DT_record; ?></a> <br>
                    <br><br>
                    <a>รหัสโกดัง : <?php echo $Warehouse_ID; ?></a> <br>
                    <a>ชื่อโกดัง : <?php echo $Warehouse_Name; ?></a> <br>
                    <a>ขนาดโกดัง : <?php echo $Warehouse_Size; ?></a> <br>
                    <a>คำอธิบาย : <?php echo $Warehouse_Description; ?></a> <br>
                    <a>ที่ตั้งโกดัง : <?php echo $Warehouse_Address; ?></a> <br>
                    <a>สัญญาเช่าโกดัง : <?php echo $Rental_Name; ?></a> <br>
                  </div>
                  <div class="col-md-2 col-lg-2">
                    <div class="row card card-stats card-warning card-round">
                      <a> สถานะ : <?php echo $Interested_status; ?> </a>
                    </div>

                    <div class="row card card-info">
                      <form action="#" method="POST">
                        <input type="hidden" name="Interested_ID" value=<?php echo $Interested_ID; ?>>
                        <p>เปลี่ยนสถานะ</p>
                        <select class="form-select" name="Interested_status" id="Interested_status" aria-label="Floating label select example" required>
                            <option value="รอดำเนินการ">รอดำเนินการ</option>
                            <option value="เลิกความสนใจ">เลิกความสนใจ</option>
                            <option value="นัดเจรจาแล้ว">นัดเจรจาแล้ว</option>
                            <option value="เป็นผู้เช่าแล้ว">เป็นผู้เช่าแล้ว</option>
                        </select>

                        <button type="submit" class="btn btn-success col-md-12 ms-auto me-auto btn-xs" style="margin: 2px;">บันทึก</button>

                      </form>

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

  <script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("btn-close")[0];

    // When the user clicks on the button, open the modal
    btn.onclick = function() {
      modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
      modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
  </script>

</body>

</html>