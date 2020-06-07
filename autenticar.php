<!-- <?php 
require_once("Control/conexao.php");
@session_start();

if(empty($_POST['usuario']) || empty($_POST['senha'])){
	header("location:index.php");
}

$usuario = $_POST['nome'];
$senha = $_POST['password'];


$res = $pdo->prepare("SELECT * from login where nome = :usuario and senha_rec = :senha ");

$res->bindValue(":usuario", $usuario);
$res->bindValue(":senha", md5($senha));
$res->execute();

$dados = $res->fetchAll(PDO::FETCH_ASSOC);
$linhas = count($dados);



if($linhas > 0){
	
	$_SESSION['code']=$dados[0]['code'];;
    $_SESSION['nome']=$dados[0]['nome'];
    $_SESSION['painel']=$dados[0]['painel'];

	if($_SESSION['painel'] == 'admin'){
		header("location:admin/index.php");
		exit();
	}

	if($_SESSION['painel'] == 'Aluno'){
		header("location:aluno/index.php");
		exit();
	}

	if($_SESSION['painel'] == 'professor'){
		header("location:professor/index.php");
		exit();
	}

	if($_SESSION['painel'] == 'secretaria'){
		header("location:secretaria/index.php");
		exit();
	}


	if($_SESSION['painel'] == 'tesouraria'){
		header("location:tesouraria/index.php");
		exit();
	}



	if($_SESSION['painel'] == 'portaria'){
		header("location:portaria/tela.php");
		exit();
	}




	
}else{
	echo "<script language='javascript'>window.alert('Dados Incorretos!!'); </script>";
	echo "<script language='javascript'>window.location='index.php'; </script>";
	
} 


 ?>