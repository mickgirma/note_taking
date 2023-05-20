<?php
// session_start();
 include('includes/config.php'); 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Notes</title>
    <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="css/animate.css" type="text/css" />
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="css/font.css" type="text/css" />
    <link rel="stylesheet" href="css/app.css" type="text/css" />
</head>
<body>

	 <div id="wrapper">

        <div id="page-wrapper">

            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">

                        
                        <h1 class="page-header">
                            All Users
                        </h1>

                        <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Delete</th>
                            </tr>
                        </thead>

                        <tbody>
                            
        <?php 
            
            $query = "SELECT * FROM register ORDER BY fullName ASC ";
            $select_users = mysqli_query($conn, $query) or die(mysqli_error($conn));
            if (mysqli_num_rows($select_users) > 0 ) {
            while ($row = mysqli_fetch_array($select_users)) {
                $user_id = $row['user_ID'];
                $username = $row['fullName'];
                // $name = $row['name'];
                $user_email = $row['email'];
                $user_role = $row['role'];
                // $user_course = $row['course'];
                echo "<tr>";
                echo "<td>$user_id</td>";
                echo "<td><a href='viewprofile.php?name=$username' target='_blank'> $username</a></td>";
                // echo "<td>$name</td>";
                echo "<td>$user_email</td>";
                echo "<td>$user_role</td>";
                // echo "<td>$user_course</td>";
                echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this user?')\" href='users.php?delete=$user_id'><i class='fa fa-times fa-lg'></i>delete</a></td>";
                echo "</tr>";
             }
        ?>

    </tbody>
 </table>

<?php 
}

    if (isset($_GET['delete'])) {
        $the_user_id = mysqli_real_escape_string($conn , $_GET['delete']);
        $query0 = "SELECT role FROM register WHERE user_ID = '$the_user_id'";
        $result = mysqli_query($conn , $query0) or die(mysqli_error($conn));
        if (mysqli_num_rows($result) > 0 ) {
            $row = mysqli_fetch_array($result);
            $id1 = $row['role'];
        }
        if ($id1 == 'admin') {
            echo "<script>alert('admin cannot be deleted');</script>";
        }
        else {

        $query = "DELETE FROM register WHERE user_ID = '$the_user_id'";

        $delete_query = mysqli_query($conn, $query) or die (mysqli_error($conn));
        if (mysqli_affected_rows($conn) > 0 ) {
            echo "<script>alert('user deleted successfully');
            window.location.href= 'users.php';</script>";
        }
        else {
        	 echo "<script>alert('error');
            window.location.href= 'users.php';</script>";
        }
    }
}
    ?>
    </div>
    </div>
    </div>
    </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>