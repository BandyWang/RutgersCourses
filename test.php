
<?php

    $link = mysqli_connect("localhost","root","");
    mysqli_select_db($link,"bandydb") or die("not connected");

?>



<form action="" method= "post">
<table>
<tr>
<td>Select Major  </td>
<td><select id="major" onChange="change_course()">
<option>Select Major </option>    
<?php
$res=mysqli_query($link,"select * from majors");
while($row=mysqli_fetch_array($res)){

echo "<option value = \"".$row["code"]."\">".$row["major"]."</option>";
}
 ?>
</select></td>
</tr>   

<tr>
<td> Select Course</td>  
<td>
<div id="course">
    <select>
        <option>Select</option>
    </select>
</div>
</td>  
</tr> 
   
</table>
    
</form>



<script type = "text/javascript">
function change_course(){
    
    var xmlhttp= new XMLHttpRequest();
    xmlhttp.open("GET","ajaxTEST.php?major="+document.getElementById("major").value,false);
    xmlhttp.send(null);
    
    document.getElementById("course").innerHTML=xmlhttp.responseText;
   
}
    
    function change_state(){
        alert(document.getElementById("course").value);
    }

</script>
