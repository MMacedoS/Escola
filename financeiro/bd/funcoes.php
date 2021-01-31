<?php

foreach (glob("../../Control/conexao.php") as $filename)
{
    require_once $filename;
}

class funcoes{ 
        // turmas
        public function buscaQtdeTurma()
        {      
            $con=new Conexao;              
            $con->executaConexao();
            $cmd=$con->pdo->query("SELECT * FROM categoria order by id_categoria asc");        
            if($cmd->rowCount()>0)
            {
                $dados=$cmd->fetchAll(PDO::FETCH_ASSOC);
               
            }else{
                $dados=array();
            }
            return $dados;
        }
        public function buscaIdTurma($param)
        {      
            $con=new conexao;  
            $con->executaConexao();
            $cmd=$con->pdo->query(" SELECT * FROM cursos where id_cursos='$param'  limit 1");        
            if($cmd->rowCount()>0)
            {
                $dados=$cmd->fetchAll(PDO::FETCH_ASSOC);
               
            }else{
                $dados=array();
            }
            return $dados;
        }
        public function buscaCatTurma($param)
        {      
            $con=new conexao;  
            $con->executaConexao();
            $cmd=$con->pdo->query("SELECT * FROM cursos where id_categoria='$param'  order by ordem asc");        
            if($cmd->rowCount()>0)
            {
                $dados=$cmd->fetchAll(PDO::FETCH_ASSOC);
               
            }else{
                $dados=array();
            }
            return $dados;
        }
        public function buscaTurma($param)
        {      
            $con=new conexao;  
            $con->executaConexao();
            $cmd=$con->pdo->query("SELECT * FROM cursos where curso like '%$param%'  order by ordem asc");        
            if($cmd->rowCount()>0)
            {
                $dados=$cmd->fetchAll(PDO::FETCH_ASSOC);
               
            }else{
                $dados=array();
            }
            return $dados;
        }
       
    
        
        // 


// ++++++++++++++++++++++++++++
// ++++++++++++++++++++++++++++++++
// ++++++++++++++++++++++++++++++++
// +++++++++++++++++++++++++++++++
// ++++++++++++++++++++++++++++
// ++++++++++++++++++++++
// ++++++++++++++++++++++
// ++++++++++++++++++++++
// funções professores
public function buscaQtdeProf()
{      
    $con=new Conexao;  
    $con->executaConexao();
    $cmd=$con->pdo->query("SELECT * FROM professores order by id_professores");        
    if($cmd->rowCount()>0)
    {
        $dados=$cmd->fetchAll(PDO::FETCH_ASSOC);
       
    }else{
        $dados=array();
    }
    return $dados;
}

public function buscaProfessores($param,$limite)
{      
    $con=new conexao;  
    $con->executaConexao();
    $cmd=$con->pdo->query("SELECT * FROM professores order by nome asc limit $param,$limite");        
    if($cmd->rowCount()>0)
    {
        $dados=$cmd->fetchAll(PDO::FETCH_ASSOC);
       
    }else{
        $dados=array();
    }
    return $dados;
}

public function buscaProfessor($param)
{      
    $con=new conexao;  
    $con->executaConexao();
    $cmd=$con->pdo->query(" SELECT * FROM professores where nome like '%$param%'  order by nome asc");        
    if($cmd->rowCount()>0)
    {
        $dados=$cmd->fetchAll(PDO::FETCH_ASSOC);
       
    }else{
        $dados=array();
    }
    return $dados;
}

public function buscaCodProfessores()
{      
    $con=new conexao;  
    $con->executaConexao();
    $cmd=$con->pdo->query("SELECT code,id_professores FROM professores limit 1");        
    if($cmd->rowCount()>0)
    {
        $dados=$cmd->fetchAll(PDO::FETCH_ASSOC);
       
    }else{
        $dados=array();
    }
    return $dados;
}

public function buscaIdProfessores($param)
{      
    $con=new conexao;  
    $con->executaConexao();
    $cmd=$con->pdo->query(" SELECT * FROM professores where id_professores='$param'  order by nome asc");        
    if($cmd->rowCount()>0)
    {
        $dados=$cmd->fetchAll(PDO::FETCH_ASSOC);
       
    }else{
        $dados=array();
    }
    return $dados;
}


//   fim professores+
// ++++++++++++++++++++++++++++++++++++++
// ++++++++++++++++++++++++++++++++++++++
// +++++++++++++++++++++++++++++++
// ++++++++++++++++++++++++++++++++++++++
// ++++++++++++++++++++++++++++++++++++++
// ++++++++++++++++++++++++++++++++
// ++++++++++++++++++++++++++++++++++++++
// ++++++++++++++++++++++++++++++++++++++

    // funções estudantes
    public function buscaQtdeEst()
    {      
        $con=new Conexao;  
        $con->executaConexao();
        $cmd=$con->pdo->query("SELECT matricula,nome,cpf,email,id_estudantes,status FROM estudantes order by id_estudantes");        
        if($cmd->rowCount()>0)
        {
            $dados=$cmd->fetchAll(PDO::FETCH_ASSOC);
           
        }else{
            $dados=array();
        }
        return $dados;
    }

    public function buscaEstudantes($param,$limite)
    {      
       
        $con=new Conexao();
        $con->executaConexao();
        $cmd=$con->pdo->query("SELECT matricula,nome,cpf,email,id_estudantes,status FROM estudantes limit $param,$limite");        
        if($cmd->rowCount()>0)
        {
            $dados=$cmd->fetchAll(PDO::FETCH_ASSOC);
           
        }else{
            $dados=array();
        }
        return $dados;
    }

    public function buscaEstudante($param)
    {      
        $con=new conexao;  
        $con->executaConexao();
        $cmd=$con->pdo->query(" SELECT matricula,nome,cpf,email,id_estudantes,status FROM estudantes where nome like '%$param%'  order by nome asc");        
        if($cmd->rowCount()>0)
        {
            $dados=$cmd->fetchAll(PDO::FETCH_ASSOC);
           
        }else{
            $dados=array();
        }
        return $dados;
    }

    public function buscaCodEstudante()
    {      
        $con=new conexao;  
        $con->executaConexao();
        $cmd=$con->pdo->query("SELECT matricula,id_estudantes FROM estudantes limit 1");        
        if($cmd->rowCount()>0)
        {
            $dados=$cmd->fetchAll(PDO::FETCH_ASSOC);
           
        }else{
            $dados=array();
        }
        return $dados;
    }
   
    public function buscaIdEstudante($param)
    {      
        $con=new conexao;  
        $con->executaConexao();
        $cmd=$con->pdo->query(" SELECT matricula,nome,cpf,email,id_estudantes,status,nascimento,endereco,celular,mensalidade,vencimento,responsavel,cpfResp FROM estudantes where id_estudantes='$param'  order by nome asc");        
        if($cmd->rowCount()>0)
        {
            $dados=$cmd->fetchAll(PDO::FETCH_ASSOC);
           
        }else{
            $dados=array();
        }
        return $dados;
    }

    public function desativar_ativar_est($id){
            
        return $dados;
    }
   

//   fim estudantes 
//                                   ++++
//                                   ++++
// ++++++++++++++++++++++++++++++++++++++
// ++++++++++++++++++++++            ++++
// +++++++++++++++++++++             ++++
// +++++++++++++++++++++             ++++
// ++++++++++++++++++++++            ++++
// ++++++++++++++++++++++++++++++++++++++

// disicplinas

public function buscaDisciplina($param,$limite)
{      
    $con=new conexao;  
    $con->executaConexao();
    $cmd=$con->pdo->query("SELECT d.id_disciplinas,l.nome as disciplinas,c.curso,p.nome as professor FROM disciplinas d inner join lista_disc l on d.disciplina=l.id_lista
    inner join cursos c on c.id_cursos=d.id_cursos inner join professores p on p.id_professores=d.id_professores order by c.ordem asc limit $param,$limite");        
    if($cmd->rowCount()>0)
    {
        $dados=$cmd->fetchAll(PDO::FETCH_ASSOC);
       
    }else{
        $dados=array();
    }
    return $dados;
}

public function buscaListaDisciplinas($param)
{      
    $con=new conexao;  
    $con->executaConexao();
    $cmd=$con->pdo->query("SELECT * FROM lista_disc where categoria='$param' ");        
    if($cmd->rowCount()>0)
    {
        $dados=$cmd->fetchAll(PDO::FETCH_ASSOC);
       
    }else{
        $dados=array();
    }
    return $dados;
}

public function buscaQtdDis()
{
    $con=new conexao;  
    $con->executaConexao();
    $cmd=$con->pdo->query("SELECT * FROM disciplinas");        
    if($cmd->rowCount()>0)
    {
        $dados=$cmd->fetchAll(PDO::FETCH_ASSOC);
       
    }else{
        $dados=array();
    }
    return $dados;
}


public function buscaIdDisc($param){
    $con=new conexao;  
    $con->executaConexao();
    $cmd=$con->pdo->query("SELECT d.*,l.nome as disciplinas,c.curso,p.nome as professor,p.id_professores,c.id_cursos,c.id_categoria FROM disciplinas d inner join lista_disc l on d.disciplina=l.id_lista
    inner join cursos c on c.id_cursos=d.id_cursos inner join professores p on p.id_professores=d.id_professores where id_disciplinas='$param'");        
    if($cmd->rowCount()>0)
    {
        $dados=$cmd->fetchAll(PDO::FETCH_ASSOC);
       
    }else{
        $dados=array();
    }
    return $dados;
}

public function buscaNomesDis($param){
    $con=new conexao;  
    $con->executaConexao();
    $cmd=$con->pdo->query("SELECT * FROM lista_disc where categoria='$param' order by nome asc");
    if($cmd->rowCount()>0)
    {
        $dados=$cmd->fetchAll(PDO::FETCH_ASSOC);
       
    }else{
        $dados=array();
    }
    return $dados;
}

// fim disciplinas

// ++++++++++++++++++++++++++++++++++++++
// +++++++++++++++++++++++          +++++
// ++++++++++++++++++++++++         +++++
// ++++++++++++++++++++++++++++++++++++++
// ++++++++++++++++++++++++         +++++
// +++++++++++++++++++++++          +++++
// ++++++++++++++++++++++++++++++++++++++


public function buscarCategoria(){
    $con=new Conexao;
    $con->executaConexao();
    $cmd=$con->pdo->query("SELECT * FROM categoria");
    if($cmd->rowCount()>0)
    {
        $dados=$cmd->fetchAll(PDO::FETCH_ASSOC);
    }else
    {
        $dados=array();
    }
        return $dados;
    

}


public function buscarBimestre(){
    $con=new Conexao;
    $con->executaConexao();
    $cmd=$con->pdo->query("SELECT * FROM unidades");
    if($cmd->rowCount()>0){
        $dados=$cmd->fetchAll(PDO::FETCH_ASSOC);
    }else{
        $dados=array();
    }
    return $dados;

}
public function buscarAtiBimestre($bimestre){
    $con=new Conexao();
    $con->executaConexao();
    $ano=Date('Y');
    $cmd=$con->pdo->query("SELECT count(id_ativ_bim) as dados FROM atividades_bimestrais WHERE bimestre='$bimestre' and ano_letivo='$ano'");
    if($cmd->rowCount()>0){
        $dados=$cmd->fetchAll(PDO::FETCH_ASSOC);

    }else{
        $dados=array();
    }
    return $dados;
}

}


?>