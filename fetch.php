<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "", "bandydb") or die("cannot connect");
$request = mysqli_real_escape_string($connect, $_POST["query"]);
$query = "
 SELECT *INSTNM FROM colleges WHERE INSTNM LIKE '%".$request."%'
";

$result = mysqli_query($connect, $query);

$data = array();

if(mysqli_num_rows($result) > 0)
{
 while($row = mysqli_fetch_assoc($result))
 {
  $data[] = $row["INSTNM"];
 }
 echo json_encode($data);
}

?>
