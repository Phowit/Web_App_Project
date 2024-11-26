<nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
    <div class="container-fluid">
        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
            <li class="nav-item topbar-user dropdown hidden-caret">
                <a
                    class="dropdown-toggle profile-pic"
                    data-bs-toggle="dropdown"
                    href="#"
                    aria-expanded="false">
                    <div class="avatar-sm">
                        <img
                            src="assets/img/profile.jpg"
                            alt="..."
                            class="avatar-img rounded-circle" />
                    </div>
                    <span class="profile-username">
                        <span class="op-7">Hi,</span>
                        <span class="fw-bold">Hizrian</span>
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <div class="dropdown-user-scroll scrollbar-outer">
                        <li>
                        <?php
                            require_once("connect_db.php");
                            $sql = "SELECT * FROM admin WHERE `Admin_ID` = ?";

                            $stmt = $conn->prepare($sql); // เตรียมคำสั่ง SQL เพื่อป้องกัน SQL Injection
                            $stmt->bind_param("i", $_SESSION['Admin_ID']); // ผูกค่าพารามิเตอร์
                            $stmt->execute(); // รันคำสั่ง
                            $result = $stmt->get_result(); // รับผลลัพธ์จากฐานข้อมูล

                            while ($row = $result->fetch_assoc()) {
                                $Admin_ID = $row['Admin_ID'];
                                $Admin_Name = $row['Admin_Name'];
                                $Admin_Tel = $row['Admin_Tel'];
                                $Admin_Address = $row['Admin_Address'];
                                $Admin_Image = $row['Admin_Image'];
                                $Warehouse_ID = $row['Warehouse_ID'];
                        ?>
                            <div class="user-box">
                                <div class="avatar-lg">
                                    <img
                                        src="assets/img/profile.jpg"
                                        alt="image profile"
                                        class="avatar-img rounded" />
                                </div>
                                <div class="u-text">
                                    <h4><?php echo $Admin_Name; ?></h4>
                                    <p class="text-muted">
                                        เบอร์โทรศัพท์ : <?php echo $Admin_Tel; ?> <br>
                                        ที่อยู่ : <?php echo $Admin_Address; ?>
                                    </p>
                                </div>
                            </div>
                            <?php } ?>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="Admin_Logout.php">Logout</a>

                        </li>
                    </div>
                </ul>
            </li>
        </ul>
    </div>
</nav>

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