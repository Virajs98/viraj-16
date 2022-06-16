<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION['username']) && !isset($_SESSION['user_master_id'])) {
        header("Location:login.php");
    } else {
        if ($_SESSION['role'] == 'employee') {
            if ($_SESSION['is_manager'] == 1) {
                header("LOCATION:manager/manager-dashboard.php");
    
            } else {
                header("LOCATION:employee/employee-dashboard.php");
            }
        } else {
            header("LOCATION:admin/admin-dashboard.php");
        }
    } ?>

</body>

</html>