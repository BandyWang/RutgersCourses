<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
   <?php 
        include "connection.php";
    
    
    if ($_SERVER['REQUEST_METHOD']== 'POST'){
        $courseCode = $_POST['courseCode'];
        $classCode = $_POST['classCode'];
        $courseName = $_POST['courseName'];
        $descript = $_POST['descript'];
        $credit = $_POST['credits'];
        
       $sql = "INSERT into classes (courseCode, classCode, courseName, major,description,credits) values ('$courseCode','$classCode','$courseName','119','$descript','$credit')";
        
       if($conn->query($sql) === true){
        echo "Updated: ".$classCode.". Name: ".$courseName." with description ".$descript;
        
            }
        else{
            echo  "fail";
            
                }
    
    }
    
    ?>
   
   
   
   
   <form method = "post" action = "dataEntry.php"   >
      courseCode:<input type = "text" name = "courseCode"   >
       <br>  
       classCode:<input type = "text" name = "classCode"  >
       <br>
       courseName:<input type = "text" name = "courseName">
       <br> 
       descript:<input type = "text" name = "descript">
       <br> 
       credit: <input type = "text" name ="credits">
        <input type = "submit" value = "submit">
     </form>
    
</body>
</html>