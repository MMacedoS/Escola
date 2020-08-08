<?php


require_once "./classes/Conexao.Class.php";

class Select extends Conexao{
    private $sql;
    private $resultado;
    private $query;
    private $recebeConexao;


    public function setQuery($query){
        $this ->query=$query;
    }
    public function getQuery(){
        return $this->$query;
    }
    
    public function getResultado(){
        return $this->$resultado;
    
    }

    private function MinhaConexao(){
        $this->recebeConexao=parent::ExecutaConexao();
    }
    public function ExecutaSelect($query)
    {
        $this->MinhaConexao();
        $this->MontaSelect();
    }


    private function MontaSelect(){
        $this->sql=$this->recebeConexao->prepare($this->getQuery());
        $this->sql->execute();
        $this->resultado =$this->sql->fetchAll(PDO::FETCH_ASSOC);
        
    }
}