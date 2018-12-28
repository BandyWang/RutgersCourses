<?php           
   session_start();
    $link = mysqli_connect("localhost","root","");
    mysqli_select_db($link,"bandydb");
    $major = $_GET["major"];
    $grade = $_GET["grade"];
    $dropdown= $_GET["dropdown"];
    printf("grade: %s\n",$grade);
    printf("major: %s\n",$major);
    printf(" dropdown:%s",$_GET["dropdown"]);
    $p = explode("_",$dropdown);

   
    $query = "select * from classes where major=$major";
  
    //takes in gc_#_# input and gpa grade.
    if($grade != "none"){
        $pieces=explode("_",$dropdown);
        $_SESSION['classes'][$pieces[1]][$pieces[2]]['grade'] = $grade;
        
        
        
    //this is for grade dropdown and we are saving the value of the classCode into session superclass.
    //returns "gc_#_#" dropdown.
    }else if($major == "null"){
        $classCode = $_GET["classCode"];
    
      
        //$dropdown is in form of "c_#_#".
        $pieces = explode("_",$dropdown);
        $_SESSION['classes'][$pieces[1]][$pieces[2]]['classCode'] = $classCode;
        
        //onChange = \"submit_grades('$dropdown')\"
        echo "<select id= \"$dropdown\" onChange = \"submit_grades('$dropdown')\"  >";
        echo "<option value=\"\">Select grade</option>";
        echo "<option value=\"4.0\">A</option>";
        echo "<option value=\"3.50\">B+</option>"; 
        echo "<option value=\"3.00\">B</option>"; 
        echo "<option value=\"2.50\">C+</option>";
        echo "<option value=\"2.00\">C</option>";
        echo "<option value=\"1.00\">D</option>";
        echo "<option value=\"0.00\">F</option>";
        echo "<option value=\"P\">P</option>";
        echo "<option value=\"NP\">NP</option>";
        echo "</select>";
        
        
        
    }
    //returns a dd id c_#_#
    else if($major != ""){
        $res = mysqli_query($link,$query);
        if (!$res) {
            printf("Error: %s\n", mysqli_error($link));
            exit();
        }
        // I TOOK OUT ID=DROPDOWN FROM HERE
        $isset = "false";
        if($_SESSION['classes'][$p[1]][$p[2]]['classCode'] != "new"){
            $isset = "true";
        }
        $selected = "none";
        if($isset == "true"){
            $selected= $_SESSION['classes'][$p[1]][$p[2]]['classCode'];                            
        }
        
        printf("selected: %s\n",$selected);
        
        
        
        echo "<select id = \"$dropdown\" onChange = \"add_grades('$dropdown')\">";
        echo "<option value =\"\">Select class</option>";
        while($row = mysqli_fetch_array($res)){
            echo "<option value = \"".$row["courseCode"]."\"";
            if($selected == $row["courseCode"]){
                echo " selected";
            }
            echo ">".$row["classCode"]." | ".$row["courseName"]."</option>"; 
        }
        echo "</select>";
    }
?>