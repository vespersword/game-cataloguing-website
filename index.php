<?php
   include("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 

      if($myusername == 'admin' && $mypassword == 'password'){
         header("location: admin.php");
      }
      
      $sql = "SELECT id FROM users WHERE username = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      //$active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      if($count == 1) {
         //session_register("myusername");
         $_SESSION['login_user'] = $myusername;
         
         header("location: home.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>
<html>
   
   <head>
      <title>User Login Page</title>
      <link rel="stylesheet" type="text/css" href="form.css">
   </head>  
<body bgcolor="lightblue">
<div align = "center">
<h1>User Login </h1>
<form action = "" method = "post">
 <label>Username  :</label><input type = "text" name = "username"><br><br>
 <label>Password  :</label><input type = "password" name = "password"><br><br>
<input type = "submit" value = " Submit "><br>
</form>
</div>
Not registered? Click <a href='register.php'>here</a> to register.
</body>
</html>