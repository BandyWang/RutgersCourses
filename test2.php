<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
      
      
    
      <?php $three = "ani_2_3";
      ?>
    <form action="test2.php" method="post">
       <select name='ani_2_2'>
           <option Value="1">one</option>
            <option Value="2">two</option>    
      </select>   
      
      <select name="<?php echo $three ?>">
           <option Value="3">three</option>
            <option Value="4">four</option>    
      </select>  
      
        
        
      
          <input type="submit" name ="acc" value="click me">
   </form>
       
   
   <?php 
        if(isset($_POST["acc"])){
            echo "1 is: ";
            echo $_POST["ani_2_2"]."<br>";
            echo "2 is: ".$_POST["ani_2_3"];
          
        }else{
            echo "not posted";
        }
      
      ?>
      
   
    
</body>
</html>