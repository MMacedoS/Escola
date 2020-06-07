<?php

function connectar(){
    // $servidor ="mysql873.umbler.com";
    // $usuario="kamaur";
    // $senha="kamaur2711";
    // $banco="ist";
$servidor = 'mysql669.umbler.com';
$usuario = 'ist';
$senha = 'kamaur2711';
$banco = 'escolaist';

    $con= new mysqli($servidor,$usuario,$senha,$banco);
    return $con;
}
$conexao=connectar();

//DADOS PARA CONEXÃO COM BANCO DE DADOS LOCAL

$host = 'mysql669.umbler.com';
$usuario = 'ist';
$senha = 'kamaur2711';
$banco = 'escolaist';


//DADOS PARA CONEXÃO COM BANCO DE DADOS HOSPEDADA

// $host = 'mysql669.umbler.com';
// $usuario = 'garradeaguia';
// $senha = 'kamaur2711';
// $banco = 'sismed';


//VALORES PARA A COMBOBOX DE PAGINAÇÃO
$opcao1 = 5;
$opcao2 = 8;
$opcao3 = 10;


//VARIAVEL PARA DEFINIR O CAMINHO DO SISTEMA
// $url_sistema = 'http://sistemapdvteste-com-br.umbler.net';
$url_sistema = 'https://escolaisttucano.com.br';
// $url_sistema = 'http://garradeaguia-com-br.umbler.net';

$email_adm = 'adm@escolaisttucano.com.br';

$cidade = 'Bahia';


$nivel_estoque = 5;
$itens_tela = 6;
$tempo_atualizacao_tela = 15;
$tempo_atualizacao_tela_chamadas = 3;

date_default_timezone_set('America/Sao_Paulo');

try {
	$pdo = new PDO("mysql:dbname=$banco;host=$host", "$usuario", "$senha");

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