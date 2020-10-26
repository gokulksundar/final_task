<?php
 session_start();
  include('dboperation.php');
  $con=new DB_con();
  $id=$_SESSION['userid'];
  $result=$con->getdata($id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="userstyle.css">
  <link rel="stylesheet" href="bootstrap.min.css">
  <script src="bootstrap.min.js"></script>
 <style type="text/css">
   table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
 </style>
</head>
<body>
	<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#"></a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="">Home</a></li>
      
      
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"><?php echo $_SESSION['username']?></span> </a></li>
      <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    </ul>
  </div>
</nav>
<div class="sidebar">
 <a class="active" href="user_home.php">Profile</a>
  <a href="user_edit_profile.php">Edit Profile</a>
  <a href="user_delete_data.php">Delete Data</a>
</div>

<div class="content">
  <h2>Welcom <?php echo $_SESSION['username']; ?></h2>
  <h2>User Profile</h2>
  <table>
  <tr>
    <th>User Details</th>
  </tr>
  <tr>
    <td><?php echo $result['name'];?></td>
    
  </tr>
  <tr>
    <td><?php echo $result['email'];?></td>
    
  </tr>
  <tr>
    <td><?php echo $result['phone'];?></td>
    
  </tr>
  <tr>
    <td><?php echo $result['address'];?></td>
    
  </tr>
  <tr>
    <td><?php echo $result['city'];?></td>
    
  </tr>
  <tr>
    <td><?php echo $result['state'];?></td>
    
  </tr>
  <tr>
    <td><?php echo $result['district'];?></td>
    
  </tr>
  <tr>
    <td><?php echo $result['country'];?></td>
    
  </tr>
  <tr>
    <td><?php echo $result['pincode'];?></td>
    
  </tr>
</table>
  
</div>
</body>
</html>