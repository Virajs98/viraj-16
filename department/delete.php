<?php 

include "../master/db_conn.php";
if(isset($_POST['deletedata']))
{
    $id = $_POST['delete_id'];
    $query = "UPDATE dept_master SET is_deleted = 1  WHERE dept_id='$id'  ";

    //$query = "DELETE FROM dept_master WHERE dept_id='$id'";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        header("location: create_dept.php");
    }
    else
    {
        echo '<script> alert("Data Not Deleted"); </script>';
    }
}


?>