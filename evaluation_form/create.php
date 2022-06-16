<?php
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['user_master_id'])) {
    if ($_SESSION['role'] == 'admin') {
        $page_title = "admin_team";
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
        $Evaluation_link = "view_admin_task.php";
        $Evaluation =  "Evaluation";
        $user_icon = "../assets/images/others/admin-default.png";
        $edit = "../edit_profile/edit_profile.php";
        $Session_name = $_SESSION['name'];
        $name = "$Session_name";
        $Report_link = "../report/report.php";
        $logout = "../logout.php";
        include "../master/db_conn.php";
        include "../master/pre-header.php";
        include "../master/close_header.php";
?>

    <?php
        include "../master/header.php";
        include "../master/navbar_admin.php";
    } elseif ($_SESSION['role'] == 'employee') {
        if ($_SESSION['is_manager'] == 1) {
            //manager
            $page_title = "view";
            $Dashboard = "MANAGER";
            $Dashboard_link = "../manager/manager-dashboard.php";
            $My_Evaluation = "My Evaluation";
            $MyEvaluation_link = "view_manager_task.php";
            $My_Team = "MY TEAM";
            $MyTeam_link = "../manager/manager_myteam.php";
            $user_icon = "../assets/images/others/user-default.png";
            $edit = "../edit_profile/edit_profile.php";
            $Session_name = $_SESSION['name'];
            $name = "$Session_name";
            $logout = "../logout.php";
            include "../master/db_conn.php";
            include "../master/pre-header.php";
            include "../master/close_header.php";
            include "../master/header.php";
            include "../master/navbar_manager.php";
        } else {
            header("Location: ../login.php");
        }
    }

    include "../master/breadcrumbs.php";
    ?>
    <div class="app">
        <div class="container-fluid p-h-0 p-v-20 bg full-height d-flex" style="background-image: url('assets/images/others/login-3.png')">
            <div class="d-flex flex-column justify-content-between w-100">
                <div class="container d-flex h-100">
                    <div class="row align-items-center w-100">
                        <div class="col-md-7 col-lg-11 m-h-auto">
                            <div class="card shadow-lg">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between m-b-30">
                                        <img class="img-fluid" alt="" src="assets/images/logo/logo.png">
                                    </div>
                                    <form action="insert.php" method="POST">
                                        <input type='hidden' id='form_id' name='form_id' value='
                                        <?php echo uniqid();
                                        ?>
                                        '>
                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                            <div class="form-group">
                                                <input type="date" class="form-control" id="myDate" name="myDate" disabled />
                                            </div>
                                        </div>
                                        <?php if (isset($_GET['error'])) { ?>
                                            <div class="alert alert-danger" role="alert">
                                                <?= $_GET['error'] ?>
                                            </div>
                                        <?php } ?>
                                        <!-- form-task-start -->
                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="title">Task Title:</label>
                                            <div class="input-affix">
                                                <select class="form-control" id="title" name="title">
                                                    <option value="" disabled selected hidden>Please Select</option>
                                                    <?php
                                                    //$id = $_SESSION['user_master_id'];
                                                    $sql = "SELECT task_id,task_title FROM task_master WHERE is_deleted=0  ORDER BY task_id ASC ";
                                                    $result = mysqli_query($conn, $sql);
                                                    while ($row = $result->fetch_assoc()) :
                                                    ?>
                                                        <option value="<?php echo $row['task_id']; ?>"> <?php echo $row['task_title']; ?></option>
                                                    <?php
                                                    endwhile;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- form-task-end -->
                                        <!-- form-evaluation-start -->
                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="desc">Evaluation:</label>
                                            <div class="input-affix">
                                                <!--<i class="prefix-icon anticon anticon-user"></i>-->
                                                <input type="text" class="form-control" style="text-align:left" id="desc" name="desc" placeholder="task_eval" required>
                                            </div>
                                        </div>
                                        <!-- form-evaluation-end -->

                                        <!-- form-checkbox -start -->
                                        <div class="form-group">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col"><label>parameters</label></th>
                                                       <!--min grade <th scope="col"><label>Min-Rate</label></th>-->
                                                        <th scope="col"><label>Grade:</label></th>
                                                       <!--max Grade <th scope="col"><label>Max-Rate</label></th>-->
                                                    </tr>
                                                </thead>
                                                <?php
                                                $sql = "SELECT para_id,para_title,min_rating,max_rating FROM para_master WHERE is_deleted = 0 ";
                                                $result = mysqli_query($conn, $sql);
                                                $para = array(); ?>
                                                <tbody>
                                                    <?php
                                                    while ($row = $result->fetch_assoc()) : ?>

                                                        <tr>
                                                            <?php

                                                            $id = $row['para_id'];
                                                            //$query = "SELECT min_rating,max_rating FROM para_master WHERE para_id=$id";
                                                            //$res = mysqli_query($conn, $query);
                                                            //$row1 = mysqli_fetch_assoc($res)
                                                            ?>
                                                            <td><input type="checkbox" name="parameter_<?php echo $row['para_id']; ?>" value="<?php echo $row['para_id']; ?>">
                                                                <label><?php echo $row['para_title']; ?></label>
                                                            </td>
                                                           <!--min Grade <td>
                                                                <input type="text" disabled maxlength="2" size='3' name=" min_rating" value="<?php //echo $row['min_rating']; ?>">
                                                            </td>-->
                                                            <td>
                                                                <input type="number" min="0" max="10" maxlength="2" size='3' name="rating_<?php echo $row['para_id']; ?>">
                                                            </td>
                                                           <!-- max Grade <td>
                                                                <input type="text" disabled maxlength="2" size='3' name="max_rating" value="<?php //echo $row['max_rating']; ?>">
                                                            </td>-->

                                                        </tr>


                                                    <?php
                                                    endwhile;
                                                    ?>
                                                </tbody>
                                            </table>


                                        </div>
                                        <!-- form-checkbox end--->

                                        <!--- form-employee -start -->

                                        <div class="form-group">
                                            <label for="employee">Employee</label>
                                            <select class="form-control" id="employee" name="employee">

                                                <?php
                                                $uid = $_GET['Id'];
                                                $id = $_SESSION['user_master_id'];
                                                $sql = "SELECT name,user_master_id FROM user_master WHERE user_master_id = '$uid' AND is_deleted=0 AND manager_id = $id ";
                                                $result = mysqli_query($conn, $sql);
                                                while ($row = $result->fetch_assoc()) :
                                                ?>
                                                    <option value="<?php echo $row['user_master_id']; ?>"> <?php echo $row['name']; ?></option>
                                                <?php
                                                endwhile;
                                                ?>
                                            </select>
                                        </div>
                                        <!-- form-employee -end -->

                                        <!-- form-due-date start-->
                                        <div class="form-group">
                                            <label for="dueDate">Due Date</label>
                                            <input type="date" class="form-control" id="dueDate" name="dueDate" />

                                        </div>
                                        <!-- form-due-date end-->

                                        <!-- form-submit -start -->
                                        <div class="form-group">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <button class="btn btn-primary" name="submit" value='submit' id='submit'>Submit</button>
                                            </div>
                                        </div>
                                        <!-- form-submit -end -->
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script type="text/javascript">
        function SetDate() {
            var date = new Date();

            var day = date.getDate();
            var month = date.getMonth() + 1;
            var year = date.getFullYear();

            if (month < 10) month = "0" + month;
            if (day < 10) day = "0" + day;

            var today = year + "-" + month + "-" + day;


            document.getElementById('myDate').value = today;
        }
    </script>
    <script>
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1;
        var yyyy = today.getFullYear();
        if (dd < 10) {
            dd = '0' + dd
        }
        if (mm < 10) {
            mm = '0' + mm
        }
        today=yyyy+'-'+mm+'-'+dd;
        document.getElementById("dueDate").setAttribute("min",today);
    </script>

    <body onload="SetDate();">
    <?php

    include "../master/footer.php";
    include "../master/after-footer.php";
} else {
    header("Location:../login.php");
}
