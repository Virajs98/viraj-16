<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ajax</title>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.js"></script>

</head>

<body>
    <?php
    include "master/db_conn.php";
    $query_1 = "SELECT form_id FROM form_master WHERE form_master.is_deleted=0  AND form_master.is_submit=1"; //where is_delete==0
    $result_1 = mysqli_query($conn, $query_1);
    if (mysqli_num_rows($result_1) > 0) { ?>
        <table id='table_id'>
            <thead>
                <tr>
                    <th>Sr.No</th>
                    <th>form_id</th>
                    <th>OVERALL_MARKS_MANAGER</th>
                    <th>OVERALL_MARKS_EMPLOYEE </th>
                    <th>Difference</th>
                    <th>hidden</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i_1 = 1;
                while ($rows_1 = mysqli_fetch_assoc($result_1)) {
                    $form_id = $rows_1['form_id'];
                ?><tr>
                        <td><?= $i_1 ?></td>
                        <td><?php echo $rows_1['form_id']; ?></td>
                        <?php
                        $query_2 = "SELECT rating_emp,rating_manager FROM form_isto_para WHERE form_id=$form_id";
                        $result_2 = mysqli_query($conn, $query_2);
                        $sum_m = 0;
                        $sum_e = 0;
                        $n = 0;
                        while ($rows_2 = mysqli_fetch_assoc($result_2)) {
                            $emp_rating = $rows_2['rating_emp'];
                            $manager_rating = $rows_2['rating_manager'];
                            $sum_m = $sum_m + $manager_rating;
                            $sum_e = $sum_e + $emp_rating;
                            $n++;
                        }
                        $overall_m = (100 * $sum_m) / (10 * $n);
                        $overall_e = (100 * $sum_e) / (10 * $n);
                        $diff = round($overall_m - $overall_e);
                        ?>
                        <td><?php echo round($overall_m);
                            ?></td>
                        <td><?php
                            echo round($overall_e);
                            ?></td>
                        <td class="y_s"><?php echo $diff; ?></td>
                        <?php 
                        if($diff>0){
                            $var = "Y";
                        }else{
                            $var="N";
                        }
                        ?>
                        <td class="y_n"><?php echo $var?></td>
                    </tr>
                <?php
                    $i_1++;
                }
                ?>
            </tbody>
        </table>
    <?php
    }
    ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table_id td.y_n').each(function() {
                if ($(this).text() == "Y") {
                    $(this).css('background-color', '#f00');
                    $('#table_id td.y_s').each(function(){
                        $(this).css('background-color', '#f00');
                    });
                }
            });
        });
    </script>
</body>

</html>