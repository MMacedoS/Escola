<?php
require_once "Control/conexao.php";


	function verifica_dados($conexao){
        
		if(isset($_POST['env']) && isset($_POST['painel']) && $_POST['env'] == "form"){
            switch ($_POST['painel']) {
                case 'Aluno':
                    $email = addslashes($_POST['email']);
                    $sql = "SELECT * FROM estudantes WHERE email = '$email'";
                    $sql=mysqli_query($conexao,$sql);
                    $total =mysqli_num_rows($sql);

                    if($total > 0){
                        add_dados_recover($conexao, $email);
                    }else{
                        echo "<script>alert('dados Invalidos');</script>";
                    }
                    break;
                    case 'professor':
                        # code...
                        break;
                        case 'coordenacao':
                            # code...
                            break;
                            case 'secretaria':
                                # code...
                                break;
                                case 'financeiro':
                                    # code...
                                    break;
                                                        
                default:
                    # code...
                    break;
            }
			
		}
	}

	function add_dados_recover($con, $email){
		$rash = md5(rand());
		$sql = $con->prepare("INSERT INTO recover_solicitation (email, rash) VALUES (?, ?)");
		$sql->bind_param("ss", $email, $rash);
		$sql->execute();

		if($sql->affected_rows > 0){
			enviar_email($con, $email, $rash);
		}
	}

	function enviar_email($con, $email, $rash){
        $sitedir="localhost/SistemaCopia/";
		$destinatario = $email;

		$subject = "RECUPERAR SENHA";
		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
		$message = "<html><head>";
		$message .= "
			<h2>Você solicitou uma nova senha?</h2>
			<hr>
			<h3>Se sim, aqui está o link para você recuperar a sua senha:</h3>
			<p>Para recuperar sua senha, acesse este link: <a href='".$sitedir."alterar.php?rash={$rash}'>".$sitedir."alterar.php?rash={$rash}</a></p>
			<hr>
			<h5>Não foi você quem solicitou? Se não ignore este email, porém alguém tentou alterar seus dados.</h5>
			<hr>
			Atenciosamente, Tutoriais e Informática.
		";

		$message .="</head></html>";

		if(mail($destinatario, $subject, $message, $headers)){
			echo "<div class='alert alert-success'>Os dados foram enviados para o seu email. Acesse para recuperar.</div>";
		}else{
			echo "<div class='alert alert-danger'>Erro ao enviar</div>";
		}
	}

	function verifica_rash($con, $rash){
		$sql = $con->prepare("SELECT * FROM recover_solicitation WHERE rash = ? AND status = 0");
		$sql->bind_param("s", $rash);
		$sql->execute();
		$get = $sql->get_result();
		$total = $get->num_rows;

		if($total > 0){
			if(isset($_POST['env']) && $_POST['env'] == "upd"){
			$nsenha = addslashes(md5($_POST['senha']));
			
			$dados = $get->fetch_assoc();
			atualiza_senha($con, $dados['email'], $nsenha);
			deleta_rashs($con, $dados['email']);
			echo "<br><div class='alert alert-success'>Senha alterada com sucesso.</div>";
			redireciona("?pagina=inicio");
			}
		}else{
			echo "<br><div class='alert alert-danger'>Rash inválida.</div>";
		}
	}

	function atualiza_senha($con, $email, $senha){
		$sql = $con->prepare("UPDATE usuarios SET senha = ? WHERE email = ?");
		$sql->bind_param("ss", $senha, $email);
		$sql->execute();

		if($sql->affected_rows > 0){
			return true;
		}else{
			return false;
		}
	}

	function deleta_rashs($con, $email){
		$sql = $con->prepare("DELETE FROM recover_solicitation WHERE email = ?");
		$sql->bind_param("s", $email);
		$sql->execute();

		if($sql->affected_rows > 0){
			return true;
		}else{
			echo $con->error;
		}
	}

	function redireciona($dir){
		echo "<meta http-equiv='refresh' content='3; url={$dir}'>";
	}

?>