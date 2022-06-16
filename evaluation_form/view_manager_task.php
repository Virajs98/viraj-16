<?php
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['user_master_id'])) {
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
    include "../master/breadcrumbs.php";
    //

?>
    <!-- main content start here-->
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
                                        <?php if (isset($_GET['error'])) { ?>
                                                <div class="alert alert-danger" role="alert">
                                                    <?= $_GET['error'] ?>
                                                </div>
                                            <?php } ?>
                                            <?php $id = $_SESSION['user_master_id'];
                                            $query = "SELECT form_master.form_id,form_master.task_id,form_master.manager_id,form_master.for_id,form_master.duedate,task_master.task_title FROM form_master INNER JOIN task_master on form_master.task_id=task_master.task_id WHERE form_master.for_id='$id' AND form_master.is_deleted=0 AND task_master.is_deleted=0 AND form_master.is_submit=0"; //where is_delete==0
                                            $result = mysqli_query($conn, $query);

                                            $query_1 = "SELECT form_master.form_id,form_master.task_id,form_master.manager_id,form_master.for_id,form_master.duedate,task_master.task_title FROM form_master INNER JOIN task_master on form_master.task_id=task_master.task_id WHERE form_master.for_id='$id' AND form_master.is_deleted=0 AND task_master.is_deleted=0 AND form_master.is_submit=1"; //where is_delete==0
                                            $result_1 = mysqli_query($conn, $query_1);


                                            if (mysqli_num_rows($result) > 0 || mysqli_num_rows($result_1) > 0) { ?>

                                                <h1 class="display-4 fs-1">Tasks</h1>
                                                <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css" />
                                                <table id="table" class="table" style="width: 45rem;">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Form Id</th>
                                                            <th scope="col">Task Id</th>
                                                            <th scope="col">Task Title</th>
                                                            <th scope="col" style="display:none">Manager Id</th>
                                                            <th scope="col" style="display:none">For Id</th>
                                                            <th scope="col" >Due Date</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $i = 1;
                                                        while ($rows = mysqli_fetch_assoc($result)) { ?>
                                                            <tr>
                                                                <td><?= $rows['form_id'] ?></td>
                                                                <td><?= $rows['task_id'] ?></td>
                                                                <td><?= $rows['task_title'] ?></td>
                                                                <td style="display:none"><?= $rows['manager_id'] ?></td>
                                                                <td style="display:none"><?= $rows['for_id'] ?></td>
                                                                <td><?= $rows['duedate']?></td>
                                                                <td>
                                                                    <a class="btn btn-success evalbtn" href="../task/manager_task.php?vmt_form_id=<?php echo $rows['form_id']; ?> &vmt_task_id=<?php echo $rows['task_id'] ?> &vmt_task_title=<?php echo $rows['task_title'] ?> &vmt_manager_id=<?php echo $rows['manager_id'] ?> &vmt_for_id=<?php echo $rows['for_id'] ?> &vmt_dueDate=<?php echo $rows['duedate'] ?>">Evaluate</a>
                                                                </td>
                                                            </tr>
                                                        <?php $i++;
                                                        }
                                                        ?>
                                                        <!-- Previous record start -->
                                                        <?php
                                                        $i_1 = 1;
                                                        while ($rows_1 = mysqli_fetch_assoc($result_1)) { ?>
                                                            <tr>
                                                                <td><?= $rows_1['form_id'] ?></td>
                                                                <td><?= $rows_1['task_id'] ?></td>
                                                                <td><?= $rows_1['task_title'] ?></td>
                                                                <td style="display:none"><?= $rows_1['manager_id'] ?></td>
                                                                <td style="display:none"><?= $rows_1['for_id'] ?></td>
                                                                <td><?= $rows_1['duedate']?></td>
                                                                <td>
                                                                    <a class="btn btn-success evalbtn" href="../task/disabled_view.php?vmt_form_id=<?php echo $rows_1['form_id']; ?> &vmt_task_id=<?php echo $rows_1['task_id'] ?> &vmt_task_title=<?php echo $rows_1['task_title'] ?> &vmt_manager_id=<?php echo $rows_1['manager_id'] ?> &vmt_for_id=<?php echo $rows_1['for_id'] ?>">View</a>
                                                                </td>
                                                            </tr>
                                                        <?php $i++;
                                                        }
                                                        ?>
                                                        <!-- Previous record end -->
                                                    </tbody>
                                                </table>
                                                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                                                <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>
                                                <script>
                                                    jQuery(document).ready(function($) {
                                                        $('#table').DataTable();
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


    <!-- main content end here-->
<?php
    include "../master/footer.php";
    include "../master/after-footer.php";
} else {
    header("Location:../login.php");
}
?>