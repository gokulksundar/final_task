<?php
  include('dboperation.php');
  $con=new DB_con();
  if(isset($_GET['user_id']))
     {
    $user_id=$_GET['user_id'];
    echo $user_id;
    $result=$con->admin_delete_user($user_id);
     header("Location: admin_show_user_data.php");

    }else
    {
    //user was not passed, so print a error or just exit(0);
    }

  ?>