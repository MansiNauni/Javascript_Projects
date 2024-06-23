<?php
$login = false;
$showError = false;

if($_SERVER["REQUEST_METHOD"] == "POST"){
include 'partials/dbconnect.php';

$username = $_POST["username"];
$password = $_POST["password"];


  $exists = false;

  $sql = "SELECT * from login where username = '$username' AND password = '$password'";

  $result = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($result);
  if($num == 1){
    $login = true;
    session_start();
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;
    header("location:/loginform/welcome.php");
  }
    else{
    $showError = "Invalid Credentials";
}
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <style>
    .main-login {
        padding: 20px;
      }
  </style>
  <body>

  <?php require 'partials/nav.php'  ?>
  <?php
  if($login){
    echo'<div class="alert alert-success" role="alert">
    <h4 class="alert-heading">Success! Your Account has been created.</h4>
    </div>';
  }
  if($showError){
    echo'<div class="alert alert-danger" role="alert">
    <h4 class="alert-heading">Error</h4>'.$showError.'
    </div>';
  }
  ?>
  
   <div class="container">
    <h1 class="text-center">Login to our Page</h1>
   </div>
        <!-- form --> 
    <div class="main-login">
      <form  action="/loginform/login.php" method="POST">
        <div class="col-md-4">
          <label for="username" class="form-label">UserName</label>
          <input type="text" class="form-control" id="username" name ="username" aria-describedby="emailHelp">
 
        </div>
        <div class="col-md-4">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
  </div>
      

    <!-- end of form -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>