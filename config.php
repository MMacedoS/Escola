
<?php 
date_default_timezone_set('America/Sao_Paulo');
    if(@$_GET['acao']=='quebra'){
        @session_start();
       $_SESSION['code']='';
       $_SESSION['nome']='';
       $_SESSION['painel']='';
       session_destroy();
       
        echo "<script language='javascript'> window.location='index.php'; </script>";
    }
?>
<?php
require_once "Control/conexao.php";




@session_start();
$code =$_SESSION['code'];
$nome =$_SESSION['nome'];
$painel =$_SESSION['painel'];

if($_SESSION['registro']){
$segundos= time() - $_SESSION['registro'];
}
if($segundos > $_SESSION['limite']){
    unset($_SESSION['code']);
    unset($_SESSION['nome']);
    unset($_SESSION['painel']);
    unset($_SESSION['limite']);
    unset($_SESSION['registro']);
    session_destroy();
//    echo "<script language='javascript'> window.location='../index.php?logout';
//      </script>";
header("Location: ../index.php?login=3");
    
}else{
    
    $_SESSION['registro']=time();
    }

if(session_status()==PHP_SESSION_NONE){
   session_destroy();
//    echo "<script language='javascript'> window.location='../index.php?login';
//      </script>";
header("Location: ../index.php?login=3");
    
}else{

if (empty($code)) {
    # code...
    // // echo "<script language='javascript'> window.location='../index.php?login';
    //  </script>";
    header("Location: ../index.php?login=4");
 session_destroy();

} else if(empty($nome)){
    # code...
    // echo "<script language='javascript'> window.location='../index.php?login'; </script>";
    header("Location: ../index.php?login=4");
         session_destroy();
}else if(empty($painel)){
     session_destroy();     
    // echo "<script language='javascript'> window.location='../index.php?login'; </script>";
    header("Location: ../index.php?login=4");
}else if ($painel_atual!=$painel){
                
            //    echo "<script language='javascript'> window.location='../index.php?erro'; </script>";
            header("Location: ../index.php?login=5");
                session_destroy();
    }
   

}
?>

