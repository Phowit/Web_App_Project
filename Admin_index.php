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
      padding-top: 6%;
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
              <div class="col-md-6">
                <div class="card card-light card-round">

                  <div class="card-header">
                    <div class="card-head-row">
                      <div class="col-md-10 col-lg-10">
                        <div class="card-title">ข้อมูลโกดัง<?php echo $row['Warehouse_Name']; ?></div>
                      </div>

                      <div class="col-md-2 col-lg-2">
                        <a>รหัสโกดัง: <?php echo $Warehouse_ID; ?></a>
                      </div>
                    </div>
                  </div>

                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-2 col-lg-2">
                        <img src="assets/img/chadengle.jpg">
                      </div>
                      <div class="col-md-2 col-lg-2"></div>
                      <div class="col-md-8 col-lg-8">
                        <a><?php echo $Warehouse_Name; ?></a><br>
                        <a> ขนาด <?php echo $Warehouse_Size; ?></a> <br>
                        <a><?php echo $Warehouse_Description; ?></a> <br>
                        <a><?php echo $Warehouse_Address; ?></a>
                      </div>
                    </div>
                  </div>

                  <div class="card-footer">

                    <div class="row">
                      <button class="btn btn-warning col-md-4 me-auto ms-auto" 
                              id="OpenModelEditWarehouse"
                              data-bs-target="#editRecordModal">
                              แก้ไข</button>
                    </div>

                    <div id="myModal1" class="modal">
                      <!-- Modal content -->
                      <div class="modal-content">
                        <div class="modal-header">
                          <span class="close">&times;</span>
                          <h2>แก้ไขข้อมูลโกดัง</h2>
                        </div>
                        <div class="modal-body">
                          <form action="Update_Warehouse.php" method="POST">
                            <input type="hidden" name="Warehouse_ID" value=<?php echo $Warehouse_ID; ?>>

                            <label for="Warehouse_Name">ชื่อโกดัง</label>
                            <input type="text" class="form-control" name="Warehouse_Name" placeholder="<?php echo $Warehouse_Name; ?>" required/>

                            <label for="Warehouse_Size">ขนาดโกดัง</label>
                            <input type="text" class="form-control" name="Warehouse_Size" placeholder="<?php echo $Warehouse_Size; ?>" required/>

                            <label for="Warehouse_Description">คำอธิบาย</label>
                            <input type="text" class="form-control" name="Warehouse_Description" placeholder="<?php echo $Warehouse_Description; ?>" required/>

                            <label for="Warehouse_Address">ที่อยู่โกดัง</label>
                            <input type="text" class="form-control" name="Warehouse_Address" placeholder="<?php echo $Warehouse_Address; ?>" required/>
                            <br>
                            <div style="padding-left: 45%;">
                              <button type="submit" class="btn btn-success">บันทึก</button>
                            </div>

                          </form>
                        </div>
                      </div>

                    </div>

                  </div>
                </div>

              </div>

              <div class="col-md-6">
                <div class="card card-light card-round">

                  <div class="card-header">
                    <div class="card-head-row">

                      <div class="col-md-9 col-lg-9">
                        <div class="card-title">ข้อมูลผู้ดูแลโกดัง</div>
                      </div>

                      <div class="col-md-3 col-lg-3">
                        <a>รหัสผู้ดูแล : <?php echo $Admin_ID; ?></a>
                      </div>
                    </div>
                  </div>

                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-2 col-lg-2 col-sm-2">
                        <img src="assets/img/chadengle.jpg">
                      </div>
                      <div class="col-md-2 col-lg-2"></div>
                      <div class="col-md-8 col-lg-8 col-sm-8">
                        <a>ชื่อผู้ดูแลโกดัง : <?php echo $Admin_Name; ?></a> <br>
                        <a>ที่อยู่ติดต่อ : <?php echo $Admin_Address; ?></a> <br> <br>
                        <a>เบอร์โทร : <?php echo $Admin_Tel; ?></a>
                      </div>
                    </div>
                  </div>

                  <div class="card-footer">

                    <div class="row">
                      <button class="btn btn-warning col-md-4 me-auto ms-auto">แก้ไข</button>
                    </div>

                    <div id="myModal2" class="modal">
                      <!-- Modal content -->
                      <div class="modal-content">
                        <div class="modal-header">
                          <span class="close">&times;</span>
                          <h2>แก้ไขข้อมูลโกดัง</h2>
                        </div>
                        <div class="modal-body">
                          <form action="Update_Warehouse.php" method="POST">
                            <input type="hidden" name="Warehouse_ID" value=<?php echo $Warehouse_ID; ?>>

                            <label for="Warehouse_Name">ชื่อโกดัง</label>
                            <input type="text" class="form-control" name="Warehouse_Name" placeholder="<?php echo $Warehouse_Name; ?>" required/>

                            <label for="Warehouse_Size">ขนาดโกดัง</label>
                            <input type="text" class="form-control" name="Warehouse_Size" placeholder="<?php echo $Warehouse_Size; ?>" required/>

                            <label for="Warehouse_Description">คำอธิบาย</label>
                            <input type="text" class="form-control" name="Warehouse_Description" placeholder="<?php echo $Warehouse_Description; ?>" required/>

                            <label for="Warehouse_Address">ที่อยู่โกดัง</label>
                            <input type="text" class="form-control" name="Warehouse_Address" placeholder="<?php echo $Warehouse_Address; ?>" required/>
                            <br>
                            <div style="padding-left: 45%;">
                              <button type="submit" class="btn btn-success">บันทึก</button>
                            </div>

                          </form>
                        </div>
                      </div>

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

  <script>
    // Get the modal
    var modal = document.getElementById("myModal1");

    // Get the button that opens the modal
    var btn = document.getElementById("OpenModelEditWarehouse");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

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

<script>
    // Get the modal
    var modal = document.getElementById("myModal2");

    // Get the button that opens the modal
    var btn = document.getElementById("OpenModelEditWarehouse");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

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