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
    $Evaluation_link = "view_admin_task.php";
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
?>
    <?php
    include "../master/header.php";
    include "../master/navbar_admin.php";
    include "../master/breadcrumbs.php";
    ?>
    <!-- main content starts here -->
    <div class="app">
        <div class="container-fluid p-h-0 p-v-20 bg full-height d-flex" style="background-image: url('assets/images/others/login-3.png')">
            <div class="d-flex flex-column justify-content-between w-100">
                <div class="container d-flex h-100">
                    <div class="row align-items-center w-100">
                        <div class="col-md-7 col-lg-10 m-h-auto">
                            <div class="card shadow-lg">
                                <div class="card-body">
                                    <div class="container d-flex align-items-center" style="min-height: 30vh">
                                        <div class="p-3">
                                            <?php $id = $_SESSION['user_master_id'];
                                            /*$query = "SELECT form_master.form_id,form_master.task_id,form_master.manager_id,form_master.for_id,task_master.task_title FROM form_master INNER JOIN task_master on form_master.task_id=task_master.task_id WHERE form_master.is_deleted=0 AND task_master.is_deleted=0 AND form_master.is_submit=0"; //where is_delete==0
        $result = mysqli_query($conn, $query);*/

                                            $query_1 = "SELECT form_master.form_id,form_master.task_id,form_master.manager_id,form_master.for_id,form_master.date_emp,form_master.date_manager,task_master.task_title FROM form_master INNER JOIN task_master on form_master.task_id=task_master.task_id WHERE form_master.is_deleted=0 AND task_master.is_deleted=0 AND form_master.is_submit=1"; //where is_delete==0
                                            $result_1 = mysqli_query($conn, $query_1);
                                            if (mysqli_num_rows($result_1) > 0) { ?>

                                                <h2 class="display-4 fs-1">Tasks</h2>
                                                <table cellspacing="5" cellpadding="5">
                                                    <tbody>
                                                        <tr>
                                                            <td>Minimum date:</td>
                                                            <td><input type="text" id="min" name="min"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Maximum date:</td>
                                                            <td><input type="text" id="max" name="max"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css" />
                                                <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.1.2/css/dataTables.dateTime.min.css" />
                                                <table id="table" class="table-success table-bordered" style="width: 45rem;">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Sr.No.</th>
                                                            <th scope="col" title="The date when manager of employee submitted his/here employee evaluation">M.Date</th>
                                                            <th scope="col" title="The date when employee submitted his/her evaluation">E.Date</th>
                                                            <th scope="col" style="display:none">Form Id</th>
                                                            <th scope="col" style="display:none">Task Id</th>
                                                            <th scope="col">Task Title</th>
                                                            <th scope="col" style="display:none">Manager Id</th>
                                                            <th scope="col" style="display:none">For Id</th>
                                                            <th scope="col">Employee Name</th>
                                                            <th scope="col">Manager Name</th>
                                                            <th scope="col">Evaluations</th>
                                                            <!--<th scope="col">Manager Evaluations</th>-->
                                                            <!--<th scope="col">Employee Evaluations</th>-->
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <!-- Previous record start -->
                                                        <?php
                                                        $i_1 = 1;
                                                        while ($rows_1 = mysqli_fetch_assoc($result_1)) { ?>
                                                            <?php
                                                            $emp_id = $rows_1['for_id'];
                                                            $mang_id = $rows_1['manager_id'];
                                                            $query_2 = "SELECT name from user_master WHERE user_master_id=$emp_id AND is_deleted=0";
                                                            $result_2 = mysqli_query($conn, $query_2);
                                                            $rows_2 = mysqli_fetch_assoc($result_2);
                                                            $query_3 = "SELECT name from user_master WHERE user_master_id=$mang_id AND is_deleted=0";
                                                            $result_3 = mysqli_query($conn, $query_3);
                                                            $rows_3 = mysqli_fetch_assoc($result_3);
                                                            ?>
                                                            <tr>
                                                                <td><?= $i_1 ?></td>
                                                                <td><?= $rows_1['date_manager'] ?></td>
                                                                <td><?= $rows_1['date_emp'] ?></td>
                                                                <td style="display: none"><?= $rows_1['form_id'] ?></td>
                                                                <td style="display:none"><?= $rows_1['task_id'] ?></td>
                                                                <td><?= $rows_1['task_title'] ?></td>
                                                                <td style="display:none"><?= $rows_1['manager_id'] ?></td>
                                                                <td style="display:none"><?= $rows_1['for_id'] ?></td>
                                                                <td> <?= $rows_2['name'] ?> </td>
                                                                <td> <?= $rows_3['name'] ?> </td>
                                                                <td>
                                                                    <a class="btn btn-success evalbtn" href="../task/dis_eva_task.php?vmt_form_id=<?php echo $rows_1['form_id']; ?> &vmt_task_id=<?php echo $rows_1['task_id'] ?> &vmt_task_title=<?php echo $rows_1['task_title'] ?> &vmt_manager_id=<?php echo $rows_1['manager_id'] ?> &vmt_for_id=<?php echo $rows_1['for_id'] ?>">View</a>
                                                                </td>
                                                            </tr>
                                                        <?php $i_1++;
                                                        }
                                                        ?>
                                                        <!-- Previous record end -->
                                                    </tbody>
                                                </table>
                                                <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
                                                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                                                <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
                                                <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>
                                                <script src="https://cdn.datatables.net/datetime/1.1.2/js/dataTables.dateTime.min.js"></script>
                                                <script>
                                                    var minDate, maxDate;
                                                    $.fn.dataTable.ext.search.push(
                                                        function(settings, data, dataIndex) {
                                                            var min = minDate.val();
                                                            var max = maxDate.val();
                                                            var date = new Date(data[2]);
                                                            if (
                                                                (min === null && max === null) ||
                                                                (min === null && date <= max) ||
                                                                (min <= date && max === null) ||
                                                                (min <= date && date <= max)
                                                            ) {
                                                                return true;
                                                            }
                                                            return false;
                                                        }
                                                    );

                                                    jQuery(document).ready(function($) {

                                                        // Create date inputs
                                                        minDate = new DateTime($('#min'), {
                                                            format: 'MMMM Do YYYY'
                                                        });
                                                        maxDate = new DateTime($('#max'), {
                                                            format: 'MMMM Do YYYY'
                                                        });
                                                        // DataTables initialisation
                                                        var table = $('#table').DataTable();

                                                        // Refilter the table
                                                        $('#min, #max').on('change', function() {
                                                            table.draw();
                                                        });

                                                    });
                                                </script>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- main content ends here -->
<?php

    include "../master/footer.php";
    include "../master/after-footer.php";
} else {
    header("Location:../login.php");
}
