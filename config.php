<?php
require_once "Control/conexao.php";
@session_start();
$code =$_SESSION['code'];
$nome =$_SESSION['nome'];
$painel =$_SESSION['painel'];

if(session_status()==PHP_SESSION_NONE){
   session_destroy();
   echo "<script language='javascript'> window.location='../index.php';
     </script>";
    
}else{

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
}else if ($painel_atual!=$painel){
                
               echo "<script language='javascript'> window.location='../index.php'; </script>";
                echo "<h2>Por favor , acesse novamente!</h2>";
                session_destroy();
    }

}
?>
<?php 
    if(@$_GET['acao']=='quebra'){
        
        session_destroy();
        $code =$_SESSION['code'];
        $nome =$_SESSION['nome'];
        $painel =$_SESSION['painel'];
        echo "<script language='javascript'> window.location='../index.php'; </script>";
    }
?>
