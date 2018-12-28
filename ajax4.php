<?php

    $link = mysqli_connect("localhost","root","");
    mysqli_select_db($link,"bandydb") or die("not connected");

    $country = $_GET['country'];
    if($country !=""){  
        $res = mysqli_query($link,"select * from classes where major=$country");
        echo "<select id ='statedd' onChange='change_state()'>";
        while($row = mysqli_fetch_array($res)){
            echo"<option value = \"".$row["courseCode"]."\">".$row["classCode"]." | ".$row["courseName"]."</option>"; 
        }
        echo "</select>";
    }
    
?>
