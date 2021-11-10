<?php

$chars = "ABCDEFGHIJKLMMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
$shfl = str_shuffle($chars);
$final = substr($shfl, 55);
mkdir($final);

$finalpath = $final . '/' . $_FILES['uploaded-file']['name'];

$s = scandir("heads");

for($i = 0; $i < 8; $i++) {
    
    if($s[$i] == $_FILES['uploaded-file']['name']) {
        unlink($s[$i]);
        move_uploaded_file($_FILES['uploaded-file']['tmp_name'], $finalpath);
    }
    
    else {
        move_uploaded_file($_FILES['uploaded-file']['tmp_name'], $finalpath);
    }
    
}

header("Location: http://harveycoombs.com/cynohost/".$finalpath);

?>