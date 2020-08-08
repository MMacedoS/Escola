<?php function data($data){
        return date("d-m-Y", strtotime($data));
    }?>
<!DOCTYPE html>
<?php $painel_atual = "professor"; ?>
<html lang="pt_br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/distribuicao.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="shortcut icon" href="../image/logo.png">
    <title>Distribuição de Notas</title>
    <?php require_once "../config.php"; 
    $data=Date('d-m-Y');
    
    // $go_to_url é o link do banner
// echo "<script>window.open('gerar_pdf.php', '_blank');</script>";
  
    ?>
</head>
<body>
<div id="box">

    
  <div align="center">
<H1><a href="index.php?selec=<?php echo $_GET['selec'];?>">Distribuição de Frequência</a> </H1>
<form action="distribuicao.php?pg=notas" method="get">
Selecione uma disciplina:
<select name="disciplina" id=""><?php 
$code=87415978;
$sql_disc=$pdo->prepare();
$sql_disc="SELECT d.id_disciplinas,d.disciplina,c.curso from disciplinas d INNER JOIN professores p on d.id_professores=p.id_professores INNER JOIN cursos c on c.id_cursos=d.id_cursos where p.code='$code'";
$con_disc=mysqli_query($conexao,$sql_disc);
while($res_dis=mysqli_fetch_assoc($con_disc)){
?>
        <option value="<?php echo $res_dis['id_disciplinas'];?>"><?php echo $res_dis['disciplina']." ";?><?php echo $res_dis['curso']?></option>
<?php }?>
    </select>
<select name="bimestre" id=""><?php 
$code=87415978;

$sql_disc="select * from unidades";
$con_disc=mysqli_query($conexao,$sql_disc);
while($res_dis=mysqli_fetch_assoc($con_disc)){
?>
        <option value="<?php echo $res_dis['unidade'];?>"><?php echo $res_dis['unidade']." Bimestre ";?></option>
<?php }?>
    </select>
    <input type="hidden" name="selec" value="<?php echo $_GET['selec'];?>">
    <input type="hidden" name="code" value="<?php echo $_GET['code'];?>">
    <input type="submit" name="button" value="buscar">
    </form>
<!-- aqui começa tudo sobre a tabela -->
<?php 
  $busca=$pdo->prepare("SELECT ch.date_day FROM chamadas_em_sala ch inner join estudantes e on e.matricula=ch.matricula inner join disciplinas d on d.id_disciplinas=ch.id_disciplinas where d.disciplina=:id order by ch.date_day asc");
  $busca->bindValue(':id','13');
  $busca->execute();
  $dados=$busca->fetchAll();
 echo $dado=count($dados);
?>
    
<table class="table-responsive" id="tabela" border="1" cellpadding="5" cellspacing="4" bgcolor="#FFF4EA">
<tr>
<td rowspan="2" class="nome" bgcolor="#efefef"><strong>Alunos</strong></td>
<?php 

      
     echo '<td bgcolor="#efefef" colspan='.$dado.' align="center"><h5><strong>Aulas Ministradas</h5></td>';
      ?>

    <td bgcolor="#efefef" rowspan="2"><strong>MF</strong></td>
    <td bgcolor="#efefef" rowspan="2"><strong>RF</strong></td>
    <td bgcolor="#efefef" rowspan="2"><strong>S</strong></td>
   
</tr>
<tr>
    <?php foreach($dados as $res){
        echo '<td bgcolor="#FFFFFF" class="at"><font color="#090000"><p>'.data($res['date_day']).'</p></font></td>';

    }?>
</tr>

<?php 
$chamada_aluno=$pdo->prepare("SELECT e.nome FROM estudantes e inner join cursos_estudantes ce on e.id_estudantes=ce.id_estudantes  inner join disciplinas d on d.id_cursos=ce.id_cursos  WHERE d.disciplina=:id and ce.ano_letivo=:ano order by e.nome asc");
$chamada_aluno->bindValue(':id','13');
$chamada_aluno->bindValue(':ano','2020');
$chamada_aluno->execute();
$alunos=$chamada_aluno->fetchAll();
$dado_alunos=count($alunos);
foreach($alunos as $aluno){ ?>
<tr>
<td colspan="1" class="at" bgcolor="#efefef" align="center"><strong><?php echo $aluno['nome'];?></strong></td>
<?php $busca_faltas=$pdo->prepare("SELECT presente FROM chamadas_em_sala ch inner join estudantes e on e.matricula=ch.matricula inner join disciplinas d on d.id_disciplinas=ch.id_disciplinas where d.disciplina=:id order by ch.date_day asc");
    $busca_faltas->bindValue(':id','13');
    $busca_faltas->execute();
    $dados=$busca_faltas->fetchAll();
    $dado=count($dados); 
     foreach($dados as $res){
         switch ($res['presente']) {
             case 'FALTA':
                 # code...
                 echo '<td rowspan="1" class="nome" bgcolor="#efefef"><strong>F</strong></td>';
                   
                 break;
                 case 'SIM':
                    echo '<td rowspan="1" class="nome" bgcolor="#efefef"><strong>*</strong></td>';
                   
                    break;
             
         }
        
     }
     echo '<td rowspan="1" class="nome" bgcolor="#efefef"><strong></strong></td>';
     echo '<td rowspan="1" class="nome" bgcolor="#efefef"><strong></strong></td>';
     echo '<td rowspan="1" class="nome" bgcolor="#efefef"><strong>*</strong></td>';
    ?>
    
</tr>

<?php } ?>

<!-- 
<td bgcolor="#FFFFFF"><font color="#003399"><strong>7,50</strong></font></td>
<td bgcolor="#FFFFFF" align="center"><font color="#003399"><strong>7,25</strong></font></td> -->
</tr>
</table>
</div>

</div><!-- box -->

</body>
<p>
        <input type="button" value="Criar PDF" id="btnImprimir" onclick="CriaPDF()" />
    </p>
</body>
<script>
    function CriaPDF() {
        var minhaTabela = document.getElementById('tabela').innerHTML;
        var style = "<style>";
        style = style + "table {width: 100%;font: 20px Calibri;}";
        style = style + "table, th, td {border: solid 1px #DDD; border-collapse: collapse;";
        style = style + "padding: 2px 3px;text-align: center;}";
        style = style + "</style>";
        // CRIA UM OBJETO WINDOW
        var win = window.open('', '', 'height=700,width=700');
        win.document.write('<html><head>');
        win.document.write('<title>Empregados</title>');   // <title> CABEÇALHO DO PDF.
        win.document.write(style);                                     // INCLUI UM ESTILO NA TAB HEAD
        win.document.write('</head>');
        win.document.write('<body>');
        win.document.write(minhaTabela);                          // O CONTEUDO DA TABELA DENTRO DA TAG BODY
        win.document.write('</body></html>');
        win.document.close(); 	                                         // FECHA A JANELA
        win.print();                                                            // IMPRIME O CONTEUDO
    }
</script>
</html>
</html>