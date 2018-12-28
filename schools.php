<?php 
    header('Content-Type:application/json');

/*
    Converting query into json form for typeahead.js.
    Checking to see if query exists, return empty array */

if(!isset($_GET['query'])){
    echo json_encode([]);
    exit();
    
}

$db = new PDO('mysql:host=127.0.0.1;dbname=bandydb','root','');

$schools = $db->prepare("
    SELECT INSTNM FROM colleges WHERE INSTNM LIKE :query"
);

$schools->execute([
    'query' => "%{$_GET['query']}%"
]);

echo json_encode($schools->fetchAll());

?>
