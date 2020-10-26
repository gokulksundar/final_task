<?php
include('dboperation.php');
  $con=new DB_con();
   if(isset($_POST['register']))
  {
    
    //print_r($_POST);
   $name=$_POST['admin_name'];
   $email=$_POST['email'];
   $password=$_POST['password'];
   $con=new DB_con();
   $result=$con->admin_register($name,$email,$password);
   if($result)
   {
    
    header("Location: admin_login.php");
   }
   else
   {
   echo "<script type='text/javascript'>  alert('Email already exists!'); </script>";
     
   }
 }
?>
<!DOCTYPE html>
<html>
<head>
<script src="http://code.jquery.com/jquery-1.8.3.min.js" type="text/javascript"></script>

<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
<form name="form1" id="form1" method="post" action="#">
<div class="box">
<h1>Admin registration</h1>
<input type="text" name="admin_name" id="admin_name"  placeholder="admin name" class="txt" />
<input type="email" name="email" id="email"  placeholder="Email" class="txt" />
  
<input type="password" name="password" id="password" placeholder="password" class="txt" />
<input type="password" name="con_password" id="con_password" placeholder="password" class="txt" /><br>
<input type="checkbox" id="terms" name="terms" >
  <label for="terms"> I agree with terms and conditions</label><br>
<input type="submit" name="register" class="btn2" value="sign up">


  
</div> <!-- End Box -->
  
</form>
<script type="text/javascript" >
  $(document).ready(function () {
   
  $('#form1').validate({
    
            rules: {
                admin_name: {
                    required: true,
                    minlength: 6
                       },
               
                email: {
                    required: true,
                    email:true
                      },
                password: {
                  required:true,
                  minlength:8,
                  maxlength:10
                    },
                con_password: {
                    minlength:8,
                    maxlength:10,
                    equalTo :'#password'
                    },
                terms :{
                   required:true
                   }
                    
                },
            messages: {

               admin_name: {
                    required: "name required",
                    minlength: "minimum length should be 6",
                    maxlength: "maximum length should be 15."
                      },
                

                email: {
                    required: "Enter valid mail address",
                    email:true
                    
                      },
          
                password: {
                    required: "password required",
                    minlength: "minimum length should be 8",
                   
                     },
                con_password:
                {
                   required: "password required",
                    minlength: "minimum length should be 8",
                },
                terms:
                {
                  required: "please agree terms and conditions"
                }

            },
            submitHandler: function (form) { 
              form.submit();
                
            }
        });


    });
  

</script>

</body>
</html>