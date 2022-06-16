<?php
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['user_master_id'])) {
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
    $Evaluation_link = "../evaluation_form/view_admin_task.php";
    $Evaluation =  "Evaluation";
    $user_icon = "../assets/images/others/admin-default.png";
    $edit = "../edit_profile/edit_profile.php";
    $Session_name = $_SESSION['name'];
    $name = "$Session_name";
    $Report_link = "../report/report.php";
    $logout = "../logout.php";
    include "../master/db_conn.php";
    include "../master/pre-header.php";
    ?>
    <style>
        #label_id{
            font-size:large;
            text-align:center; 
            color:rgb(52, 140, 181);
        }
        #div_id{
            padding-top: 50px;

        }
    </style>
    <?php
    include "../master/close_header.php";
?>
    <?php
    include "../master/header.php";
    include "../master/navbar_admin.php";
    include "../master/breadcrumbs.php";
    ?>
    <!-- main content starts here -->
    <?php
    if (($_SESSION['role'] == 'employee' && $_SESSION['is_manager'] == 1) || ($_SESSION['role'] == 'employee' && $_SESSION['is_manager'] == 0) || ($_SESSION['role'] == 'admin')) { ?>
        <?php
        $form_id = $_GET['vmt_form_id'];
        //echo $form_id;
        $task_id = $_GET['vmt_task_id'];
        $task_title = $_GET['vmt_task_title'];
        $manager_id = $_GET['vmt_manager_id'];
        $for_id = $_GET['vmt_for_id'];
        $sql_1 = "SELECT name from user_master where user_master_id='$manager_id' AND is_deleted=0";
        $result_1 = mysqli_query($conn, $sql_1);
        $fetch_1 = $result_1->fetch_assoc();
        $sql_2 = "SELECT name from user_master where user_master_id='$for_id' AND is_deleted=0";
        $result_2 = mysqli_query($conn, $sql_2);
        $fetch_2 = $result_2->fetch_assoc();
        $sql_query = "SELECT duedate from form_master where form_id='$form_id' AND is_submit=1";
        $result_query = mysqli_query($conn, $sql_query);
        $fetch_query = $result_query->fetch_assoc();

        ?>
        <div class="form-group" style="float:right">
            <label>Due Date:</label>
            <input type="text" value="<?php echo $fetch_query['duedate']; ?>" disabled>
        </div>
        <div class="container" id="div_id">
            <div class="row">
                <div class="col">
                    <div class="d-flex flex-column justify-content-between w-100">
                        <div class="col-md-7 col-lg-12 m-h-auto">
                            <div class="card shadow-lg">
                                <div class="card-body">

                                    <!-- manager form starts here -->

                                    <label  for="form_id" id="label_id">Evaluation of <?php echo $fetch_2['name']; ?> By <?php echo $fetch_1['name']; ?> </label>

                                    <form action="employee_manager_insert.php" method="POST" id="form_id">
                                        <input type='hidden' id='mt_form_id' name='form_id' value='<?php echo " $form_id"; ?>'>
                                        <input type='hidden' id='manager_id' name='manager_id' value='<?php echo "$manager_id"; ?>'>
                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                            <div class="form-group">
                                                <input type="date" class="form-control" id="myDate_1" name="myDate" disabled />
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
                                                <select class="form-control" id="title" name="title" disabled>
                                                    <?php
                                                    //$id = $_SESSION['user_master_id'];
                                                    $sql = "SELECT task_id,task_title FROM task_master WHERE task_id='$task_id' AND is_deleted=0 ";
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
                                                <textarea rows="5" class="form-control" style="text-align:left" id="desc" name="desc" readonly><?php $query_1 = "SELECT desc_manager from form_master where form_id = '$form_id'";
                                                                                                                                                $r_1 = mysqli_query($conn, $query_1);
                                                                                                                                                while ($row_1 = $r_1->fetch_assoc()) : echo ($row_1['desc_manager']);
                                                                                                                                                endwhile;
                                                                                                                                                ?></textarea>
                                            </div>
                                        </div>
                                        <!-- form-evaluation-end -->


                                        <!-- form-checkbox -start -->
                                        <div class="form-group">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col"><label>parameters</label></th>

                                                        <th scope="col"><label>Your-Rate</label></th>

                                                    </tr>
                                                </thead>
                                                <?php
                                                $sql = "SELECT para_id,para_title,min_rating,max_rating FROM para_master WHERE is_deleted = 0 ";
                                                $result = mysqli_query($conn, $sql);
                                                $query_2 = "SELECT rating_manager FROM form_isto_para WHERE form_id ='$form_id' ";
                                                $r_2 = mysqli_query($conn, $query_2);
                                                $para = array(); ?>
                                                <tbody>
                                                    <?php
                                                    while ($row = $result->fetch_assoc()) : ?>
                                                        <tr>
                                                            <?php
                                                            $id = $row['para_id'];
                                                            ?>
                                                            <td><input type="checkbox" checked disabled name="parameter_<?php echo $row['para_id']; ?>" value="<?php echo $row['para_id']; ?>">
                                                                <label><?php echo $row['para_title']; ?></label>
                                                            </td>
                                                            <td>
                                                                <input type="text" disabled maxlength="2" size='3' name="rating_
                                                                    <?php echo $row['para_id']; ?>" value="<?php $row_2 = $r_2->fetch_assoc();
                                                                                                            echo $row_2['rating_manager']; ?>">
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    endwhile;
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- form-checkbox end------->

                                    </form>
                                    <!-- manager form ends here -->
                                </div>
                            </div>
                        </div>


                    </div>

                </div>
                <!--- form due-date start-->

                <!-- form due date end-->
                <div class="col">
                    <div class="d-flex flex-column justify-content-between w-100">
                        <div class="col-md-7 col-lg-12 m-h-auto">
                            <div class="card shadow-lg">
                                <div class="card-body">

                                    <!-- emp form starts here -->
                                    <label  for="form_id_1" id="label_id"><?php echo $fetch_2['name']; ?>'s Evaluation</label>
                                    <form action="employee_manager_insert.php" method="POST" id="form_id_1">
                                        <input type='hidden' id='mt_form_id' name='form_id' value='
                                                <?php echo " $form_id"; ?>'>

                                        <input type='hidden' id='manager_id' name='manager_id' value='
                                                <?php echo "$manager_id"; ?>'>


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
                                                <select class="form-control" id="title" name="title" disabled>
                                                    <?php
                                                    //$id = $_SESSION['user_master_id'];
                                                    $sql = "SELECT task_id,task_title FROM task_master WHERE task_id='$task_id' AND is_deleted=0 ";
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
                                                <textarea rows="5" class="form-control" style="text-align:left" id="desc" name="desc" placeholder="task_eval" required readonly><?php $query_1 = "SELECT desc_emp from form_master where form_id = '$form_id'";
                                                                                                                                                                                $r_1 = mysqli_query($conn, $query_1);
                                                                                                                                                                                while ($row_1 = $r_1->fetch_assoc()) : echo $row_1['desc_emp'];
                                                                                                                                                                                endwhile; ?></textarea>
                                            </div>
                                        </div>
                                        <!-- form-evaluation-end -->


                                        <!-- form-checkbox -start -->
                                        <div class="form-group">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col"><label>parameters</label></th>
                                                        <th scope="col"><label>Your-Rate</label></th>
                                                    </tr>
                                                </thead>
                                                <?php
                                                $sql = "SELECT para_id,para_title,min_rating,max_rating FROM para_master WHERE is_deleted = 0 ";
                                                $result = mysqli_query($conn, $sql);
                                                $query_2 = "SELECT rating_emp FROM form_isto_para WHERE form_id ='$form_id' ";
                                                $r_2 = mysqli_query($conn, $query_2);
                                                $para = array(); ?>
                                                <tbody>
                                                    <?php
                                                    while ($row = $result->fetch_assoc()) : ?>

                                                        <tr>
                                                            <?php

                                                            $id = $row['para_id'];
                                                            ?>
                                                            <td><input type="checkbox" checked disabled name="parameter_<?php echo $row['para_id']; ?>" value="<?php echo $row['para_id']; ?>">
                                                                <label><?php echo $row['para_title']; ?></label>
                                                            </td>

                                                            <td>
                                                                <input type="text" disabled maxlength="2" size='3' name="rating_
                                                                    <?php echo $row['para_id']; ?>" value="<?php
                                                                                                            $row_2 = $r_2->fetch_assoc();
                                                                                                            echo $row_2['rating_emp']; ?>">
                                                            </td>

                                                        </tr>


                                                    <?php
                                                    endwhile;
                                                    ?>
                                                </tbody>
                                            </table>


                                        </div>
                                        <!-- form-checkbox end------->


                                    </form>

                                    <!-- emp form ends here -->

                                </div>
                            </div>
                        </div>


                    </div>

                </div>
            </div>
            <div class="w-100">

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

        <script type="text/javascript">
            function SetDate_1() {
                var date = new Date();

                var day = date.getDate();
                var month = date.getMonth() + 1;
                var year = date.getFullYear();

                if (month < 10) month = "0" + month;
                if (day < 10) day = "0" + day;

                var today = year + "-" + month + "-" + day;


                document.getElementById('myDate_1').value = today;
            }
        </script>

        <body onload="SetDate(); SetDate_1(); ">

        <?php
    } else {
        header('Location:../login.php');
    }
        ?>












        <!-- main content ends here -->
    <?php

    include "../master/footer.php";
    include "../master/after-footer.php";
} else {
    header("Location:../login.php");
}
