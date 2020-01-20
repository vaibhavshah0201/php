<?php

if(1){
    echo "TRUE.";
}
else{
    echo "FAlse.";
}

if(0){
    echo "TRUE.";
}
else{
    echo "FAlse.";
}   

$data = array();
if($data){
    echo "TRUE.";
}
else{
    echo "FAlse.";
}

if("1" === 1){
    echo "True.";
}
else{
    echo "False";
}

?>

<!DOCTYPE html>
<html>
    <head></head>
    <body>

    <?php if(TRUE): ?>
        <input type="text" value="TRUE">
    <?php else: ?>
        <input type="text" value="FALE">
    <?php endif ?>
    </body>
</html>