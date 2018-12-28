<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    
    <select id='qty'>
<option value='1'>1</option>
<option value='2'>2</option>
<option value='3'>3</option>
<option value='4'>4</option>
<option value='5'>5</option>
<option value='6'>6</option>
<option value='7'>7</option>
<option value='8'>8</option>    
<option value='9'>9</option>
<option value='10'>10+</option>  
    
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>$('#qty').live('change', function () {
if ((this.value) == 10) {
    $(this).replaceWith($('<input/>', {
        'type': 'text',
            'value': +(this.value)
        }));
    }
});
       
        </script>
    
    
    
</body>
</html>