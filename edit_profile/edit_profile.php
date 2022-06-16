<?php
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['user_master_id'])) {
    include "../master/db_conn.php";

    if ($_SESSION['role'] == 'employee') {
        if ($_SESSION['is_manager'] == 1) {
            //manager
            $page_title = "Manager_edit_profile";
            $Dashboard = "MANAGER";
            $Dashboard_link = "../manager/manager-dashboard.php";
            //$Department = "DEPARTMENT";
            $My_Evaluation = "My Evaluation";
            $MyEvaluation_link = "../evaluation_form/view_manager_task.php";
            //$Department_link = "department/create_dept.php";
            //$All_Employee = "ALL EMPLOYEES";
            $My_Team = "MY TEAM";
            //$AllEmployee_link = "allEmployee.php";
            $MyTeam_link = "../manager/manager_myteam.php";
            $user_icon = "../assets/images/others/user-default.png";
            $edit = "edit_profile.php";
            $Session_name = $_SESSION['name'];
            $name = "$Session_name";
            $logout = "../logout.php";
            include "../master/pre-header.php";
            include "../master/close_header.php";
            include "../master/header.php";
            include "../master/navbar_manager.php";
        } else {
            //employee
            $page_title = "Employee_edit_profile";
            $Dashboard = "Employee";
            $Dashboard_link = "../employee/employee-dashboard.php";
            $My_Evaluation = "My Evaluation";
            $MyEvaluation_link = "../evaluation_form/view_employee_task.php";
            $user_icon = "../assets/images/others/user-default.png";
            $edit = "edit_profile.php";
            $Session_name = $_SESSION['name'];
            $name = "$Session_name";
            $logout = "../logout.php";
            include "../master/pre-header.php";
            include "../master/close_header.php";
            include "../master/header.php";
            include "../master/navbar_employee.php";
        }
    } else {
        //admin        
        $page_title = "edit_Profile_admin";
        $Dashboard = "ADMIN";
        $Department = "DEPARTMENT";
        $Employee = "EMPLOYEE";
        $Dashboard_link = "../admin/admin-dashboard.php";
        $Department_link = "../department/create_dept.php";
        $All_Employee = "ALL EMPLOYEES";
        $My_Team = "MY TEAM";
        $AllEmployee_link = "../admin/allEmployee.php";
        $MyTeam_link = "../admin/admin_myteam.php";
        $Parameter = "PARAMETER";
        $Parameter_link = "../parameter/view_para.php";
        $Evaluation_link = "../evaluation_form/view_admin_task.php";
        $Evaluation =  "Evaluation";
        $user_icon = "../assets/images/others/admin-default.png";
        $edit = "edit_profile.php";
        $Session_name = $_SESSION['name'];
        $name = "$Session_name";
        $Report_link="../report/report.php";
        $logout = "../logout.php";
        include "../master/pre-header.php";
        include "../master/close_header.php";
        include "../master/header.php";
        include "../master/navbar_admin.php";
    }
    include "../master/breadcrumbs.php";
?>
    <?php
    $sql = "SELECT email,password from user_master where user_master_id='$_SESSION[user_master_id]'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $username = $row['email'];
    $password = $row['password'];
    ?>
    <div class="app">
        <div class="container-fluid p-h-0 p-v-20 bg full-height d-flex" style="background-image: url('assets/images/others/login-3.png')">
            <div class="d-flex flex-column justify-content-between w-100">
                <div class="container d-flex h-100">
                    <div class="row align-items-center w-100">
                        <div class="col-md-7 col-lg-5 m-h-auto">
                            <div class="card shadow-lg">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between m-b-30">
                                        <img class="img-fluid" alt="" src="assets/images/logo/logo.png">
                                        <h2 class="m-b-0">Edit Profile</h2>
                                    </div>
                                    <form action="edit_profile_submit.php" method="POST">
                                        <?php if (isset($_GET['error'])) { ?>
                                            <div class="alert alert-danger" role="alert">
                                                <?= $_GET['error'] ?>
                                            </div>
                                        <?php } ?>
                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="username">Username:</label>
                                            <div class="input-affix">
                                                <i class="prefix-icon anticon anticon-user"></i>
                                                <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?php echo $username; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="password">Password:</label>
                                            <!--<a class="float-right font-size-13 text-muted" href="">Forget Password?</a>-->
                                            <div class="input-affix m-b-10">
                                                <i class="prefix-icon anticon anticon-lock"></i>
                                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" maxlength="16" autocomplete="new-password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="password_1">Confirm Password:</label>
                                            <!--<a class="float-right font-size-13 text-muted" href="">Forget Password?</a>-->
                                            <div class="input-affix m-b-10">
                                                <i class="prefix-icon anticon anticon-lock"></i>
                                                <input type="password" class="form-control" id="password_1" name="password_1" placeholder="Password" maxlength="16" autocomplete="new-password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <button class="btn btn-primary" name="submit">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div id="message" style="box-sizing:border-box; padding:25px">
                                    <h3>Password must contain the following:</h3>
                                    <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                                    <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                                    <p id="number" class="invalid">A <b>number</b></p>
                                    <p id="length" class="invalid">Minimum <b>8 characters</b></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var myInput = document.getElementById("password");
        var letter = document.getElementById("letter");
        var capital = document.getElementById("capital");
        var number = document.getElementById("number");
        var length = document.getElementById("length");

        // When the user clicks on the password field, show the message box
        myInput.onfocus = function() {
            document.getElementById("message").style.display = "block";
        }

        // When the user clicks outside of the password field, hide the message box
        myInput.onblur = function() {
            document.getElementById("message").style.display = "none";
        }

        // When the user starts to type something inside the password field
        myInput.onkeyup = function() {
            // Validate lowercase letters
            var lowerCaseLetters = /[a-z]/g;
            if (myInput.value.match(lowerCaseLetters)) {
                letter.classList.remove("invalid");
                letter.classList.add("valid");
            } else {
                letter.classList.remove("valid");
                letter.classList.add("invalid");
            }

            // Validate capital letters
            var upperCaseLetters = /[A-Z]/g;
            if (myInput.value.match(upperCaseLetters)) {
                capital.classList.remove("invalid");
                capital.classList.add("valid");
            } else {
                capital.classList.remove("valid");
                capital.classList.add("invalid");
            }

            // Validate numbers
            var numbers = /[0-9]/g;
            if (myInput.value.match(numbers)) {
                number.classList.remove("invalid");
                number.classList.add("valid");
            } else {
                number.classList.remove("valid");
                number.classList.add("invalid");
            }

            // Validate length
            if (myInput.value.length >= 8) {
                length.classList.remove("invalid");
                length.classList.add("valid");
            } else {
                length.classList.remove("valid");
                length.classList.add("invalid");
            }
        }
    </script>

<script>
        var myInput = document.getElementById("password_1");
        var letter = document.getElementById("letter");
        var capital = document.getElementById("capital");
        var number = document.getElementById("number");
        var length = document.getElementById("length");

        // When the user clicks on the password field, show the message box
        myInput.onfocus = function() {
            document.getElementById("message").style.display = "block";
        }

        // When the user clicks outside of the password field, hide the message box
        myInput.onblur = function() {
            document.getElementById("message").style.display = "none";
        }

        // When the user starts to type something inside the password field
        myInput.onkeyup = function() {
            // Validate lowercase letters
            var lowerCaseLetters = /[a-z]/g;
            if (myInput.value.match(lowerCaseLetters)) {
                letter.classList.remove("invalid");
                letter.classList.add("valid");
            } else {
                letter.classList.remove("valid");
                letter.classList.add("invalid");
            }

            // Validate capital letters
            var upperCaseLetters = /[A-Z]/g;
            if (myInput.value.match(upperCaseLetters)) {
                capital.classList.remove("invalid");
                capital.classList.add("valid");
            } else {
                capital.classList.remove("valid");
                capital.classList.add("invalid");
            }

            // Validate numbers
            var numbers = /[0-9]/g;
            if (myInput.value.match(numbers)) {
                number.classList.remove("invalid");
                number.classList.add("valid");
            } else {
                number.classList.remove("valid");
                number.classList.add("invalid");
            }

            // Validate length
            if (myInput.value.length >= 8) {
                length.classList.remove("invalid");
                length.classList.add("valid");
            } else {
                length.classList.remove("valid");
                length.classList.add("invalid");
            }
        }
    </script>

    

<?php
    include "../master/footer.php";
    include "../master/after-footer.php";
} else {
    header("Location:../login.php");
} ?>