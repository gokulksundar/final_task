<?php
 session_start();
  include('dboperation.php');
  $con=new DB_con();
  $name=$_SESSION['username'];
  $email=$_SESSION['email'];
  $id=$_SESSION['userid'];
  $result=$con->getdata($id);
  if($result)
  {
  $display_add_button="none";
  $display_update_button="block";
  }
  else
  {
    $display_add_button="block";
     $display_update_button="none";
  }
   if(isset($_POST['Add']))
    {
       $con=new DB_con();
       $result=$con->add_data($_POST);
       if($result)
       {
        
        header("Location: user_home.php");
       }
       else
       {
       echo "<script type='text/javascript'>  alert('error in updation'); </script>";
         
       }
    }
    if(isset($_POST['update']))
    {
       $con=new DB_con();
       $result=$con->update_data($_POST);
       if($result)
       {
        
        header("Location: user_home.php");
       }
       else
       {
       echo "<script type='text/javascript'>  alert('error in updation'); </script>";
       }
    }

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
  <script src="http://code.jquery.com/jquery-1.8.3.min.js" type="text/javascript"></script>

  <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.js" type="text/javascript"></script>
 
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
      <li><a href="#"><span class="glyphicon glyphicon-user"><?php echo $name?></span> </a></li>
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
  <h2>Responsive Sidebar Example</h2>
  <form name="form1" id="form1" method="post" action="#">
      <input type="text" name="name" id="name" value='<?php echo $name;?>' class="txt" /><br>
      <input type="email" name="email" id="email" value='<?php echo $email;?>' placeholder="Email" class="txt" /><br>
      <input type="number" name="phone" id="phone" placeholder="phone number" value="<?php echo $result['phone'];?>" class="txt" /><br>
      <input type="text" name="address" id="address"  placeholder=" address" value="<?php echo $result['address'];?>" class="txt" /><br>
      <input type="text" name="city" id="city" placeholder="city" value="<?php echo $result['city'];?>" class="txt" /><br>
      <input type="text" name="state" id="state" placeholder="state" value="<?php echo $result['state'];?>" class="txt" /><br>
      <input type="text" name="district" id="district" placeholder="district" value="<?php echo $result['district'];?>" class="txt" /><br>
      <input type="text" name="country" id="country" class="txt" value="<?php echo $result['country'];?>" placeholder="country">  <br>
    <input type="number" name="pincode" id="pincode" placeholder="pincode" value="<?php echo $result['pincode'];?>" class="txt" /><br>
    <input type="submit" name="Add" class="button" value="Add" style="display: <?php echo $display_add_button;?>;">
    <input type="submit" name="update" class="button" value="update" style="display: <?php echo $display_update_button;?>;">
</form>
 <br>
</div>

<!-- validation -->

<script type="text/javascript" >
  $(document).ready(function () {
   
  $('#form1').validate({
    
            rules: {
                
                phone: {
                  required:true,
                  minlength:10,
                  maxlength:10
                    },
                address: {
                     required:true,
                    minlength:10
                    },
                city: {
                     required:true,
                    },
                state: {
                     required:true,
                       },
               district: {
                     required:true,
                       },
               country: {
                     required:true,
                       },
                pincode : {
                      required:true,
                      minlength:6,
                      maxlength:10
                     }                 
                    
                },
            messages: {

                phone: {
                    required: "phone number required",
                    minlength: "minimum length should be 10",
                    maxlength: "maximum length should be 10."
                      },
                address: {
                    required: "address required",
                    minlength: "minimum length should be 10"
                    
                      },
                city:{required: "city recquired"},
                state:{required:"state recquired"},
                district:{required:"district required"},
                country:{required:"country required"},
                pincode:{required:"pincode required",minlength:"minlength should be 6"}
               

            },
            submitHandler: function (form) { 
              form.submit();
                
            }
        });


    });
  

</script>
</body>
</html>