<?php
define('HOST','localhost');
define('BANCO','ist');
define('USUARIO','root');
define('SENHA','');
class  Conexao 
{
    private $conexaoSQL;
    private $charset;


    private function MontarConexao(){
        try {
            $this->charset=array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8');
            $this->conexaoSQL=new PDO("mysql:host=".HOST.";dbname=".BANCO.";",USUARIO,SENHA,$this->charset);
            $this->conexaoSQL->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

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
        return $this->conexaoSQL;
    }
}

?>