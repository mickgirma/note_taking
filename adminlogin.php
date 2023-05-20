<?php
session_start();
include('includes/config.php');

if (isset($_POST['adminlog'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query the database to verify the admin's credentials and role
    // Assuming you have an admins table with columns admin_ID, email, password, and role
    $sql = "SELECT * FROM admins WHERE email = '$email' AND password = '$password'";
    $query= mysqli_query($conn, $sql);
    $count = mysqli_num_rows($query);
    if($count > 0)
    {
      while ($row = mysqli_fetch_assoc($query)) {
         $_SESSION['alogin']=$row['role'];
         echo "<script type='text/javascript'> document.location = 'users.php'; </script>";
      }
  
    } 
    else{
      
      echo "<script>alert('Invalid Details');</script>";
  
    }
  
  }


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

<section id="content" class="m-t-lg wrapper-md animated fadeInUp">    
    <div class="container aside-xxl">
      <section class="panel panel-default bg-white m-t-lg">
        <header class="panel-heading text-center">
          <strong>Admin Login Form</strong>
        </header>
        <form name="adminlog" method="POST">
          <div class="panel-body wrapper-lg">
          	<div class="form-group">
            <label class="control-label">Email</label>
            <input name="email" type="email" placeholder="codelytical@example.com" class="form-control input-lg">
          </div>
          <div class="form-group">
            <label class="control-label">Password</label>
            <input name="password" type="password" id="inputPassword" placeholder="Password" class="form-control input-lg">
          </div>
          <div class="line line-dashed"></div>
          <button name="adminlog" type="submit" class="btn btn-primary btn-block">Login</button>
          <div class="line line-dashed"></div>
          </div>
        </form>
    </div>
</section>

 <!-- Bootstrap -->
 <script src="js/bootstrap.js"></script>
  <!-- App -->
  <script src="js/app.js"></script>
  <script src="js/app.plugin.js"></script>
  <script src="js/slimscroll/jquery.slimscroll.min.js"></script>

</body>
</html>