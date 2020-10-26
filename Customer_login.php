<?php
  session_start();
  include('dboperation.php');
  $con=new DB_con();
  $display='none';
  if(isset($_POST['login']))
  {
   $email=$_POST['email'];
   $password=$_POST['password'];
   $result=$con->loginverify($email,$password);
   if($result)
   {
    $id=$_SESSION['userid'];
   header("Location: user_home.php?id=".$id);
    
   }
   else
   {
    $display='block';
   }
 }
   ?>
<!DOCTYPE html>
<html>
 <head>
    <link rel="stylesheet" type="text/css" href="login.css">

  </head>
<body>
    <form method="post" action="#">
      <div class="box">
      <h1>Customer Login</h1>

      <input type="email" name="email"  placeholder="username" class="txt" />
        
      <input type="password" name="password" placeholder="password" class="txt" />

      <input type="submit" name="login" class="btn" value="sign in">
      <a href="Customer_registration.php" class="btn2">sign up</a>
        <span class="error" style="display: <?php echo $display;?>">Username or password is Incorrect...! </a></span> <br>
      </div> <!-- End Box -->
      
    </form>

   
</body>
</html>