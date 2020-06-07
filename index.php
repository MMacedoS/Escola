
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistema Escolar</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
    <link rel="shortcut icon" href="image/logo_ist.gif">
    
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


    <?php require_once "Control/conexao.php"?>
</head>
<body>
<div id="logo">
 <img id="img" src="image/logo_ist.gif">   
</div>
<div id="caixa_login">
    <?php  if (isset($_POST['button'])) {
        // # code...
        // $nome=$_POST['nome'];
        //  $password=preg_replace('/[^[:alnum:]_]/', '',$_POST['password']);
        // if ($nome=="") {
        //     # code...
        //     echo "<h2>email de acesso invalido!</h2>";
        // } else if ($password==""){
        //     # code...
        //     echo "<h2>Por favor , digite a senha!</h2>";

        // }else {
        //     # code...
        //     $sql= "select * from login where nome= '$nome'
        //     and senha='$password'";

        //     $resultado=mysqli_query($conexao, $sql);
        //     if (mysqli_num_rows($resultado)>0) {

        //         # code...

        //         while($res_1=mysqli_fetch_assoc($resultado)){
        //             $status = $res_1['status'];
        //             $code =$res_1['code'];
        //             $senha =$res_1['senha'];
        //             $nome =$res_1['nome'];
        //             $painel =$res_1['painel'];

        //             if ($status == 'inativo'){
        //             echo "<h2> Você está inativo, procure a administração!! </h2>";

        //                 }else{
                            
        //                         # code...
        //                         session_start();
        //                         $_SESSION['code']=$code;
        //                         $_SESSION['nome']=$nome;
        //                         $_SESSION['painel']=$painel;
                
        //                         if($painel=='admin'){
        //                             echo "<script language='javascript'> window.location='admin'; </script>";
        //                         } else if($painel=='Aluno'){
        //                             echo "<script language='javascript'> window.location='aluno'; </script>";
                
        //                         }else if($painel=='professor'){
        //                             echo "<script language='javascript'> window.location='professor'; </script>";
                
        //                         }
        //                         else if($painel=='secretaria'){
        //                             echo "<script language='javascript'> window.location='secretaria'; </script>";
                
        //                         }
        //                         else if($painel=='tesouraria'){
        //                             echo "<script language='javascript'> window.location='tesouraria'; </script>";
                
        //                         }
                
                            
        //                 }

        //         }
               
        //     }else{
            ?>
               
            <?php
    //         } 
            
    //     }

        
    } 
    
    ?>
    <form name="form" action="autenticar.php" method="post">
        <table>
        <tr>
        <td> <h1>Email de Acesso</h1>
        </td>
        </tr>
        <tr>
        <td><input type="email" name="nome"></td>
        </tr>
        <tr>
        <td> <h1>Senha</h1>
        </td>
        </tr>
        <tr>
        <td><input type="password" name="password"></td>
        </tr>
        <tr>
        <td><input class="input"type="submit" name="button" value="Entrar"><p align="right"><a data-toggle="modal" data-target="#modal-senha" href="#">Esqueceu a senha? Recupere já!</a></p></td>
        	
        </tr>
        </table>
    </form>
</div>


</body>
</html>





<div class="modal fade" id="modal-senha" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title text-dark">Recuperar Senha</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post">
				<div class="modal-body">

					<div class="form-group">
						<label class="text-dark" for="exampleInputEmail1">Seu Email</label>
						<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtEmail">

					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
					<button name="recuperar-senha" type="submit" class="btn btn-primary">Recuperar</button>
				</div>
			</form>
		</div>
	</div>
</div>


<?php 
if(isset($_POST['recuperar-senha'])){
	$email_usuario = $_POST['txtEmail'];

	$res = $pdo->prepare("SELECT * from login where nome = :usuario");

	$res->bindValue(":usuario", $email_usuario);
	$res->execute();

	$dados = $res->fetchAll(PDO::FETCH_ASSOC);
	$linhas = count($dados);

	if($linhas > 0){
		$nome_usu = $dados[0]['nome'];
		$senha_usu = $dados[0]['senha'];
		$nivel_usu = $dados[0]['painel'];

	}else{
		echo "<script language='javascript'>window.alert('Este email não está cadastrado no sistema!'); </script>";
	}


	//AQUI VAI O CÓDIGO DE ENVIO DO EMAIL
	$to = $email_usuario;
	$subject = 'Recuperação de Senha SysMedical';

	$message = "

	Olá $nome_usu!! 
	<br><br> Sua senha é <b>$senha_usu </b>

	<br><br> Ir Para o Sistema -> <a href='$url_sistema'  target='_blank'> Clique Aqui </a>

	";

	$remetente = $email_adm;
	$headers = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8;' . "\r\n";
	$headers .= "From: " .$remetente;
	mail($to, $subject, $message, $headers);

	

	echo "<script language='javascript'>window.alert('Sua senha foi enviada no seu email, verifique no spam ou lixo eletrônico!!'); </script>";

	 echo "<script language='javascript'>window.location='index.php'; </script>";


}
?>