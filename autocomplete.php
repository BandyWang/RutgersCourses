<?php
    include_once("connection.php");

$result = mysqli_select_db($conn,$db);

if (isset($_REQUEST['query'])) {
    $query = $_REQUEST['query'];
    $sql = mysql_query ("SELECT INSTNM FROM colleges WHERE INSTNM LIKE '%{$query}%' ");
	$array = array();
    while ($row = mysql_fetch_array($sql)) {
        $array[] = $row['INSTNM'];
    }

    echo json_encode($array);
}
?>