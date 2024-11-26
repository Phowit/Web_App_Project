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
            padding-top: 7%;
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
        <?php require_once("Admin_Sidebar3.php"); ?>
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

                if ($result->num_rows > 0) {
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
                        $Warehouse_Size = $row['Warehouse_Size'];
                        $Warehouse_Address = $row['Warehouse_Address'];
                ?>
                        <div class="col-md-12" style="padding: 10px;">
                            <div class="card card-light card-round">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-5 col-lg-5">
                                            <h5>สัญญาเช่า : <?php echo $Rental_Name; ?> (รหัส : <?php echo $Rental_ID; ?>)</h5>
                                            <a>วันที่เริ่มเช่า : <?php echo $Rental_Start; ?></a> <br>
                                            <a>วันที่สิ้นสุด : <?php echo $Rental_End; ?></a> <br>
                                            <a>ราคาเช่า : <?php echo $Rental_Price; ?></a> <br>
                                            <a>วันที่จ่าย : <?php echo $RentanPayment_Date; ?></a> <br>
                                            <a>คำอธิบาย : <?php echo $Rental_Description; ?></a> <br>
                                            <a>แจ้งเตือนหมดสัญญา : <?php echo $Rental_Warn; ?></a> <br>
                                            <a>ค่าปรับ : <?php echo $Late_Fees; ?></a> <br>
                                            <a>วันปิดโกดัง : <?php echo $Date_Closing_Warehouse; ?></a> <br>
                                            <a>สถานะการเช่า : <?php echo $Rental_Status; ?></a> <br>
                                        </div>

                                        <div class="col-md-5 col-lg-5">
                                            <h5>ข้อมูลผู้เช่า</h5>
                                            <a>ชื่อ : <?php echo $Tenant_Name; ?> (รหัส : <?php echo $Tenant_ID; ?>)</a> <br>
                                            <a>อายุ : <?php echo $Tenant_Age; ?></a> <br>
                                            <a>เบอร์โทร : <?php echo $Tenant_Tel; ?></a> <br>
                                            <a>ที่อยู่ : <?php echo $Tenant_Address; ?></a> <br>
                                            <a>อีเมล : <?php echo $Tanant_Email; ?></a> <br>
                                            <br>
                                            <a>ชื่อโกดัง : <?php echo $Warehouse_Name; ?></a> <br>
                                            <a>ขนาด : <?php echo $Warehouse_Size; ?></a> <br>
                                            <a>ที่อยู่ : <?php echo $Warehouse_Address; ?></a> <br>
                                        </div>

                                        <div class="col-md-2 col-lg-2">
                                            <button data-modal="modal1"
                                                class="btn btn open-modal-btn btn-warning me-auto ms-auto"
                                                style="width: 100%;">
                                                แก้ไข<br>(การเช่า)
                                            </button>

                                            <div id="modal1" class="modal">
                                                <!-- Modal content -->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <span class="close-btn">&times;</span>
                                                        <h2>แก้ไขข้อมูลการเช่า</h2>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="Update_Rental.php" method="POST">
                                                            <input type="hidden" name="Rental_ID" value=<?php echo $Rental_ID; ?>>

                                                            <label for="Rental_Name">ชื่อสัญญา</label>
                                                            <input type="text" class="form-control" name="Rental_Name" placeholder="<?php echo $Rental_Name; ?>" required />

                                                            <label for="Rental_Start">วันที่เริ่มเช่า</label>
                                                            <input type="datetime-local" class="form-control" name="Rental_Start" placeholder="<?php echo $Rental_Start; ?>" required />

                                                            <label for="Rental_End">วันที่สิ้นสุด</label>
                                                            <input type="datetime-local" class="form-control" name="Rental_End" placeholder="<?php echo $Rental_End; ?>" required />

                                                            <label for="Rental_Price">ราคาเช่า</label>
                                                            <input type="text" class="form-control" name="Rental_Price" placeholder="<?php echo $Rental_Price; ?>" required />

                                                            <label for="RentanPayment_Date">วันที่จ่าย</label>
                                                            <input type="datetime-local" class="form-control" name="RentanPayment_Date" placeholder="<?php echo $RentanPayment_Date; ?>" required />

                                                            <label for="Rental_Description">คำอธิบาย</label>
                                                            <input type="text" class="form-control" name="Rental_Description" placeholder="<?php echo $Rental_Description; ?>" required />

                                                            <label for="Rental_Warn">แจ้งเตือนหมดสัญญา</label>
                                                            <input type="datetime-local" class="form-control" name="Rental_Warn" placeholder="<?php echo $Rental_Warn; ?>" required />

                                                            <label for="Late_Fees">ค่าปรับ</label>
                                                            <input type="text" class="form-control" name="Late_Fees" placeholder="<?php echo $Late_Fees; ?>" required />

                                                            <label for="Rental_Status">สถานะการเช่า</label>
                                                            <input type="text" class="form-control" name="Rental_Status" placeholder="<?php echo $Rental_Status; ?>" required />

                                                            <label for="Date_Closing_Warehouse">วันปิดโกดัง</label>
                                                            <input type="datetime-local" class="form-control" name="Date_Closing_Warehouse" placeholder="<?php echo $Date_Closing_Warehouse; ?>" required />
                                                            <br>
                                                            <div style="padding-left: 45%;">
                                                                <button type="submit" class="btn btn-success">บันทึก</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <br> <br>
                                            <button class="btn btn open-modal-btn btn-warning me-auto ms-auto"
                                                data-modal="modal2" style="width: 100%;">
                                                แก้ไข<br>(ผู้เช่า)
                                            </button>

                                            <div id="modal2" class="modal">
                                                <!-- Modal content -->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <span class="close-btn">&times;</span>
                                                        <h2>แก้ไขข้อมูลผู้เช่า</h2>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="Update_Tenant.php" method="POST">
                                                            <input type="hidden" name="Tenant_ID" value=<?php echo $Tenant_ID; ?>>

                                                            <label for="Tenant_Name">ชื่อผู้เช่า</label>
                                                            <input type="text" class="form-control" name="Tenant_Name" placeholder="<?php echo $Tenant_Name; ?>" required />

                                                            <label for="Tenant_Age">อายุผู้เช่า</label>
                                                            <input type="text" class="form-control" name="Tenant_Age" placeholder="<?php echo $Tenant_Age; ?>" required />

                                                            <label for="Tenant_Tel">เบอร์โทรผู้เช่า</label>
                                                            <input type="text" class="form-control" name="Tenant_Tel" placeholder="<?php echo $Tenant_Tel; ?>" required />

                                                            <label for="Tenant_Address">ที่อยู่ผู้เช่า</label>
                                                            <input type="text" class="form-control" name="Tenant_Address" placeholder="<?php echo $Tenant_Address; ?>" required />

                                                            <label for="Tanant_Email">อีเมลผู้เช่า</label>
                                                            <input type="text" class="form-control" name="Tanant_Email" placeholder="<?php echo $Tanant_Email; ?>" required />
                                                            <br>
                                                            <div style="padding-left: 45%;">
                                                                <button type="submit" class="btn btn-success">บันทึก</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <br> <br>
                                            <button class="btn btn open-modal-btn btn-danger me-auto ms-auto"
                                                    data-modal="modal3" style="width: 100%;"
                                                    onclick="RentalID(<?= $Rental_ID; ?>)">
                                                ลบ
                                            </button>

                                            <div id="modal3" class="modal">
                                                <!-- Modal content -->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <span class="close-btn">&times;</span>
                                                        <h2>ลบสัญญาเช่า</h2>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="" method="POST">
                                                            <input type="hidden" name="Rental_ID" value=<?php echo $Rental_ID; ?>>

                                                            <a>ต้องการลบสัญญาเช่าหรือไม่?</a>
                                                            <br>
                                                            <div style="padding-left: 45%;">
                                                                <button type="button" class="btn btn-danger" onclick="deleteRental()">ยืนยัน</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <div class="table-responsive">
                                        <table class="table text-start align-middle table-bordered table-hover mb-0 table-head-bg-info table-bordered-bd-info">
                                            <thead>
                                                <tr class="text-dark">
                                                    <th scope="col" class="col-1">รหัส</th>
                                                    <th scope="col" class="col-2">ชื่อสินค้า</th>
                                                    <th scope="col" class="col-2">จำนวนในคลัง</th>
                                                    <th scope="col" class="col-7">คำอธิบาย</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><?php echo $Product_ID; ?></td>
                                                    <td><?php echo $Product_Name; ?></td>
                                                    <td><?php echo $Stock; ?></td>
                                                    <td><?php echo $Description; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }
                } else { ?>
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#addRecordModal">เพิ่มข้อมูล</button>
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
        // ดึงปุ่มทั้งหมดที่มี class "open-modal-btn"
        const openModalButtons = document.querySelectorAll('.open-modal-btn');
        // ดึงปุ่มปิดทั้งหมดที่มี class "close-btn"
        const closeButtons = document.querySelectorAll('.close-btn');

        // ดึง Modal ทุกตัว
        const modals = document.querySelectorAll('.modal');

        // ฟังก์ชันเปิด Modal
        openModalButtons.forEach(button => {
        button.addEventListener('click', () => {
            const modalId = button.getAttribute('data-modal'); // ดึงค่า id จาก data-modal
            const modal = document.getElementById(modalId); // ค้นหา Modal ด้วย id
            modal.style.display = 'block'; // เปิด Modal
        });
        });

        // ฟังก์ชันปิด Modal
        closeButtons.forEach(button => {
        button.addEventListener('click', () => {
            const modal = button.closest('.modal'); // ค้นหา Modal ที่ใกล้ที่สุด
            modal.style.display = 'none'; // ปิด Modal
        });
        });

        // ปิด Modal เมื่อคลิกนอกพื้นที่
        window.addEventListener('click', event => {
        modals.forEach(modal => {
            if (event.target === modal) { // ตรวจสอบว่าคลิกนอกพื้นที่เนื้อหา Modal
            modal.style.display = 'none'; // ปิด Modal
            }
        });
        });
    </script>

    <script>
        var RentalID;

        // ฟังก์ชันเพื่อรับค่า member_ID เมื่อคลิกที่ปุ่ม "ลบ"
        function RentalID(Rental_ID) {
            RentalID = Rental_ID;
        }

        function deleteRental() {

            // ถ้ายืนยันการลบ ทำการ redirect ไปยังไฟล์ planting_delete.php พร้อมส่งค่า id ของแถวที่ต้องการลบ
            window.location.href = "Delete_Rental.php?id=" + RentalID;

        }
    </script>
</body>

</html>