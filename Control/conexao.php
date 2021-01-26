
<?php
setlocale(LC_ALL,'pt_BR.utf8');
date_default_timezone_set('America/Sao_Paulo');
function connectar(){
    $servidor ="localhost";
    $usuario="root";
    $senha="";
    $banco="escolaist";

	$con= new mysqli($servidor,$usuario,$senha,$banco);
	$con->set_charset("utf8");
    return $con;
}
$conexao=connectar();

//DADOS PARA CONEXÃO COM BANCO DE DADOS LOCAL

$host = 'localhost';
$usuario ='root';
$senha = '';
$banco = 'escolaist';




//VALORES PARA A COMBOBOX DE PAGINAÇÃO
$opcao1 = 8;
$opcao2 = 16;
$opcao3 = 50;


//VARIAVEL PARA DEFINIR O CAMINHO DO SISTEMA

$url_sistema = 'https://www.escolaisttucano.com.br';


$email_adm = 'contato@escolaisttucano.com.br';

$cidade = 'Bahia';


$nivel_estoque = 5;
$itens_tela = 6;
$tempo_atualizacao_tela = 15;
$tempo_atualizacao_tela_chamadas = 3;

date_default_timezone_set('America/Sao_Paulo');

try {
    $dsn="mysql:host=$host;dbname=$banco;charset=utf8";
    $opcoes=array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES UTF8');
    $pdo=new PDO($dsn,$usuario,$senha,$opcoes);
    // $pdo = new PDO("mysql:dbname=$banco;host=$host", "$usuario", "$senha");
// 	$pdo->set_charset("utf8");

	//conexao mysql para o backyp
	$conn = mysqli_connect($host, $usuario, $senha, $banco);
} catch (Exception $e) {
	echo "Erro ao conectar com o banco de dados! ".$e;
}
?>
<?php 
///envioar email 
function enviar($to,$acesso){
    $url_sistema = 'https://escolaisttucano.com.br';
    $email_adm = 'contato@escolaisttucano.com.br';
	$subject = 'Acesso ao Novo Sistema de notas do  Ist';

	$message = "

	Olá $to!! 
	<br><br> Sua senha é <b>$acesso </b>
	<br>Para acessar o sistema utilize esta senha como esta ai acima, para alterar a senha acesse o sistema.
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


<?php
define('SERVIDOR','localhost');
define('BANCO','escolaist');
define('USUARIO','root');
define('SENHA','');

class Conexao{

    private $conexaoSQL;
    private $charset;


    private function MontarConexao(){
        try {
            $this->charset=array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8');
            $this->pdo=new PDO("mysql:host=".SERVIDOR.";dbname=".BANCO.";",USUARIO,SENHA,$this->charset);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $th) {
            die("ERRO: #".$th->getCode()."<br>
            Mensagem:".$th->getMessage()."<br>
            No Arquivo:".$th->getFile()."<br>
            Na linha:".$th->getLine());
            //throw $th;
        }
    }

    public function ExecutaConexao(){
        $this->MontarConexao();
        return $this->pdo;
    }
}