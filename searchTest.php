<html>
 
 
 
<head>
 
   <title>Live Search using AJAX</title>
 
   <!-- Including jQuery is required. -->
 
   <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
 
   <!-- Including our scripting file. -->
 
   <script type="text/javascript" src="script.js"></script>
 
   <!-- Including CSS file. -->
 
   <link rel="stylesheet" type="text/css" href="style.css">
 
</head>
 
 
 
<body>
 
<!-- Search box. -->
 
   
   
   
    <form action="collegeInfo.php" method="get">
        <input type="text" name= "search" id="search" autocomplete="off"  placeholder="Enter School" > 
        <input type= "submit" value= ">>">
    </form>
 
   <br>
 
 
 
   <br />
 
   <!-- Suggestions will be displayed in below div. -->
 
   <div id="display"></div>
 
 
 
</body>
 
 
 
</html>