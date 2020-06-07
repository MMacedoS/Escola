<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="with=device-width,initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/todas_as_avaliacoes.css" />
    <title>Provas</title>

    <link rel="shortcut icon" href="../image/logo_ist.gif">
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
                <h1>Distribuição de Notas</h1>
                <form action="" method="GET">
                    Selecione uma disciplina:
                    <select name="disciplina" id=""><?php 
                            $code=$_GET['code'];
                            $sql_disc="SELECT d.id_disciplinas,d.disciplina,c.curso,c.id_cursos from disciplinas d INNER JOIN professores p on d.id_professores=p.id_professores INNER JOIN cursos c on c.id_cursos=d.id_cursos where p.code='$code'";
                            $con_disc=mysqli_query($conexao,$sql_disc);
                            while($res_dis=mysqli_fetch_assoc($con_disc)){
                            ?>
                        <option value="<?php echo $res_dis['id_disciplinas'];?>">
                            <?php echo $res_dis['disciplina']." ";?><?php echo $res_dis['curso']?></option>
                        <?php }?>
                    </select>

                    <input type="hidden" name="code" value="<?php echo $_GET['code'];?>">

                    <button class="btn btn-primary" type="submit" name="button" value="<?php echo ""?>">Buscar</button>
                </form>

                <?php 
if(isset($_GET['button'])){
    // $go_to_url é o link do banner
$disc=$_GET['disciplina'];
$sql="select id_cursos from disciplinas where id_disciplinas='$disc'";
$con=mysqli_query($conexao,$sql);
while($res=mysqli_fetch_assoc($con)){
    $curso=$res['id_cursos'];
}
echo "<script>window.open('gerar_pdf.php?id=$disc&curso=$curso', '_blank');</script>";
}
?>
                <?php require "rodape.php"; ?>
    </body>

</html>