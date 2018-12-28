<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
</head>
<body>
 
    <?php 
    
    session_start();
    include 'connection.php';
     $_SESSION['message'] = '';
    
    
    
    if ($_SERVER['REQUEST_METHOD']== 'POST'){
        if(isset($_POST['newPass1'])){
        
            if($_POST['newPass1'] == $_POST['newPass2']){
            
                $username = $conn->real_escape_string($_POST['newUser']);
                $password = md5($_POST['newPass1']);
            
                $sql = "INSERT INTO accounts (username, password,firstTime,type) VALUES
                    ('$username','$password','1','0')"; 
            
                if($conn->query($sql) === true){
                    $_SESSION['message'] = "Registration successful! Please log in.";
                    header("location: login.php");
                }
                else{
                    $_SESSION['message'] = "User can not be added. Please try again with another";
            
                }
            }else{
                $_SESSION['message'] = "Two password does not match. Please try again";
            }
        }
    }
    ?>
    
    
    
    
    
    
     
    
  <form action= "register.php" method = "POST">
       <div><?= $_SESSION['message']?></div>    
       <br>  
       New Username: <input type="text" name = "newUser" >
      <br>
      Password: <input type = "text" name = "newPass1">
      <br>
      Confirm Password: <input type = "text" name = "newPass2">
      <br>
      <input type = "submit" value= "Register" name = "register">
      
      
      
  </form>
   
    <?php 
      if(isset($_POST['Submit'])){
          
          if ($_POST['newUser'] != "") {
            $_POST['newUser'] = filter_var($_POST['newUser'], FILTER_SANITIZE_STRING);
            if ($_POST['newUser'] == "") {
                $errors .= 'Please enter a valid name.<br/><br/>';
            }
        } else {
            $errors .= 'Username empty.<br/>';
        }
      }
      ?>
    
</body>
</html>