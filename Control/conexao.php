<meta charset="utf-8">
<?php
header('Content-Type: text/html; charset=UTF-8');
date_default_timezone_set('America/Sao_Paulo');
function connectar(){
    $servidor ="mysql873.umbler.com";
    $usuario="kamaur";
    $senha="kamaur2711";
    $banco="ist";
// $servidor = 'localhost';
// $usuario = 'root';
// $senha = '';
// $banco = 'ist';

	$con= new mysqli($servidor,$usuario,$senha,$banco);
	$con->set_charset("utf8");
    return $con;
}
$conexao=connectar();


//DADOS PARA CONEXÃO COM BANCO DE DADOS LOCAL

// $host = 'localhost';
// $usuario = 'root';
// $senha = '';
// $banco = 'ist';


//DADOS PARA CONEXÃO COM BANCO DE DADOS HOSPEDADA

$host = 'mysql669.umbler.com';
$usuario = 'garradeaguia';
$senha = 'kamaur2711';
$banco = 'sismed';


//VALORES PARA A COMBOBOX DE PAGINAÇÃO
$opcao1 = 5;
$opcao2 = 8;
$opcao3 = 10;


//VARIAVEL PARA DEFINIR O CAMINHO DO SISTEMA
// $url_sistema = 'http://sistemapdvteste-com-br.umbler.net';
$url_sistema = 'http://mmsescolar.com.br';
// $url_sistema = 'http://garradeaguia-com-br.umbler.net';

$email_adm = 'mauricio.jorro@hotmail.com';

$cidade = 'Bahia';


$nivel_estoque = 5;
$itens_tela = 6;
$tempo_atualizacao_tela = 15;
$tempo_atualizacao_tela_chamadas = 3;

date_default_timezone_set('America/Sao_Paulo');

try {
	$pdo = new PDO("mysql:dbname=$banco;host=$host", "$usuario", "$senha",array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));
	
	//conexao mysql para o backyp
	$conn = mysqli_connect($host, $usuario, $senha, $banco);
} catch (Exception $e) {
	echo "Erro ao conectar com o banco de dados! ".$e;
}
?>
<?php 
///envioar email 
function enviar($to,$acesso){
    $url_sistema = 'http://mmsescolar.com.br';
    $email_adm = 'mauricio.jorro@hotmail.com';
	$subject = 'Acesso de Senha Ist';

	$message = "

	Olá $to!! 
	<br><br> Sua senha é <b>$acesso </b>

	<br><br> Ir Para o Sistema -> <a href='$url_sistema'  target='_blank'> Clique Aqui </a>

	";

	$remetente = $email_adm;
	$headers = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8;' . "\r\n";
	$headers .= "From: " .$remetente;
	mail($to, $subject, $message, $headers);

	

	echo "<script language='javascript'>window.alert('Sua senha foi enviada no seu email, verifique no spam ou lixo eletrônico!!'); </script>";
    
    return true;
}?>