<?php
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['user_master_id'])) {
    include "../master/db_conn.php";
    if (isset($_POST['submit'])) {
        //Filtering teh data
        function test_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        //creating new variable and storing the values of the post method
        $username = test_input($_POST['username']);
        $password = test_input($_POST['password']);
        $password_1 = test_input($_POST['password_1']);

        if (empty($password) && empty($password_1)) {
            header("Location: edit_profile.php?error=Please don't put the password field empty");
        } elseif ($password != $password_1) {
            header("Location: edit_profile.php?error=Passwords mismatched");
        } else {
            //hashing the password..
            $password = md5($password);
            $sql = "UPDATE  user_master SET password='$password' WHERE email ='$username' AND is_deleted = 0";
            $result = mysqli_query($conn, $sql);
            if($result){
                session_unset();
                session_destroy();
                header("Location:../login.php");
            }else{
                header("Location: edit_profile.php?error=Something is fishy");
            }
           
        }
    } else {
        //else block of post submit;;;;
        header("Location: edit_profile.php?error=Something wrong");
    }
} else {
    header("Location:../login.php");
}
