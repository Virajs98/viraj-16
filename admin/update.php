<?php
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['user_master_id'])) {
    include "../master/db_conn.php";
    $page_title = "admin";
    $Dashboard = "ADMIN";
    $Department = "DEPARTMENT";
    $Employee = "EMPLOYEE";
    $Dashboard_link = "admin-dashboard.php";
    $Department_link = "../department/create_dept.php";
    $All_Employee = "ALL EMPLOYEES";
    $My_Team = "MY TEAM";
    $AllEmployee_link = "allEmployee.php";
    $MyTeam_link = "admin_myteam.php";
    $Parameter = "PARAMETER";
    $Parameter_link = "../parameter/view_para.php";
    $Evaluation_link = "../evaluation_form/view_admin_task.php";
    $Evaluation =  "Evaluation";
    $user_icon = "../assets/images/others/admin-default.png";
    $edit = "../edit_profile/edit_profile.php";
    $Session_name = $_SESSION['name'];
    $name = "$Session_name";
    $Report_link="../report/report.php";
    $logout = "../logout.php";
    include "../master/db_conn.php";
    include "../master/pre-header.php";
    include "../master/close_header.php";
    include "../master/header.php";
    include "../master/navbar_admin.php";
    include "../master/breadcrumbs.php";
    $id = $_GET['Id'];
    $username = $_GET['email'];
    $role = $_GET['role'];
    $name = $_GET['name'];
    $is_manager = $_GET['ism'];
    $manager_id = $_GET['mid'];
    $dept_name = $_GET['dname'];
    $dept_id = $_GET['did'];
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
                                        <h2 class="m-b-0">Update form</h2>
                                    </div>
                                    <form action="update_code.php" method="POST">
                                        <?php if (isset($_GET['error'])) { ?>
                                            <div class="alert alert-danger" role="alert">
                                                <?= $_GET['error'] ?>
                                            </div>
                                        <?php } ?>
                                        <input type="hidden" name="update_id" id="update_id" value="<?php echo "$id" ?>">
                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="name">Name:</label>
                                            <div class="input-affix">
                                                <i class="prefix-icon anticon anticon-user"></i>
                                                <input type="text" class="form-control" id="name" name="name" placeholder="name" value="<?php echo "$name"; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1" for="role">Role</label>
                                            <select class="form-control" id="role" name="role">
                                                <option value="" disabled selected hidden>Please Select</option>
                                                <option <?php

                                                        if ($role == 'admin') {/* use name value as stored in database if capital then capital and if small then small */
                                                            echo "selected";
                                                        }
                                                        ?>>Admin</option>
                                                <option <?php
                                                        if ($role == 'employee') {
                                                            echo "selected";
                                                        }
                                                        ?>>Employee</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1" for="dept">Department</label>
                                            <select class="form-control" id="dept" name="dept">
                                                <option value="" disabled selected hidden>Please Select</option>
                                                <?php
                                                $sql = "SELECT dept_id,dept_name FROM dept_master WHERE is_deleted = 0 ORDER BY dept_id ASC ";
                                                $result = mysqli_query($conn, $sql);
                                                while ($row = $result->fetch_assoc()) :
                                                ?>
                                                    <option <?php
                                                            if ($dept_id == $row['dept_id']) {
                                                                echo "selected";
                                                            }
                                                            ?> value="<?php echo $row['dept_id']; ?>"> <?php echo $row['dept_name']; ?></option>
                                                <?php
                                                endwhile;
                                                ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="is_manager">Is Manager?</label>&nbsp;
                                            <!--<div class="input-affix">-->
                                            <input type="radio" id="is_manager" name="is_manager" value="yes" <?php
                                                                                                                if ($is_manager == 1) {
                                                                                                                    echo "checked";
                                                                                                                }
                                                                                                                ?>>
                                            <label for="is_manager"> yes </label>&nbsp;
                                            <input type="radio" id="is_manager" name="is_manager" value="no" <?php

                                                                                                                if ($is_manager == 0) {
                                                                                                                    echo "checked";
                                                                                                                }

                                                                                                                ?>>
                                            <label for="is_manager"> no </label>
                                            <!--</div>-->
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1" for="manager">Manager</label>
                                            <select class="form-control" id="manager" name="manager">
                                                <option value="" disabled selected hidden>Please Select</option>
                                                <option value=0 <?php
                                                                if ($manager_id == 0) {
                                                                    echo "selected";
                                                                }
                                                                ?>>No needed</option>
                                                <?php
                                                $sql = "SELECT name,user_master_id FROM user_master WHERE is_manager = 1 ORDER BY user_master_id ASC ";
                                                $result = mysqli_query($conn, $sql);
                                                while ($row = $result->fetch_assoc()) :
                                                ?>
                                                    <option <?php
                                                            if ($manager_id == $row['user_master_id']) {
                                                                echo "selected";
                                                            }
                                                            ?> value="<?php echo $row['user_master_id']; ?>"> <?php echo $row['name']; ?></option>
                                                <?php
                                                endwhile;
                                                ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="email">Email:</label>
                                            <div class="input-affix">
                                                <i class="prefix-icon anticon anticon-user"></i>
                                                <input type="text" class="form-control" id="email" name="email" placeholder="email" value="<?php echo "$username"; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <button class="btn btn-primary" name="update" value="update">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    include "../master/footer.php";
    include "../master/after-footer.php";
} else {
    header("Location:../login.php");
}
?>