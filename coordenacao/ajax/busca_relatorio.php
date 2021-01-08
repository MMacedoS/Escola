
<?php
require_once '../../Control/conexao.php';
$turma=@$_GET['turma'];

$ano=Date('Y');
if(isset($_GET['opcao']) && $_GET['opcao']==1){

$busca_alunos=$pdo->query("SELECT l.nome as nome,d.id_disciplinas as id_disciplinas from disciplinas d INNER JOIN lista_disc l ON d.disciplina=l.id_lista INNER JOIN cursos c on c.id_cursos=d.id_cursos WHERE c.id_cursos='$turma'");
$dados=$busca_alunos->fetchAll(PDO::FETCH_ASSOC);

if(isset($_GET['turma'])){

echo '<div class="form-group">
            <label for="">Disicplinas</label>
            <select class="form-control" name="" id="alunos">
             <option value="todos">Todas</option>
            ';
            foreach($dados as $key=>$value){
              echo '<option value="'.$value['id_disciplinas'].'">'.$value['nome'].'</option>';               
             }
             echo '
            </select>

            </div>     
     ';}

  }else{


    $busca_alunos=$pdo->query("SELECT e.nome as nome,e.matricula as matricula from estudantes e
    INNER JOIN cursos_estudantes ce ON ce.id_estudantes=e.id_estudantes INNER JOIN 
    cursos c on ce.id_cursos=c.id_cursos WHERE c.id_cursos='$turma'");
    $dados=$busca_alunos->fetchAll(PDO::FETCH_ASSOC);
    
    if(isset($_GET['turma'])){
    
    echo '<div class="form-group">
                <label for="">Alunos</label>
                <select class="form-control" name="" id="alunos">
                 <option value="todos">Todas</option>
                ';
                foreach($dados as $key=>$value){
                  echo '<option value="'.$value['matricula'].'">'.$value['nome'].'</option>';               
                 }
                 echo '
                </select>
    
                </div>     
         ';}
    

  }
     
     ?>
