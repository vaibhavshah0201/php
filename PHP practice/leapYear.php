<?php
$yearValue = '';
if(isset($_POST['txtYear']) && !empty($_POST['txtYear'])) {
   $yearValue = $_POST['txtYear'];
   if($yearValue % 4 == 0) {
       echo "$yearValue is a leap year";
   } else { 
       echo "$yearValue is not a leap year";
   }
}
?>
<!DOCTYPE html>
<head>
</head>
<body>
    <form method='POST'>
        <input type='text' name='txtYear' value="<?php echo $yearValue;?>" placeholder='Enter Year '>
        <input type='submit'>
    </form>
</body>