<?php
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['user_master_id'])) {
    $id_1 = $_SESSION['user_master_id'];
    // while inserting any department, adding the values in created_by_id,and created_time
    date_default_timezone_set("asia/kolkata");
    $timestamp = date('Y-m-d H:i:s');
//making a connection to our database
include "../master/db_conn.php";
if (isset($_POST['update'])) {
    $id = $_POST['update_id'];
    $username = $_POST['email'];    
    $role = $_POST['role'];   
    $name = $_POST['name'];    
    $is_manager = filter_var($_POST['is_manager'], FILTER_VALIDATE_BOOLEAN);    
    $manager_id = $_POST['manager'];   
    $dept_id = $_POST['dept'];
    $sql = "UPDATE `user_master` SET `email` = '$username', `name` = '$name', `role` = '$role',`is_manager`='$is_manager',`manager_id`='$manager_id',`dept_id`='$dept_id',updated_date='$timestamp',updated_by_id='$id_1'  WHERE `user_master_id` = '$id'";
    $result = $conn->query($sql);
    if($result) {
        echo "Record updated successfully";
        header("refresh:1;allEmployee.php");
        } 
        else {
        echo "Error:". $sql . "<br>" . $conn->error;
        }
}
}