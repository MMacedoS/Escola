<?php
require "Control/conexao.php";

@session_start();
$code =$_SESSION['code'];
$senha =$_SESSION['senha'];
$nome =$_SESSION['nome'];
$painel =$_SESSION['painel'];

if ($code=='') {
    # code...
    echo "<script language='javascript'> window.location='../index.php';
     </script>";


} else if($nome==''){
    # code...
    echo "<script language='javascript'> window.location='../index.php'; </script>";

}else if($senha==''){
    echo "<script language='javascript'> window.location='../index.php'; </script>";

// }//else{
//    // if ($painel_atual !=$painel){
//      //           echo "<script language='javascript'> window.location='../login.php'; </script>";
//                 echo "<h2>Por favor , digite o numero do cartão ou código de acesso!</h2>";
//     }
 
}

?>
<?php 
    if(@$_GET['acao']=='quebra'){
        session_destroy();
        $_SESSION['code'];
        $_SESSION['senha'];
        $_SESSION['nome'];
        $_SESSION['painel'];
        echo "<script language='javascript'> window.location='index.php'; </script>";
    }
?>
