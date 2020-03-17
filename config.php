<?php
require_once "Control/conexao.php";

if(session_status()== PHP_SESSION_NONE){}
@session_start();
$code =$_SESSION['code'];
$senha =$_SESSION['senha'];
$nome =$_SESSION['nome'];
$painel =$_SESSION['painel'];

if (empty($code)) {
    # code...
    echo "<script language='javascript'> window.location='../index.php';
     </script>";
 session_destroy();

} else if(empty($nome)){
    # code...
    echo "<script language='javascript'> window.location='../index.php'; </script>";
         session_destroy();
}else if(empty($painel)){
     session_destroy();
    echo "<script language='javascript'> window.location='../index.php'; </script>";
}

    if ($painel_atual!=$painel){
                session_destroy();
               echo "<script language='javascript'> window.location='../index.php'; </script>";
                echo "<h2>Por favor , acesse novamente!</h2>";
    }


?>
<?php 
    if(@$_GET['acao']=='quebra'){
        session_destroy();
        $_SESSION['code'];
        $_SESSION['nome'];
        $_SESSION['painel'];
        echo "<script language='javascript'> window.location='index.php'; </script>";
    }
?>
