
<?php require_once "Control/conexao.php"?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistema Escolar</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
    <link rel="shortcut icon" href="image/logo.png">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link href="css/login.css" rel="stylesheet" id="bootstrap-css">

	
<style>
	#retornar{
		background: #df4848 !important;
	}
</style>


</head>
<body>
<?php if(isset($_GET['login']) && $_GET['login']==0){ ?>

<p align="center" class="alert-danger">email ou senha sem preencher!</p>

<?php } ?>

<?php if(isset($_GET['login']) && $_GET['login']==1){ ?>

<p align="center"  class="alert-danger">Usuário ou senha inválida!</p>

<?php } ?>
<?php if(isset($_GET['login']) && $_GET['login']==3){ ?>

<p align="center"  class="alert-danger">Tempo de espera ultrapassado, tente logar novamente!</p>

<?php } ?>
<?php if(isset($_GET['login']) && $_GET['login']==4){ ?>

<p align="center"  class="alert-danger">Tente logar novamente!</p>

<?php } ?>
<?php if(isset($_GET['login']) && $_GET['login']==5){ ?>

<p align="center"  class="alert-danger">Você não possui permissão para acessar!</p>

<?php } ?>


<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<a href="index.php"><img src="image/img-01.png" alt="IMG" id="imagen">
					</a>
				</div>

				<form class="login100-form validate-form" action="autenticar.php" method="post">
					<span class="login100-form-title">
				<a href="index.php"><img src="image/logo.png" width="150" alt="IMG" id="imagen"></a>
					</span>

					<div class="wrap-input100 validate-input" data-validate = "email obrigatório: ex@abc.xyz">
						<input class="input100" type="text" name="nome" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "obrigatório possuir senha">
						<input class="input100" type="password" name="password" placeholder="senha">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Entrar
						</button>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							Esqueceu sua
						</span>
						<a class="txt2" data-toggle="modal" data-target="#modal-senha" href="#">
							senha?
						</a>
					</div>

				
				</form>
			</div>
		</div>
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
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
	<script src="js/login.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
document.getElementById('olho').addEventListener('mousedown', function() {
  document.getElementById('pass').type = 'text';
});
document.getElementById('olho_e').addEventListener('mousedown', function() {
  document.getElementById('pass_e').type = 'text';
});

document.getElementById('olho').addEventListener('mouseup', function() {
  document.getElementById('pass').type = 'password';
});
document.getElementById('olho_e').addEventListener('mouseup', function() {
  document.getElementById('pass_e').type = 'password';
});

// Para que o password não fique exposto apos mover a imagem.
document.getElementById('olho').addEventListener('mousemove', function() {
  document.getElementById('pass').type = 'password';
});
// Para que o password não fique exposto apos mover a imagem.
document.getElementById('olho_e').addEventListener('mousemove', function() {
  document.getElementById('pass_e').type = 'password';
});


</script>