<?php

define('HOST','localhost');
define('BANCO','escolaist');
define('USUARIO','root');
define('SENHA','');

class Produto_class{

    private $conexaoSQL;
    private $charset;


    private function MontarConexao(){
        try {
            $this->charset=array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8');
            $this->pdo=new PDO("mysql:host=".HOST.";dbname=".BANCO.";",USUARIO,SENHA,$this->charset);
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


    public function EnviarProduto($nome,$descricao,$fotos=array())
    {
        $cmd=$this->pdo->prepare('INSERT INTO album(nome_album,descricao) VALUES (:nome,:desc)');
        $cmd->bindValue(':nome',$nome);
        $cmd->bindValue(':desc',$descricao);
        $cmd->execute();
        $id_produto= $this->pdo->LastInsertId();

        if(count($fotos)>0){
            for ($i=0; $i <count($fotos) ; $i++) { 
                # code...
            $nome_foto=$fotos[$i];
            $cmd=$this->pdo->prepare('INSERT INTO imagens(nome_imagem,id_album) VALUES (:nome,:id)');
        $cmd->bindValue(':nome',$nome_foto);
        $cmd->bindValue(':id',$id_produto);
        $cmd->execute();
            }
        }
    }
    public function EnviarOutdoor($nome,$descricao,$fotos=array())
    {
        $cmd=$this->pdo->prepare('INSERT INTO album(nome_album,descricao,status) VALUES (:nome,:desc,:status)');
        $cmd->bindValue(':nome','Outdoor');
        $cmd->bindValue(':desc',$descricao);
        $cmd->bindValue(':status','1');
        $cmd->execute();
        $id_produto= $this->pdo->LastInsertId();

        if(count($fotos)>0){
            for ($i=0; $i <count($fotos) ; $i++) { 
                # code...
            $nome_foto=$fotos[$i];
            $cmd=$this->pdo->prepare('INSERT INTO imagens(nome_imagem,id_album) VALUES (:nome,:id)');
        $cmd->bindValue(':nome',$nome_foto);
        $cmd->bindValue(':id',$id_produto);
        $cmd->execute();
            }
        }
    }
    public function buscarProdutos()
    {
        $cmd= $this->pdo->query('SELECT *,(SELECT nome_imagem from imagens i where i.id_album=album.id_album LIMIT 1) as foto_capa from album');
        if($cmd->rowCount()>0)
        {
            $dados=$cmd->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $dados=array();
        }
        return $dados;
    }
    public function buscarOutdoors()
    {
        $cmd= $this->pdo->query("SELECT *,(SELECT nome_imagem from imagens i where i.id_album=album.id_album LIMIT 1) as foto_capa from album where nome_album='Outdoor' and status='1'");
        if($cmd->rowCount()>0)
        {
            $dados=$cmd->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $dados=array();
        }
        return $dados;
    }
    
    public function ImagensEstrutura()
    {
        $cmd= $this->pdo->query('SELECT nome_imagem from imagens i inner join album a on i.id_album=a.id_album where nome_album="estrutura"');
        if($cmd->rowCount()>0)
        {
            $dados=$cmd->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $dados=array();
        }
        return $dados;
    }
    public function buscarGaleria()
    {
        $cmd= $this->pdo->query('SELECT *,(SELECT nome_imagem from imagens i where i.id_album=album.id_album LIMIT 1) as foto_capa from album where nome_album="estrutura"');
        if($cmd->rowCount()>0)
        {
            $dados=$cmd->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $dados=array();
        }
        return $dados;
    }
    public function buscarProdutosPorId($id)
    {
        $cmd=$this->pdo->prepare('SELECT * FROM album WHERE id_album=:id');
        $cmd->bindValue(':id',$id);
        $cmd->execute();
        if ($cmd->rowCount()>0) 
        {
            # code...
            $dados=$cmd->fetch(PDO::FETCH_ASSOC);
        }else{
            $dados=array();
        }
        return $dados;
    }

    public function buscarImagensPorId($id)
    {
        $cmd=$this->pdo->prepare('SELECT * FROM imagens WHERE id_album=:id');
        $cmd->bindValue(':id',$id);
        $cmd->execute();
        if ($cmd->rowCount()>0) 
        {
            # code...
            $dados=$cmd->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $dados=array();
        }
        return $dados;
    }
}