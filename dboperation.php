<?php

    class DB_con
  {
     private $servername = "localhost";
      private  $username = "root";
      private  $password = "";
        private $dbname = "test";
       public $conn;
       function __construct()
        {
          try {
              $this->conn = new PDO("mysql:host=".$this->servername.";dbname=".$this->dbname."", $this->username, $this->password);
              $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
               }
               catch(PDOException $e) 
               {
                    echo "Error: " . $e->getMessage();
                  }

        }
        function verifyemail($email)
        {// chheck email already in database
            $stmt = $this->conn->prepare("SELECT * FROM customers WHERE email=:email");
            $stmt->bindParam(':email',$email); 
            $stmt->execute();
            $user = $stmt->fetch();
            if ($user) {
                return true;
              
            } else {
                // or not
              return false;
            } 
        }
        function admin_verifyemail($email)
        {// chheck email already in database
            $stmt = $this->conn->prepare("SELECT * FROM admin WHERE username=:email");
            $stmt->bindParam(':email',$email); 
            $stmt->execute();
            $user = $stmt->fetch();
            if ($user) {
                return true;
              
            } else {
                // or not
              return false;
            } 
        }
      function register($name,$lname,$email,$password)
       {    
         $result=$this->verifyemail($email);
           if(!$result)
            {    //$encpt = password_hash($password, PASSWORD_DEFAULT);
                 $sql="INSERT INTO customers (first_name,last_name,email,password) VALUES (:name,:lname,:email,:password)";
                 $encpt = password_hash($password, PASSWORD_DEFAULT);
                 if($stmt = $this->conn->prepare($sql))
                 {
                    
                  $stmt->bindParam(':name', $name, PDO::PARAM_STR);
                   $stmt->bindParam(':lname', $lname, PDO::PARAM_STR);
                  $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                   $stmt->bindParam(':password', $encpt);
                  $stmt->execute();
                  return true;
                }
              }
            else 
              return false;
                   

       }
        function admin_register($name,$email,$password)
       {    
         $result=$this->admin_verifyemail($email);
           if(!$result)
            {    $encpt = password_hash($password, PASSWORD_DEFAULT);
                 $sql="INSERT INTO admin (name,username,password) VALUES (:name,:username,:password)";
                 if($stmt = $this->conn->prepare($sql))
                 {
                    
                  $stmt->bindParam(':name', $name, PDO::PARAM_STR);
                  $stmt->bindParam(':username', $email, PDO::PARAM_STR);
                   $stmt->bindParam(':password', $encpt);
                  $stmt->execute();
                  return true;
                }
              }
            else 
              return false;
                   

       }
       function loginverify($email,$password)
       {
            $stmt = $this->conn->prepare("SELECT * FROM customers WHERE email=:email");
            $stmt->bindParam(':email',$email); 
            $stmt->execute();
             $user = $stmt->fetch(PDO::FETCH_ASSOC);
              
            if ($user) 
              {

              if (password_verify($password, $user['password']))
                  {
                 $_SESSION['userid']=$user['id'];
                 $_SESSION['username']=$user['first_name'];
                 $_SESSION['email']=$user['email'];
                 return true;
                  }
                else
                  return false;
              
               } else {
                // or not
              return false;
            } 
            
       }
        function admin_loginverify($email,$password)
       {
            $stmt = $this->conn->prepare("SELECT * FROM admin WHERE username=:email");
            $stmt->bindParam(':email',$email);
            $stmt->execute();
             $user = $stmt->fetch(PDO::FETCH_ASSOC);
              
            if ($user) 
            {

                  if (password_verify($password, $user['password']))
                  {

                     $_SESSION['adminid']=$user['id'];
                     $_SESSION['admin_name']=$user['name'];
                    return true;
                  }
                  else
                    return false;
              
            } 
            else {
                // or not
              return false;
            } 
            
       }
       function getdata($id)
         {  $stmt = $this->conn->prepare("SELECT * FROM customer_profile WHERE cust_id=:id");
            $stmt->bindParam(':id',$id);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user;
              

       }
        function getall_users()
         {  $stmt = $this->conn->prepare("SELECT * FROM customer_profile");
            
            $stmt->execute();
            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //print_r($user);
            return $user;      

       }

       function delete_userdata($id)
       {$stmt = $this->conn->prepare("DELETE  FROM customer_profile WHERE cust_id=:id");
            $stmt->bindParam(':id',$id);
            $stmt->execute();

       }
       function admin_delete_user($user_id)
       {$stmt = $this->conn->prepare("DELETE  FROM customers WHERE id=:id");
            $stmt->bindParam(':id',$user_id);
            $stmt->execute();
        $stmt = $this->conn->prepare("DELETE  FROM customer_profile WHERE cust_id=:id");
            $stmt->bindParam(':id',$user_id);
            $stmt->execute();
            

       }

      function add_data($data)
          { $id=$_SESSION['userid'];
            $sql="INSERT INTO customer_profile (cust_id,name,email,phone,address,city,state,district,country,pincode) VALUES (:cust_id,:name,:email,:phone,:address,:city,:state,:district,:country,:pincode) ";
             if($stmt = $this->conn->prepare($sql))
                 { 
                  $stmt->bindParam(':cust_id',$id, PDO::PARAM_STR);
                   $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
                   $stmt->bindParam(':email', $data['email'], PDO::PARAM_STR);
                   $stmt->bindParam(':phone', $data['phone']); 
                   $stmt->bindParam(':address', $data['address'], PDO::PARAM_STR);
                   $stmt->bindParam(':city', $data['city'],PDO::PARAM_STR);
                   $stmt->bindParam(':state', $data['state'],PDO::PARAM_STR);
                   $stmt->bindParam(':district', $data['district'],PDO::PARAM_STR);
                   $stmt->bindParam(':country', $data['country'],PDO::PARAM_STR);
                   $stmt->bindParam(':pincode', $data['pincode']);
                   $stmt->execute();
                   return true;
                  }  

         }
         function update_data($data)
          { $id=$_SESSION['userid'];

           $sql="UPDATE customer_profile SET email=:email, phone=:phone, address=:address, city=:city,state=:state,district=:district,country=:country,pincode=:pincode WHERE cust_id=:id ";
             if($stmt = $this->conn->prepare($sql))
                 {
                   
                   $stmt->bindParam(':email', $data['email'], PDO::PARAM_STR);
                   $stmt->bindParam(':phone', $data['phone']); 
                   $stmt->bindParam(':address', $data['address'], PDO::PARAM_STR);
                   $stmt->bindParam(':city', $data['city'],PDO::PARAM_STR);
                   $stmt->bindParam(':state', $data['state'],PDO::PARAM_STR);
                   $stmt->bindParam(':district', $data['district'],PDO::PARAM_STR);
                   $stmt->bindParam(':country', $data['country'],PDO::PARAM_STR);
                   $stmt->bindParam(':pincode', $data['pincode']);
                   $stmt->bindParam(':id', $id);
                   $stmt->execute();
                   return true;
                  } 
                  print_r($data['district']); 
         }
  
  }
  ?>      
