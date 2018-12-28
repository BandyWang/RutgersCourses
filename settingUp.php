<!DOCTYPE html>
<html lang="en">
<head>
   
   
  
    <meta charset="UTF-8">
    <title>Setting Up</title>
</head>
<body>
    <?php include 'connection.php';
      $link = mysqli_connect("localhost","root","");
        mysqli_select_db($link,"bandydb") or die("not connected");
        include 'functions.php';
        session_start();
        //session_destroy();
        $_SESSION['username']= "bandy";
    
        
    //on startup
    if(!isset($_POST['anotherSem'])){
        $_POST['anotherSem'] = "false";
    }
    if(!isset($_POST['actual-submit'])){
        $_POST['actual-submit'] = "false";
    }
     if(!isset($_POST['deleteClass'])){
        $_POST['deleteClass'] = "false";
    }
    if(!isset($_SESSION['classes'])){
        session_destroy();
        session_start();
        $_SESSION['sem'] = 1;
        $_SESSION['totalClasses'] = 1;       
        $_SESSION['totalSem'] = 1;
        $_SESSION['classes']['1']['1'] =  array(
            "classCode" => "new",
            "grade" => "new"
            
            );

        }
    
        
    if($_SERVER['REQUEST_METHOD']== 'POST'){
        
        addClass();
        deleteClass();
        submit($conn);
        addSem();  
        printAll();
    }
    
    ?>
    
    <div>Hello. It seems like it is your first time logging in. Please enter your information regarding your acedemics.</div>
    
    <form action= "settingUp.php" method = "post">   
         <input type = "submit" value = "Add Semester" >     
         <input type = "hidden" name = "anotherSem" value= "true" >   
    </form>
   
   <br>
    <form action= "settingUp.php" method = "post">
         <?php
        $semCount = 1;
        while(isset($_SESSION['classes'][$semCount])){
            $semCount++;
        }
        echo"<br> TotalSem: ".$semCount." minus one";
        $s ='1';
        
        
         
        $c = '1';
        while(isset($_SESSION['classes'][$s][$c]) ){
            echo "<br>Semester $s is set.";
            echo "<table>";
            
            
                echo"<b> $s _ $c is set";
                $major= $s."_".$c;
                $course= "c_".$major;
                $grades = "g".$course;
                echo "<tr>";
                
                echo "<td>";
                 echo "|".$major."|";
                ?>
                
                
               
                <select id="<?php echo $major; ?>" name = '<?php echo $major; ?>' onChange="change_course('<?php echo $major; ?>')">
                <option value = "none">Select</option>    
                <?php
                    $res=mysqli_query($link,"select * from majors");
                        $isset = "false";
                        if($_SESSION['classes'][$s][$c]['classCode'] != "new"){
                            $isset = "true";
                        }
                        $selected = "none";
                        if($isset == "true"){
                            $pieces = explode(":",$_SESSION['classes'][$s][$c]['classCode']);
                            $selected = $pieces[1];
                            
                        }
                    
                    while($row=mysqli_fetch_array($res)){
                        echo "<option value = \"".$row["code"]."\"";
                        if($selected == $row["code"]){
                            echo " selected";
                        }  
                        echo ">".$row["major"]."</option>";
                }
                ?>
                </select>  
                
                
                 <?php
                echo "</td>";
                
                echo "<td>";
                dropdownClasses($course);
                echo "</td>";
                
                echo "<td>";
                dropdownGrades($grades);
                echo "</td>";
                
                echo "<td>";
                buttonDeleteClass($major);
                echo "</td>";
                ?>
            <script src="jquery-3.3.1.min.js"></script>
            <script>
                alert("hehllo");
                var major = <?php echo $major; ?>;
                alert(major);
                var element = document.getElementById(major);
                var event = new Event('change');
                element.dispatchEvent(event);
                
            </script>
            
            
            
            <?php
           if(isset($_SESSION['classes'][$s][$c+1])){
                echo "</tr>";
               $c++;
           }else{
               
                echo "<td>";
              
                echo "<form action= \"settingUp.php\" method = \"post\">   
                <input type = \"submit\" value = \"Add Class\" >     
                <input type = \"hidden\" name = \"anotherClass\" value=".$s." >  
                <input type =\"hidden\" name =\"deleteClass\" value = \"false\">
                </form>";
                  echo "</td>";
               
                echo "</tr>";
                $s++;
               $c = '1';
           }
            
          
        
            echo "</table>";
             
            echo "<br>";
       
        }
        
           
        //======================================================
        echo "<br>";
        ?>
            
            
            
                <form action = "settingUp.php" method = "post">
                <input type = "submit" name="actual-submit" value = "Submit">
                <input type = "hidden" name = "deleteClass" value = "false">
            </form>
    </form>
    
    
    
    <!-- maybe change id/name -->
    <script type = "text/javascript">
        function change_course(name){
            
            var xmlhttp= new XMLHttpRequest();
            xmlhttp.open("GET","ajax2.php?major="+document.getElementById(name).value+"&dropdown=c_"+name+"&grade=none",false);
            xmlhttp.send(null);
            var returnId = "dc_"+ name;
          
            document.getElementById(returnId).innerHTML=xmlhttp.responseText;
   
        }
        function add_grades(name){
            var xmlhttp= new XMLHttpRequest();
            
            
            //alert(document.getElementById(name).value);
            xmlhttp.open("GET","ajax2.php?major=null&dropdown=g"+name+"&classCode="+document.getElementById(name).value+"&grade=none",false);
            xmlhttp.send(null);
       
            var returnId = "dg"+ name;
            
            document.getElementById(returnId).innerHTML=xmlhttp.responseText;
            
        }
        
        function submit_grades(name){
            var xmlhttp= new XMLHttpRequest();
          
           
            xmlhttp.open("GET","ajax2.php?dropdown="+name+"&grade="+document.getElementById(name).value,false);
            xmlhttp.send(null);
            
        }
        

    </script>
</body>
</html>