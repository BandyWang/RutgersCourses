<?php           
    $link = mysqli_connect("localhost","root","");
    mysqli_select_db($link,"bandydb");
    $major = $_GET["major"];
  //  $dropdown= $_GET["dropdown"];
    printf("major: %s\n",$major);
    //printf(" dropdown:%s",$_GET["dropdown"]);

   
    $query = "select * from classes where major=$major";
  


    if($major != ""){
        $res = mysqli_query($link,$query);
        if (!$res) {
            printf("Error: %s\n", mysqli_error($link));
            exit();
        }
        // I TOOK OUT ID=DROPDOWN FROM HERE
        // only select here
        echo "<select id = \"course\" onChange = 'change_state()'>";
        echo "<option value =\"none\">Select class</option>";
        while($row = mysqli_fetch_array($res)){
            echo"<option value = \"".$row["courseCode"]."\">".$row["classCode"]." | ".$row["courseName"]."</option>"; 
        }
        echo "</select>";
    }
?>