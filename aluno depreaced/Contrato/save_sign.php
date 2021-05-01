<?php
$result = array();
$imagedata= base64_decode($_POST['img_data']);
$imagedata= $_POST['img_data'];
$filename =md5(date('dmYhisA'));



echo '<img src="'.$imagedata.'" alt="">';
?>


