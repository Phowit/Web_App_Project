<nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
    <div class="container-fluid">
        <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
            <div class="input-group">
                <div class="input-group-prepend">
                    <button type="submit" class="btn btn-search pe-1">
                        <i class="fa fa-search search-icon"></i>
                    </button>
                </div>
                <input type="text" placeholder="Search ..." class="form-control" />
            </div>
        </nav>

        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
            <li class="nav-item topbar-icon dropdown hidden-caret">
                <button class="btn btn-info" id="myBtnOpenModel">
                    <i class="fa fa-envelope"></i> สนใจเช่าโกดัง
                </button>

                <!-- The Modal -->
                <div id="myModal" class="modal">

                    <!-- Modal content -->
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="close">&times;</span>
                            <h2>ลงทะเบียนสนใจเช่าโกดัง</h2>
                        </div>
                        <div class="modal-body">
                            <form action="Insert_Interested.php" method="POST">

                                <label for="Interested_Name">ชื่อผู้สนใจ</label>
                                <input type="text" class="form-control" name="Interested_Name" placeholder="Enter you name" />
                                <br>
                                <label for="Interested_Email">อีเมล</label>
                                <input type="email" class="form-control" name="Interested_Email" placeholder="Enter you Email" />
                                <br>
                                <label for="Interested_Tel">เบอร์โทรศัพท์</label>
                                <input type="tel" class="form-control" name="Interested_Tel" placeholder="Enter you Tel" />
                                <br>
                                <label for="Warehouse_ID">กรุณาเลือกโกดังที่สนใจ</label>
                                <div class="form-floating mb-3">
                                    <?php
                                    require_once("connect_db.php");

                                    $sql = "select Warehouse_ID, Warehouse_Name from Warehouse order by Warehouse_ID";
                                    $result = mysqli_query($conn, $sql);
                                    ?>
                                    <div class="form-floating mb-3">
                                        <select class="form-select" name="Warehouse_ID" id="Warehouse_ID" aria-label="Floating label select example" required>
                                            <?php
                                            while ($row = $result->fetch_assoc()) {
                                            ?>
                                                <option value="<?= $row['Warehouse_ID']; ?>">
                                                    <?= $row['Warehouse_Name']; ?></option>
                                            <?php   } ?>
                                        </select>
                                    </div>
                                </div>

                                <div style="padding-left: 45%;">
                                    <button type="submit" class="btn btn-success" value="Submit">ลงทะเบียน</button>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <p>เจ้าหน้าที่จะติดต่อกลับหลังลงทะเบียนเสร็จสิ้น หรือติดต่อ 080-000-0000</p>
                        </div>
                    </div>

                </div>
            </li>

            <li class="nav-item topbar-user dropdown hidden-caret">
                <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                    <i class="fas fa-user"></i>
                    <span class="profile-username">
                        <span class="op-7">User,</span>
                        <span class="fw-bold">ผู้ใช้ภายนอก</span>
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <div class="dropdown-user-scroll scrollbar-outer">
                        <li>
                            <a class="dropdown-item" href="Admin_Login.php">Admin Login</a>
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
    var btn = document.getElementById("myBtnOpenModel");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal 
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