<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, width=device-width">
    <link rel="stylesheet" type="text/css" href="css/todas_as_avaliacoes.css" />
    <title>Provas</title>

    <link rel="shortcut icon" href="../image/logo.png">
</head>

<body>
    <?php require "topo.php"; ?>

    <div id="caixa_preta">
    </div><!-- caixa_preta -->

    <div id="box">

    </div><!-- box-->

    <!-- <?php ///require_once "../config.php"; 
    
    // $go_to_url é o link do banner
// echo "<script>window.open('gerar_pdf.php', '_blank');</script>";

    ?> -->
    </head>

    <body>
        <div id="box">

            <div align="center">
                <h1>Gerar distribuição de Notas</h1>
                <br>
                <form action="" method="GET">
                   <div class="row">
                       <div class="form-group">
                    <label for="exampleFormControlInput1">Selecione uma Turma</label>
                    <select name="disciplina" class="form-control col-sm-12"><?php 
                            $code=$_GET['code'];
                            $sql_disc="SELECT d.id_disciplinas,d.disciplina,c.curso,c.id_cursos,cat.categoria from disciplinas d INNER JOIN professores p on d.id_professores=p.id_professores INNER JOIN cursos c on c.id_cursos=d.id_cursos inner JOIN categoria cat on cat.id_categoria=c.id_categoria where p.code='$code'";
                            $con_disc=mysqli_query($conexao,$sql_disc);
                            while($res_dis=mysqli_fetch_assoc($con_disc)){
                            ?>
                        <option value="<?php echo $res_dis['id_disciplinas'];?>">
                            <?php echo $res_dis['disciplina']." ";?><?php echo $res_dis['curso']?></option>
                        <?php }?>
                    </select>
                    </div>
                    </div>
                    <div class="row">
                       <div class="form-group">
                    <label for="exampleFormControlInput1">Selecione uma Situação</label>
                    <select name="situacao" class="form-control col-sm-12">
                            <option value="">Notas</option>
                            <option value="ap">Aprovados</option>
                            <option value="rp">Reprovados</option>
                            <option value="ae">Aprovados por adição extra </option>
                    </select>
                    </div>
                    </div>
                    

                    <input type="hidden" name="code" value="<?php echo $_GET['code'];?>">
                    <input type="hidden" name="selec" value="<?php echo $_GET['selec']; ?>">

                    <button class="btn btn-primary" type="submit" name="button" value="<?php echo ""?>">Buscar</button>
                </form>

                <?php 
if(isset($_GET['button'])){
    // $go_to_url é o link do banner

$disc=$_GET['disciplina'];
$situacao=$_GET['situacao'];
switch ($situacao) {
    case '':
        $sql="SELECT c.id_cursos,l.nome, cat.id_categoria,c.curso,d.disciplina from disciplinas d INNER JOIN lista_disc l on l.id_lista=d.disciplina inner join  cursos c on d.id_cursos=c.id_cursos INNER JOIN categoria cat on cat.id_categoria=c.id_categoria where id_disciplinas='$disc'";
                $con=mysqli_query($conexao,$sql);
                while($res=mysqli_fetch_assoc($con)){
                    $curso=$res['id_cursos'];
                    $ca=$res['id_categoria'];
                    $nomec=$res['curso'];
                    $nomed=$res['nome'];

                }
                switch ($ca) {
                    case '1':
                        echo "<script>window.open('rel_inicial.php?id=$disc&curso=$curso&nomed=$nomed&nomec=$nomec', '_blank');</script>";
                        break;
                        case '2':
                            echo "<script>window.open('gerar_pdf.php?id=$disc&curso=$curso&nomed=$nomed&nomec=$nomec', '_blank');</script>";
                            break;
                            case '3':
                                echo "<script>window.open('gerar_pdf.php?id=$disc&curso=$curso&nomed=$nomed&nomec=$nomec', '_blank');</script>";
                                break;
                                case '4':
                                    echo "<script>window.open('rel_final.php?id=$disc&curso=$curso&nomed=$nomed&nomec=$nomec', '_blank');</script>";
                                    break;
                }
        break;
        case 'ap':
            $sql="SELECT c.id_cursos,l.nome, cat.id_categoria,c.curso,d.disciplina from disciplinas d INNER JOIN lista_disc l on l.id_lista=d.disciplina inner join  cursos c on d.id_cursos=c.id_cursos INNER JOIN categoria cat on cat.id_categoria=c.id_categoria where id_disciplinas='$disc'";
            $con=mysqli_query($conexao,$sql);
            while($res=mysqli_fetch_assoc($con)){
                $curso=$res['id_cursos'];
                $ca=$res['id_categoria'];
                $nomec=$res['curso'];
                $nomed=$res['nome'];
            }
                    echo "<script>window.open('rel_aluno.php?pg=ap&id=$disc&curso=$curso&nomed=$nomed&nomec=$nomec', '_blank');</script>";
                
            break;
        case 'rp':
                # code...
                $sql="SELECT c.id_cursos,l.nome, cat.id_categoria,c.curso,d.disciplina from disciplinas d INNER JOIN lista_disc l on l.id_lista=d.disciplina inner join  cursos c on d.id_cursos=c.id_cursos INNER JOIN categoria cat on cat.id_categoria=c.id_categoria where id_disciplinas='$disc'";
                $con=mysqli_query($conexao,$sql);
                while($res=mysqli_fetch_assoc($con)){
                    $curso=$res['id_cursos'];
                    $ca=$res['id_categoria'];
                    $nomec=$res['curso'];
                    $nomed=$res['nome'];

            }
                    echo "<script>window.open('rel_aluno.php?pg=rp&id=$disc&curso=$curso&nomed=$nomed&nomec=$nomec', '_blank');</script>";
                
                break;
        case 'ae':
                    # code...
                    break;
    
    default:
        # code...
        break;
}


}
?>
                <?php require "rodape.php"; ?>
    </body>

</html>