<?php
$servername = "localhost";
$username = "username";
$password = "";
$dbname = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

session_start();
   //echo md5('admin');
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      $myusername = mysqli_real_escape_string($conn, $_POST['username']);
      $mypassword = mysqli_real_escape_string($conn, $_POST['password']);
      
      $mypassword = md5($mypassword);
      
      $sql = "SELECT username FROM Admin WHERE username = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($conn, $sql);
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         $_SESSION['login_admin'] = $myusername;
         
         header("location: admin.php");
      } else {
        $myusername = mysqli_real_escape_string($conn, $_POST['username']);
        $mypassword = mysqli_real_escape_string($conn, $_POST['password']); 
        $mypassword = md5($mypassword);
        
        $sql = "SELECT username FROM User WHERE username = '$myusername' and password = '$mypassword'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        
         $count = mysqli_num_rows($result);
         if($count == 1) {
            $_SESSION['login_user'] = $myusername;
            
            header("location: user.php");
         } else {
            echo "Your Login Name or Password is invalid";
         }
      }
   }
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <title>Document</title>
</head>
<body>
    <nav>
        <div class="nav-wrapper">
            <a href="#" class="brand-logo center">Logo</a>
        </div>
    </nav>

    <div class="row">
    <form action="" method="post" class="col s12">
      <div class="row">
        <div class="input-field col s12">
          <input id="username" type="text" class="validate" name="username">
          <label for="username">Username</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="password" type="password" class="validate" name="password">
          <label for="password">Password</label>
        </div>
      </div>
      <div class="row">
        <div class="col s4">
            <button class="btn waves-effect waves-light" type="submit" name="login">
                Submit
            </button>
        </div>
      </div>
    </form>
  </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</html>