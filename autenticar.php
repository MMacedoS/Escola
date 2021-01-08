<!-- <?php 
require_once("Control/conexao.php");
@session_start();

if(empty($_POST['usuario']) || empty($_POST['senha'])){
	header("Location: index.php?login=0");
}

$usuario = $_POST['nome'];
$senha = $_POST['password'];


$res = $pdo->prepare("SELECT * from login where nome = :usuario and senha_rec = :senha and status=:status");

$res->bindValue(":usuario", $usuario);
$res->bindValue(":senha", md5($senha));
$res->bindValue(":status",'Ativo');
$res->execute();

$dados = $res->fetchAll(PDO::FETCH_ASSOC);
$linhas = count($dados);


if($senha==$dados[0]['senha']){
	if($linhas > 0){
	
		$_SESSION['code']=$dados[0]['code'];;
		$_SESSION['nome']=$dados[0]['nome'];
		$_SESSION['painel']=$dados[0]['painel'];
		$tempolimite=900;
		$_SESSION['registro']=time();
		$_SESSION['limite']=$tempolimite;
		
		switch ($_SESSION['painel']) {
			
				case 'admin':
				
					header("location:admin/index.php");
						break;
			
						case 'Aluno':
				
							// header("location:aluno/aluno.html");
							header("location:aluno/index.php");
				// 			header("location:man.html");
							
                                // session_destroy();
							
								break;
			
								case 'professor':
				
									header("location:professor/index.php");
									// header("location:man.html");
										break;
			
										case 'secretaria':
				
											header("location:secretaria/index.php");
												break;
												case 'financeiro':
				
													header("location:financeiro/index.php");
														break;

														case 'Coordenacao':
				
															header("location:coordenacao/index.php");
															// header("location:man.html");
																break;

																case 'tela':
				
																	header("location:site/index.php");
																		break;
											
			
			default:
				# code...
				break;
		}
				
	}else{
		// echo "<script language='javascript'>window.alert('Dados Incorretos!!'); </script>";
		// echo "<script language='javascript'>window.location='index.php?login'; </script>";
		header("Location: login.php?login=1");
		exit();
		
	} 
}else{
	// echo "<script language='javascript'>window.alert('Dados Incorretos!!'); </script>";
	// echo "<script language='javascript'>window.location='index.php?login'; </script>";
	header("Location: login.php?login=1");
	exit();
}



 ?>