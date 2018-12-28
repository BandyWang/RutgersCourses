<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
   <?php
        session_start();
        include 'connection.php'; 
            $_SESSION['errorUser'] = '';
            $_SESSION['errorPass'] = '';
       
        if(isset($_SESSION['message'])){
            
      
        }else{
             $_SESSION['message'] = ''; 
        }
    
    
    
      if($_SERVER['REQUEST_METHOD']== 'POST'){
          
         if(ctype_space($_POST['username'])|| $_POST['username'] == "" ||$_POST['password'] ==""||ctype_space($_POST['username'])){
                 if(ctype_space($_POST['username'])||$_POST['username'] == ""){
                     $_SESSION['errorUser'] = "Username field is requird.";
                 }
                  if(ctype_space($_POST['password'])||$_POST['password'] == ""){
                      $_SESSION['errorPass'] = "Password field is requird.";
                  }
         }else{
             $password= md5($_POST['password']);
             $username = $_POST['username'];
             $query = "SELECT * FROM accounts where username = ".$username;
             $result = $conn->query($query);
             if($result->num_rows != 0){
                $row = mysqli_fetch_assoc($result);
                 if($row['password'] == $password){
                     $_SESSION["errorUser"] = 'nice';
                     $_SESSION["user"] = $_SESSION['username'];
                 }else{
                    $_SESSION["errorUser"] =   "The password you entered is incorrect. Please try again.";
                 }
             }else{
                 $_SESSION["errorUser"] = "The username you have entered does not belong to any account. Please try again.";
           
             
             }
             
         }
        
    
     
     }
    
    ?>
    <form action= "login.php" method = "post">
       <div ><?php echo $_SESSION['message']; $_SESSION['message'] ="";?> </div>
       <div><?=$_SESSION['errorUser']?></div>
       Username:<input type = "text" name = "username">
       
       <div><?=$_SESSION['errorPass']?></div>
       Password: <input type = "text" name = "password">
       <br>
       <input type= "submit" value = "Login">    
    </form>

   
       
         <form action= "register.php" method ="post">
        <input type ="submit" value = "Register">        
        
    </form>
    
    
</body>
</html>