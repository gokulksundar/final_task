<?php
 session_start();
  include('dboperation.php');
  $con=new DB_con();
  $id=$_SESSION['adminid'];
  $admin_name=$_SESSION['admin_name'];
  $result=$con->getall_users();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/userstyle.css">
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
      <li class="active"><a href="admin_home.php">Home</a></li>
      
      
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"><?php echo $admin_name?></span> </a></li>
      <li><a href="admin_logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    </ul>
  </div>
</nav>
<div class="sidebar">
 <a  href="admin_show_user_data.php">show Users</a>
  
</div>

<div class="content">
  <h2>Welcom <?php echo $admin_name; ?></h2>
  <table>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>phone No</th>
        <th>address</th>
        <th>city</th>
        <th>state</th>
        <th>country</th>
        <th>Operation</th>
       
      </tr>
       <?php
      foreach ( $result as $data ) 
      {
        echo '<div>';
        echo '<tr>';
         echo '<td>'.$data['cust_id'].'</td>';
        echo '<td>'.$data['name'].'</td>';
        echo '<td>'.$data['phone'].'</td>';
        echo '<td>'.$data['address'].'</td>';
        echo '<td>'.$data['city'].'</td>';
        echo '<td>'.$data['state'].'</td>';
        echo '<td>'.$data['country'].'</td>';
        echo '<td>';
        $id=$data['cust_id'];
         echo '<a href="admin_delete_user.php?user_id=' . $id . '">DELETE</a>';
        echo '</tr>';
        echo '</div>';
      }
        ?>
    
  
</table>
  
</div>
</body>
</html>