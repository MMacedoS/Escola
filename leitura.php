<?php

///capiturar 

$reqGet= filter_input(INPUT_GET, "file", FILTER_DEFAULT);

 function mostrar($filename,$filepath){
    header('Content-disposition: inline; filename={$filename}');
    header('Content-type: application/pdf');
    readfile($filepath);
 }
 switch ($reqGet) {
     case '1':
        $filename="regimento.pdf";
        $filepath="anexos/{$filename}";
        mostrar($filename,$filepath);
        break;
     
     
 }
?>