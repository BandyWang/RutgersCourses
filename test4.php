<?php

    $link = mysqli_connect("localhost","root","");
    mysqli_select_db($link,"bandydb") or die("not connected");
//13:17 stop
?>




<form name ="form1" action="" method="post">
<table>
<tr>
<td>Select Country</td>
<td><select id = "countrydd" onChange = "change_country()">
<option>Select</option>   
<?php
$res=mysqli_query($link,"select * from majors");
while($row=mysqli_fetch_array($res)){

echo "<option value = \"".$row["code"]."\">".$row["major"]."</option>";
}
 ?>
</select>
</td>
</tr>        

<tr>
<td>Select State</td>
<td>
<div id = "state">
<select>
<option>Select</option>    
</select>    
</div>
</td>
</tr>


<tr>
<td>Select City</td>
<td>
<div id = "city">
<select>
<option>Select</option>    
</select>    
</div>
</td>
</tr>



</table>
    
    
    
    
</form>
<script>
function change_country(){
    var xmlhttp= new XMLHttpRequest();
    xmlhttp.open("GET","ajax4.php?country="+document.getElementById("countrydd").value,false);
    xmlhttp.send(null);
    document.getElementById("state").innerHTML=xmlhttp.responseText;
}
    
    function change_state(){
        alert(document.getElementById('statedd').value);
    }
</script>