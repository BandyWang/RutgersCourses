<?php


//takes in c_#_#
//div id is d_c_#_#
function dropdownClasses($name){
    
   // echo "dd name: ".$name;
    $divName = "d".$name;

     echo "<div id = \"$divName\">";
    echo "<select >";
    echo "<option value = \"none\">Select</option>";
    echo "</select>";
      echo "</div>";
    
    
}
function buttonDeleteClass($name){
    echo "delete: ".$name;  
    echo "<form action= \"settingUp.php\" method = \"post\"  >   
                <input type = \"submit\" value = \"delete \" >     
                 <input type = \"hidden\" name = \"deleteClass\" value=\"$name\" >   
                </form>";
}
//ignore
function dropdownGrades($name){
    echo $name;
     $divName = "d".$name;
  
     echo "<div id = \"$divName\">";
    echo "<select >";
    echo "<option value = \"none\">Select</option>";
    echo "</select>";
      echo "</div>";
    
}

function addClass(){ 
   
    if(isset($_POST['anotherClass'])&& $_POST['anotherClass'] != "false" && $_POST['actual-submit'] == "false"){
        
        $x = 1;
        while(isset($_SESSION['classes'][$_POST['anotherClass']][$x])){
            $x++;    
        }
        $_SESSION['classes'][$_POST['anotherClass']][$x]= array(
            "classCode" => "new",
            "grade" => "new"
            );
        $_POST['anotherClass'] = "false";                
    } 
   
}

function deleteClass(){
   
    if(isset($_POST['deleteClass']) && $_POST['deleteClass'] != "false"){
           
        echo "post deleteClass value: ".$_POST['deleteClass'];
        $pieces = explode("_",$_POST['deleteClass']);
        $sem = $pieces[0];
        $class = $pieces[1];
        
        $x = 1;
        
         //x is the total number of sum
        while(isset($_SESSION['classes'][$sem][$x])){
            $x++;
        }
        $x--;
        

        if($class == '1' && !isset($_SESSION['classes'][$sem]['2'])){
            
            echo "<br> case two delete Class";
            unset($_SESSION['classes'][$sem][$class]);
            
            $a = $sem+1;
            $b = '1';
            while(isset($_SESSION['classes'][$a][$b])){
                $c = $a-1;
                echo "<br> shifiting $a _ $b to".$c."_$b"; 
                $_SESSION['classes'][$a -1][$b] = array(
                        "classCode" => $_SESSION['classes'][$a][$b]['classCode'],
                        "grade" => $_SESSION['classes'][$a][$b]['grade']
                );
               
                
                if(isset($_SESSION['classes'][$a][$b+1])){
                    $b++;
                }else{
                    unset($_SESSION['classes'][$a]);
                    $a++;
                    $b = '1';
                }
            }  
        }else{
            for($y = $class+1; $y <= $x; $y++ ){
            
            unset($_SESSION['classes'][$sem][$y-1]);
            $_SESSION['classes'][$sem][$y- 1] = array(
                                "classCode"=> $_SESSION['classes'][$sem][$y]['classCode'],
                                "grade" => $_SESSION['classes'][$sem][$y]['grade']
                );
            }
            
               unset($_SESSION['classes'][$sem][$x]);
        }
        //
        
        $_POST['deleteClass'] = "false";
        
        
    }
}

function addSem(){
    
    
    if(isset($_POST['anotherSem'])&& $_POST['anotherSem'] == "true"){
       $x = '1';
        while(isset($_SESSION['classes'][$x]['1'])){
            
            echo "<br> sem $x is set";
            $x++;
        }
        echo "<br> adding New semester: ".$x;
        $_SESSION['classes'][$x]['1'] = array(
            "classCode" => "new",
            "grade" => "new"
            );
        $_POST['anotherSem'] = "false";             
    } 
}

//add semester function
function submit($conn){
   
   
        if (isset($_POST['actual-submit'])&& $_POST['actual-submit'] != "false") {
            
            $semester = 1;
            $class = 1;
            $coordClass = "c_".$semester."_".$class; //"c 1 1"
            
             
            while(isset($_POST[$coordClass])){
               
                $username = $_SESSION['username'];
                $pieces = explode("_",$coordClass);
                $courseCode = $_POST[$coordClass]; //get the class code
                echo "<br> coordClass:". $coordClass;
             
                $query = "INSERT INTO gradecalculator (username, courseCode, sem, class) values (
                '$username','$courseCode','$pieces[1]','$pieces[2]')";
                
               /* if($conn->query($query) === true){
                    echo "S U C C";
                }
                else{
                   echo "U THOUGHT";
                }*/
                $class++;
                $coordClass = "c_".$semester."_".$class;
                
                if(!isset($_POST[$coordClass])){
                    $semester++;
                    $class = 1;
                    $coordClass = "c_".$semester."_".$class;   
                }       
            }
            
          
            $_POST['actual-submit'] = "false";
            
        }
    
}

function printAll(){
    $s = '1';
    $c = '1';
    echo "<br> All set arrays:";
    while(isset($_SESSION['classes'][$s][$c])){
       
        echo "<br> $s $c is set with classCode: ".$_SESSION['classes'][$s][$c]['classCode']." and grade: ".$_SESSION['classes'][$s][$c]['grade'];
        
        if(isset($_SESSION['classes'][$s][$c+1])){
            $c++;
            
        }else{
            $s++;
            $c='1';      
        }
        
        
        
    }
    
    
    
    
    
    
}

?>