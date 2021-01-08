<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <title>Administração</title>

    <link rel="shortcut icon" href="../image/logo_ist.gif">

    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
</head>

<body>
    <?php
    header('Content-Type: text/html');
    ini_set('default_charset','utf-8');
    
   require_once("topo.php");?>

    <!--cadastrar cursos-->


    <div id="caixa_preta">
    </div>
    <?php if(@$_GET['pg']=='cad_disc'){   ?>
    <div class="box_professores">
        <br /><br />
        <a href="cursos_e_disciplinas.php?pg=cad_disc&cadastra=sim" class="a2">
            Cadastrar Disciplina
        </a>
        <?php if(@$_GET['cadastra']=='sim'){ ?>
        <br /><br />
        <h1>Cadastrar Disciplina</h1>
        <?php if(isset($_POST['cadastra'])){
                    $L_disc=$_POST['disc'];
                    $l_cate=$_POST['cate'];
                    $res = $pdo->prepare("select * from lista_disc where nome=:L_disc and categoria=:l_cate");
                        $res->bindValue(':L_disc',$L_disc);
                        $res->bindValue(':l_cate',$l_cate);
                        $res->execute();    
                        $dados = $res->fetchAll(PDO::FETCH_ASSOC);
                        $con_verif = count($dados);
                      if($con_verif==0){
                        if($L_disc!=''){
                          
                        $res=$pdo->prepare("INSERT INTO lista_disc (nome,categoria) values(:nome,:categoria)");
                        $res->bindvalue(":nome",$L_disc);
                        $res->bindvalue(":categoria",$l_cate);
                        $res->execute();
                        }else{
                            echo "<script language='javascript'>window.alert('Nome da disciplina vazio');</script>";
                        }
                    }else{
                 echo "<script language='javascript'>window.alert('Esta disciplina para esta categoria ja foi cadastrada');</script>";
                    }
                } ?>
        <form name="form1" accept-charset="utf-8" method="post" action="">
            <table class="users" id="table-responsive" border="0">

                <tr>
                    <td class="row-1 row-cur">Disciplina</td>
                    <td class="row-1 row-cur">Categoria</td>
                </tr>

                <tr>
                    <td class="row-1 row-cur"><input type="text" name="disc" width="40px" value=""></td>
                    <td class="row-1 row-cur">
                        <select name="cate" size="1" id="categoria">
                            <?php 
                                    $sql_cat = $pdo->prepare("select * from categoria");
                                    $sql_cat->execute();    
                                    
                                    while($bus_categoria=$sql_cat->fetch()){
                                    
                                    ?>
                            <option value="<?php echo $bus_categoria['id_categoria'] ?>">
                                <?php echo $bus_categoria['categoria'] ?></option>
                            <?php } ?>
                        </select>
                    </td>
                    <td class="row-1 row-cur"><input class="input" type="submit" name="cadastra" id="button"
                            value="Cadastrar"></td>
                </tr>

            </table>
        </form>
        <br />
        <?php die;}
             else {?>
        <?php if(@$_GET['cadastra']=='nao'){?>
        <br /><br />
        <h1>Atualiza Discipliba</h1>
        <?php
           $id=$_GET['id'];
                    $sql_edit = $pdo->prepare("select * from lista_disc where id_lista=:id");
                    $sql_edit->bindValue(':id',$id);
                    $sql_edit->execute();                        
                    while($edit_curso=$sql_edit->fetch()){
                    ?>
        <?php if(isset($_POST['atualiza'])){
                     $L_disc=$_POST['disc'];
                     $l_cate=$_POST['cate'];
                      $res = $pdo->prepare("select * from lista_disc where nome=:L_disc and categoria=:l_cate");
                        $res->bindValue(':L_disc',$L_disc);
                        $res->bindValue(':l_cate',$l_cate);
                        $res->execute();    
                        $dados = $res->fetchAll(PDO::FETCH_ASSOC);
                        $con_verif = count($dados);
                     if($con_verif==0){
                        $res=$pdo->prepare("update lista_disc set nome=:nome,categoria=:categoria where id_lista=:lista");
                        $res->bindvalue(":nome",$L_disc);
                        $res->bindvalue(":categoria",$l_cate);
                        $res->bindvalue(":lista",$id);
                        $res->execute();
                     echo "<script language='javascript'>window.alert('Disciplina atualizada com sucesso!');</script>";
                       echo "<script language='javascript'>window.location='cursos_e_disciplinas.php?pg=cad_disc';</script>";
                   
                }else{
                    echo "<script language='javascript'>window.alert('Esta Turma ja existe!');</script>";
                }
                } ?>
        <form name="form1" accept-charset="utf-8" method="post" action="">
            <table class="users" id="table-responsive" border="0">

                <tr>
                    <td class="row-1 row-cur">Disciplina</td>
                    <td class="row-1 row-cur">Categoria</td>
                </tr>

                <tr>
                    <td class="row-1 row-cur"><input type="text" name="disc" id="textfield"
                            value="<?php echo $edit_curso['nome'];?>"></td>

                    <td class="row-1 row-cur">
                        <select name="cate" size="1" id="categoria">

                            <?php 
                                     $cate=$edit_curso['categoria'];
                                     $sql_edit = $pdo->prepare("select * from categoria where id_categoria=:cate");
                                     $sql_edit->bindValue(':cate',$cate);
                                     $sql_edit->execute();    
                                     
                                    while($res_cat=$sql_edit->fetch()){
                                   ?>
                            <option value="<?php echo $edit_curso['categoria'];?>"><?php echo $res_cat['categoria'];?>
                            </option>
                            <?php }
                                    $sql_cat = $pdo->prepare("select * from categoria");
                                    $sql_cat->execute();    
                                    
                                   while($res_cat=$sql_cat->fetch()){
                                   ?>
                            ?>

                            <option value="<?php echo $res_cat['id_categoria'];?>"><?php echo $res_cat['categoria'];?>
                            </option>

                            <?php } ?>
                        </select>

                    </td>
                    <td class="row-1 row-cur"><input class="input" type="submit" name="atualiza" id="button"
                            value="Atualizar"></td>
                </tr>

            </table>
            <?php } ?>
        </form>
        <br />

        <?php
             die;}}
             ?>
        <!--visualizar disciplinas lista cadastrados -->

        <br /><br />
        <h1>Disciplinas</h1>
        <form name="button" accept-charset="utf-8" method="post" action="" enctype="multipart/form-data">
            <table class="users" id="table-responsive" border="0">
                <tr>
                    <td><strong>Disciplina</strong></td>
                    <td><strong>Categoria</strong></td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td><input type="text" class="pesq" name="nome" value=""
                            placeholder="pesquise pelo nome aqui ou escolha a categoria"></td>
                    <td>
                    <select name="categoria" size="1" id="categoria">

                                    <?php 
                                    if(@$_GET['disc']){
                                            $cate=$_GET['disc'];
                                            $sql_edit = $pdo->prepare("select * from categoria where id_categoria=:cate");
                                            $sql_edit->bindValue(':cate',$cate);
                                            $sql_edit->execute();    
                                            
                                            while($res_cat=$sql_edit->fetch()){
                                        ?>
                                    <option value="<?php echo $res_cat['id_categoria'];?>"><?php echo $res_cat['categoria'];?>
                                    </option>
                                    <?php }///fim while
                                    }////qfim if
                                            $sql_cat = $pdo->prepare("select * from categoria");
                                            $sql_cat->execute();    
                                            
                                        while($res_cat=$sql_cat->fetch()){
                                        ?>
                                    ?>

                                    <option value="<?php echo $res_cat['id_categoria'];?>"><?php echo $res_cat['categoria'];?>
                                    </option>

                                    <?php } ?>
                                    </select>
                    </td>
                    <td><input class="input" type="submit" name="btn_disc" id="button" value="Filtrar"></td>
                </tr>
            </table>
        </form>
        <?php if(isset($_POST['btn_disc'])){

$tipo = $_POST['nome'];
$serie = $_POST['categoria'];

$s = base64_encode('filtro');

echo "<script language='javascript'>window.location='cursos_e_disciplinas.php?pg=cad_disc&lista=$s&status=$tipo&disc=$serie';</script>";

}?>
        <?php 
                // $s = base64_decode($_GET['s']);;
                    if(isset($_GET['lista'])){ 
                        $tipo=$_GET['status'];
                        $categ=$_GET['disc'];
                        if($tipo==''){
                                $s=$pdo->prepare("SELECT * from lista_disc where  categoria=:cate  order by nome asc ");
                                $s->bindValue(':cate',$cate);
                                $s->execute(); 
                                $dados=$s->fetchAll();
                                $con_verif = count($dados);
                        }else{          
                           
                            $s="SELECT * from lista_disc where nome like ? ";
                                $params = array("%$tipo%");
                                $stmt = $pdo->prepare($s);
                                $stmt->execute($params);
                                $dados=$stmt->fetchAll();
                                $con_verif = count($dados);
                            // $s="SELECT * from lista_disc where nome like '%".$tipo."%' order by nome asc ";
                            // $sql_1 = mysqli_query($conexao, $s);
                        
                        }
                        
                    }else{
                        $stmt = $pdo->prepare("SELECT * FROM lista_disc order by categoria asc");
                        $stmt->execute(); 
                        $dados=$stmt->fetchAll();
                        $con_verif = count($dados);
                    }

                if($con_verif==0){
                    echo "<h2>No momento não existe!</h2><br><br>";
                }else{

                ?>
        <table class="users" id="table-responsive" border="0">

            <tr>
                <td class="row-1 row-ID"><strong><?php echo @$con_verif.' ';?>Disciplinas:</strong></td>
                <td class="row-3 row-ID"> <strong> Categoria:</strong></td>
                <td class="row-4 row-ID">&nbsp;</td>
            </tr>


            <?php foreach($dados as $res_1){
                    $cursos_id=$res_1['id_lista'];
                ?>

            <tr>
                <td class="row-cur">
                    <h3>
                        <?php echo $disc = $res_1['nome'];
                        $id_cat=$res_1['categoria'];
                        ?>
                    </h3>
                </td>
                <td class="row-cod">
                    <h3>

                        <?php 
                            $categoria=$res_1['categoria'];
                        $busca_cat="select categoria from categoria where id_categoria='$categoria'";
                        $con_cat=mysqli_query($conexao,$busca_cat);
                        while ($res_cate=mysqli_fetch_assoc($con_cat)){
                            echo $res_cate['categoria'];
                        }
                         ?>
                    </h3>
                </td>
                <td class="">
                    <a class="a"
                        href="cursos_e_disciplinas.php?pg=cad_disc&deleta=cur&id=<?php echo @$res_1['id_lista'];?>">
                        <img title="Excluir curso" src="img/deleta.jpg" width="18" heigth="18" border="0" alt=""></a>
                </td>
                <td class="row-ID">
                    <a class="a"
                        href="cursos_e_disciplinas.php?pg=cad_disc&cadastra=nao&id=<?php echo $res_1['id_lista'];?>"><img
                            title="Editar dados Cadastrais" src="../image/ico-editar.png" width="18" height="18"
                            border="0"></a>
                </td>
            </tr>
            <?php }?>

        </table>

        <br /><br />
                    <?php  }  
         ?>

        <!-- <!deleção das disciplinas > -->
        <?php 
        if (@$_GET['deleta']=='cur') {
            # code...
            $id=@$_GET['id'];

            $sql_3="delete from cursos where id_cursos='$id'";
            mysqli_query($conexao, $sql_3);

                echo "<script language='javascript'>window.location='cursos_e_disciplinas.php?pg=cad_disc';</script>";
        }?>

    </div>
    <!--box_curso-->
    <?php } ?>

    <!-- turma -->
    <?php if(@$_GET['pg']=='curso'){   ?>
    <div class="box_professores">
        <br /><br />
        <a href="cursos_e_disciplinas.php?pg=curso&cadastra=sim" class="a2">
            Cadastrar Turma
        </a>
        <?php if(@$_GET['cadastra']=='sim'){ ?>
        <br /><br />
        <h1>Cadastrar Turma</h1>
        <?php if(isset($_POST['cadastra'])){
                    $curso=$_POST['curso'];
                    $curso=utf8_encode($curso);
                    $turno=$_POST['turno'];
                    $categoria=$_POST['categoria'];
                    $sql_verif=$pdo->query("SELECT * FROM cursos WHERE curso=:curso AND turno=:turno");
                    $sql_verif->bindValue(':curso',$curso);
                    $sql_verif->bindValue(':turno',$turno);
                    $sql_verif->execute();
                    $verif=$sql_verif->fetchAll();
                    $con_verif=count($verif);
                     if($con_verif==0){
                    $inserir=$pdo->prepare('INSERT INTO cursos (curso,turno,id_categoria) VALUES(:curso.:turno,:categoria)');
                    $inserir->bindValue(':curso',$curso);
                    $inserir->bindValue(':turno',$turno);
                    $inserir->bindValue(':categoria',$categoria);
                    
                    if($curso==''){
                            echo "<script language='javascript'>window.alert('Digite o nome da Turma!');</script>";
                    }else{
                        $inserir->execute();                    
                     echo "<script language='javascript'>window.alert('Turma inserido com sucesso!');</script>";
                       echo "<script language='javascript'>window.location='cursos_e_disciplinas.php?pg=curso';</script>";
                    
                }
                }else{
                 echo "<script language='javascript'>window.alert('Este curso ja existe, altere o curso');</script>";
                    }
                } ?>
        <form name="form1" accept-charset="utf-8" method="post" action="">
            <table class="users" id="table-responsive" border="0">

                <tr>
                    <td class="row-1 row-cur">Turma</td>
                    <td class="row-1 row-cur">Turno</td>
                    <td class="row-1 row-cur">Categoria</td>
                </tr>

                <tr>
                    <td class="row-1 row-cur"><input type="text" name="curso" width="40px" value=""></td>
                    <td class="row-1 row-cur">
                        <select name="turno" size="1" id="turno">
                            <option value="Matutino">Matutino</option>
                            <option value="Vespertino">Vespertino</option>
                            <option value="Noturno">Noturno</option>
                        </select>
                    </td>
                    <td class="row-1 row-cur">
                        <select name="categoria" size="1" id="categoria">
                            <?php 
                                    $sql_cat="select * from categoria";
                                    $sql_con=mysqli_query($conexao,$sql_cat);
                                    while($bus_categoria=mysqli_fetch_assoc($sql_con)){
                                    
                                    ?>
                            <option value="<?php echo $bus_categoria['id_categoria'] ?>">
                                <?php echo $bus_categoria['categoria'] ?></option>
                            <?php } ?>
                        </select>
                    </td>
                    <td class="row-1 row-cur"><input class="input" type="submit" name="cadastra" id="button"
                            value="Cadastrar"></td>
                </tr>

            </table>
        </form>
        <br />
        <?php die;}
             else {?>
        <?php if(@$_GET['cadastra']=='nao'){?>
        <br /><br />
        <h1>Atualiza Turma</h1>
        <?php
                    $id=$_GET['id'];
                    $sql_edit="select * from cursos where id_cursos='$id'";
                    $sql_con=mysqli_query($conexao,$sql_edit);
                    while($edit_curso=mysqli_fetch_assoc($sql_con)){?>
        <?php if(isset($_POST['atualiza'])){
                    $curso=$_POST['curso'];
                     $turno=$_POST['turno'];
                     $categoria=$_POST['categoria'];   
                    $sql_verif="select * from cursos where curso='$curso' 
                    and turno='$turno' and id_categoria='$categoria'";
                    $con_verif=mysqli_query($conexao,$sql_verif);
                     if(mysqli_num_rows($con_verif)==''){
                    $sql="update cursos set curso='$curso',turno='$turno', id_categoria='$categoria' where id_cursos='$id'";
                    if($curso==''){
                            echo "<script language='javascript'>window.alert('Digite o nome da Turma!');</script>";
                    }else{
                    $cad=mysqli_query($conexao,$sql);
                    if($cad<=0){
                    echo "<script language='javascript'>window.alert('erro ao cadastrar!');</script>";
                    }else{
                     echo "<script language='javascript'>window.alert('Curso atualizado com sucesso!');</script>";
                       echo "<script language='javascript'>window.location='cursos_e_disciplinas.php?pg=curso';</script>";
                    }
                }
                }else{
                    echo "<script language='javascript'>window.alert('Este Curso ja existe!');</script>";
                }
                } ?>
        <form name="form1" accept-charset="utf-8" method="post" action="">
            <table class="users" id="table-responsive" border="0">

                <tr>
                    <td class="row-1 row-cur">Curso</td>
                    <td class="row-1 row-cur">Turno</td>
                    <td class="row-1 row-cur">Categoria</td>
                </tr>

                <tr>
                    <td class="row-1 row-cur"><input type="text" name="curso" id="textfield"
                            value="<?php echo $edit_curso['curso'];?>"></td>
                    <td class="row-1 row-cur">
                        <select name="turno" size="1" id="turno">
                            <option value="<?php echo $edit_curso['turno'];?>"><?php echo $edit_curso['turno'];?>
                            </option>
                            <option value="Matutino">Matutino</option>
                            <option value="Vespertino">Vespertino</option>
                            <option value="Noturno">Noturno</option>
                        </select>
                    </td>
                    <td class="row-1 row-cur">
                        <select name="categoria" size="1" id="categoria">

                            <?php 
                                     $cate=$edit_curso['id_categoria'];
                                   $busca_cat="select * from categoria where id_categoria='$cate'";
                                    $con_busca=mysqli_query($conexao,$busca_cat);
                                    while($res_cat=mysqli_fetch_assoc($con_busca)){
                                   ?>
                            <option value="<?php echo $edit_curso['id_categoria'];?>">
                                <?php echo $res_cat['categoria'];?></option>
                            <?php }
                                     $busca_cat="select * from categoria";
                                    $con_busca=mysqli_query($conexao,$busca_cat);
                                    while($res_cat=mysqli_fetch_assoc($con_busca)){
                                   ?>
                            ?>

                            <option value="<?php echo $res_cat['id_categoria'];?>"><?php echo $res_cat['categoria'];?>
                            </option>

                            <?php } ?>
                        </select>

                    </td>
                    <td class="row-1 row-cur"><input class="input" type="submit" name="atualiza" id="button"
                            value="Atualizar"></td>
                </tr>

            </table>
            <?php } ?>
        </form>
        <br />

        <?php
             die;}}
             ?>
        <!--visualizar cursos cadastrados -->
        <form name="button" accept-charset="utf-8" method="post" action="" enctype="multipart/form-data">
            <table class="users" id="table-responsive" border="0">
                <tr>
                    <td><strong>Turma</strong></td>
                    <td><strong>Categoria</strong></td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
              <td>
                        <select name="turma" class="pesq" id="select2">
                         
                            <?php if(isset($_GET['status'])){
                    $t=$_GET['status'];
                    ?> <option value="<?php echo $_GET['status']; ?>">
                                <?php $sql_2 = mysqli_query($conexao, "SELECT curso,id_cursos FROM cursos where id_cursos='$t'");
                    while($res_2 = mysqli_fetch_assoc($sql_2)){ 
                            echo $res_2['curso'];}
                            }?></option>
                               <option value="">Todos</option>
                            <?php
                $sql_2 = mysqli_query($conexao, "SELECT * FROM cursos");
                    while($res_2 = mysqli_fetch_assoc($sql_2)){
                ?>
                            <option value="<?php echo $res_2['id_cursos']; ?>"><?php echo $res_2['curso']; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </td>
                    <td>
                        <select name="categoria" class="pesq" id="select2">
                            <?php if(isset($_GET['disc'])){
                    $t=$_GET['disc'];
                    ?> <option value="<?php echo $_GET['disc']; ?>">
                                <?php $sql_2 = mysqli_query($conexao, "SELECT categoria FROM categoria where id_categoria='$t'");
                    while($res_2 = mysqli_fetch_assoc($sql_2)){ 
                            echo $res_2['categoria'];}
                            }?></option>
                            <?php
                $sql_2 = mysqli_query($conexao, "SELECT * FROM categoria");
                    while($res_2 = mysqli_fetch_assoc($sql_2)){
                ?>
                            <option value="<?php echo $res_2['id_categoria']; ?>"><?php echo $res_2['categoria']; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </td>
                    <td><input class="input" type="submit" name="btn_curso" id="button" value="Filtrar"></td>
                </tr>
            </table>
        </form>
        <?php if(isset($_POST['btn_curso'])){

$c_turma = $_POST['turma'];
$c_cate = $_POST['categoria'];

$s = base64_encode('filtro');

echo "<script language='javascript'>window.location='cursos_e_disciplinas.php?pg=curso&curso=$s&status=$c_turma&tur=$c_cate';</script>";

}?>
        <br /><br />
        <h1>Turmas</h1>
        <?php  
        
        if(isset($_GET['curso'])){ 
                        $c_turma=$_GET['status'];
                        $c_cate=$_GET['tur'];
                        if($c_turma==''){
                                $s="SELECT * from cursos where  id_categoria='$c_cate'  order by curso asc ";
                                $sql_1 = mysqli_query($conexao, $s);
                        }else{          
                            $s="SELECT * from cursos where id_cursos ='$c_turma' order by curso asc ";
                            $sql_1 = mysqli_query($conexao, $s);
                        
                        }
                        
                    }else{
                        $s="SELECT * from cursos ORDER BY curso asc";
                        $sql_1 = mysqli_query($conexao, $s);
                    } ?>
        <table class="users" id="table-responsive" border="0">

            <tr>
                <td class="row-1 row-ID"><strong>Turmas:</strong></td>
                <td class="row-2 row-ID"><strong>Total de disciplinas desta Turma:</strong></td>
                <td class="row-3 row-ID"> <strong> Categoria:</strong></td>
                <td class="row-4 row-ID">&nbsp;</td>
            </tr>


            <?php while($res_1 = mysqli_fetch_assoc($sql_1)){
                    $cursos_id=$res_1['id_categoria'];
                ?>

            <tr>
                <td class="row-cur">
                    <h3>
                        <?php echo $curso = $res_1['curso'].' || '.$res_1['turno'];
                        
                        ?>
                    </h3>
                </td>
                <td class="row-name">
                    <h3><?php $sql_2="select * from lista_disc where categoria='$cursos_id'";
                    $result2=mysqli_query($conexao,$sql_2);
                    echo mysqli_num_rows($result2); ?>
                    </h3>
                </td>
                <td class="row-cod">
                    <h3>

                        <?php 
                            $categoria=$res_1['id_categoria'];
                        $busca_cat="select categoria from categoria where id_categoria='$categoria'";
                        $con_cat=mysqli_query($conexao,$busca_cat);
                        while ($res_cate=mysqli_fetch_assoc($con_cat)){
                            echo $res_cate['categoria'];
                        }
                         ?>
                    </h3>
                </td>
                <td class="">
                    <a class="a"
                        href="cursos_e_disciplinas.php?pg=curso&deleta=cur&id=<?php echo @$res_1['id_cursos'];?>">
                        <img title="Excluir curso" src="img/deleta.jpg" width="18" heigth="18" border="0" alt=""></a>
                </td>
                <td class="row-ID">
                    <a class="a"
                        href="cursos_e_disciplinas.php?pg=curso&cadastra=nao&id=<?php echo $res_1['id_cursos'];?>"><img
                            title="Editar dados Cadastrais" src="../image/ico-editar.png" width="18" height="18"
                            border="0"></a>
                </td>
            </tr>
            <?php }?>

        </table>
        <br /><br />
        

        <!deleção dos cursos>
            <?php 
        if (@$_GET['deleta']=='cur') {
            # code...
            $id=@$_GET['id'];

            $sql_3="delete from cursos where id_cursos='$id'";
            mysqli_query($conexao, $sql_3);

                echo "<script language='javascript'>window.location='cursos_e_disciplinas.php?pg=curso';</script>";
        }?>

    </div>
    <!--box_curso-->
    <?php } ?>

    <!-- cadastrar unidades -->
    <?php if(@$_GET['pg']=='unidade'){   ?>
    <div class="box_professores">
        <br /><br />
        <a href="cursos_e_disciplinas.php?pg=unidade&cadastra=sim" class="a2">
            Atividade Bimestre
        </a>
        <?php if(@$_GET['cadastra']=='sim'){ ?>
        <br /><br />
        <h1>Atividade Bimestre</h1>
        <?php if(isset($_POST['cadastra'])){
                    $unidade=$_POST['unidade'];
                    $categoria=$_POST['categoria'];
                    $ano=Date('Y');
                    $data = date("d/m/Y H:i:s");
                    $date_hoje = date("d/m/Y");

                    $sql_verif="select * from unidades where unidade='$unidade'";
                    $con_verif=mysqli_query($conexao,$sql_verif);
                     if(mysqli_num_rows($con_verif)==''){
                    $sql="insert into unidades (unidade,status) values ('$unidade','status')";
                    $cad=mysqli_query($conexao,$sql);
                    if($cad<=0){
                    echo "<script language='javascript'>window.alert('erro ao cadastrar!');</script>";
                    }else{
                     echo "<script language='javascript'>window.alert('unidade criada com sucesso!');</script>";
                    //    echo "<script language='javascript'>window.location='cursos_e_disciplinas.php?pg=curso';</script>";
                    $sql_2="SELECT bimestre from atividades_bimestrais where bimestre='$unidade'";
                    $result2=mysqli_query($conexao,$sql_2);
                     if(mysqli_num_rows($result2)==''){       
                                                    $res = $pdo->prepare("SELECT DISTINCT c.id_cursos,p.code,d.id_disciplinas from categoria cat inner join cursos c on c.id_categoria=c.id_categoria inner join disciplinas d on d.id_cursos=c.id_cursos inner join professores p on p.id_professores=d.id_professores where cat.id_categoria=:categoria");

                                        $res->bindValue(":categoria", '2');
                                        $res->execute();

                                        $dados = $res->fetchAll(PDO::FETCH_ASSOC);
                                        $linhas = count($dados);
                                        
                                        foreach($dados AS $dado ){   
                        
                                            // $arr = filter( $_POST['excluir'] );
                                        // atividades bimestrais.
                                    $inseri=$pdo->prepare("INSERT INTO atividades_bimestrais (ano_letivo,bimestre,id_disciplina, id_curso,professor,data_aplicacao,data)
                                    values(:ano,:bimestre,:disciplina,:curso,:professor,:data_aplica,:data)");
                            
                                    $inseri->bindvalue(":ano",$ano);
                                    $inseri->bindvalue(":bimestre",$unidade);
                                    $inseri->bindvalue(":disciplina",$dado['id_disciplinas']);
                                    $inseri->bindvalue(":curso",$dado['id_cursos']);
                                    $inseri->bindvalue(":professor",$dado['code']);
                                    $inseri->bindvalue(":data_aplica",$data);
                                    $inseri->bindvalue(":data",$date_hoje);                        
                                     $inseri->execute();
                                    // fim atividades bimestrais
                                        // atividades coc.
                                        $inseri=$pdo->prepare("INSERT INTO avaliacao_coc (ano_letivo,bimestre,id_disciplina, id_curso,professor,data_aplicacao,data)
                                        values(:ano,:bimestre,:disciplina,:curso,:professor,:data_aplica,:data)");
                                
                                        $inseri->bindvalue(":ano",$ano);
                                        $inseri->bindvalue(":bimestre",$unidade);
                                        $inseri->bindvalue(":disciplina",$dado['id_disciplinas']);
                                        $inseri->bindvalue(":curso",$dado['id_cursos']);
                                        $inseri->bindvalue(":professor",$dado['code']);
                                        $inseri->bindvalue(":data_aplica",$data);
                                        $inseri->bindvalue(":data",$date_hoje);                        
                                         $inseri->execute();
                                        // fim atividades coc
                                            // atividades teste.
                                    $inseri=$pdo->prepare("INSERT INTO avaliacao_teste (ano_letivo,bimestre,id_disciplina, id_curso,professor,data_aplicacao,data)
                                    values(:ano,:bimestre,:disciplina,:curso,:professor,:data_aplica,:data)");
                            
                                    $inseri->bindvalue(":ano",$ano);
                                    $inseri->bindvalue(":bimestre",$unidade);
                                    $inseri->bindvalue(":disciplina",$dado['id_disciplinas']);
                                    $inseri->bindvalue(":curso",$dado['id_cursos']);
                                    $inseri->bindvalue(":professor",$dado['code']);
                                    $inseri->bindvalue(":data_aplica",$data);
                                    $inseri->bindvalue(":data",$date_hoje);                        
                                     $inseri->execute();
                                    // fim atividades teste
                                        // atividades prova.
                                        $inseri=$pdo->prepare("INSERT INTO avaliacao_prova (ano_letivo,bimestre,id_disciplina, id_curso,professor,data_aplicacao,data)
                                        values(:ano,:bimestre,:disciplina,:curso,:professor,:data_aplica,:data)");
                                
                                        $inseri->bindvalue(":ano",$ano);
                                        $inseri->bindvalue(":bimestre",$unidade);
                                        $inseri->bindvalue(":disciplina",$dado['id_disciplinas']);
                                        $inseri->bindvalue(":curso",$dado['id_cursos']);
                                        $inseri->bindvalue(":professor",$dado['code']);
                                        $inseri->bindvalue(":data_aplica",$data);
                                        $inseri->bindvalue(":data",$date_hoje);                        
                                        $inseri->execute();
                                        // fim atividades prova
                                            // atividades inter.
                                    $inseri=$pdo->prepare("INSERT INTO projetos_interdisciplinar (ano_letivo,bimestre,id_disciplina, id_curso,professor,data_aplicacao,data)
                                    values(:ano,:bimestre,:disciplina,:curso,:professor,:data_aplica,:data)");
                            
                                    $inseri->bindvalue(":ano",$ano);
                                    $inseri->bindvalue(":bimestre",$unidade);
                                    $inseri->bindvalue(":disciplina",$dado['id_disciplinas']);
                                    $inseri->bindvalue(":curso",$dado['id_cursos']);
                                    $inseri->bindvalue(":professor",$dado['code']);
                                    $inseri->bindvalue(":data_aplica",$data);
                                    $inseri->bindvalue(":data",$date_hoje);                        
                                    $inseri->execute();
                                    // fim atividades inter
                                        // atividades trans.
                                        $inseri=$pdo->prepare("INSERT INTO projetos_transversal (ano_letivo,bimestre,id_disciplina, id_curso,professor,data_aplicacao,data)
                                        values(:ano,:bimestre,:disciplina,:curso,:professor,:data_aplica,:data)");
                                
                                        $inseri->bindvalue(":ano",$ano);
                                        $inseri->bindvalue(":bimestre",$unidade);
                                        $inseri->bindvalue(":disciplina",$dado['id_disciplinas']);
                                        $inseri->bindvalue(":curso",$dado['id_cursos']);
                                        $inseri->bindvalue(":professor",$dado['code']);
                                        $inseri->bindvalue(":data_aplica",$data);
                                        $inseri->bindvalue(":data",$date_hoje);                        
                                        $inseri->execute();
                                        // fim atividades trans
                                            // $query ="INSERT INTO chamadas_em_sala (date, date_day, id_disciplinas, matricula, presente, ano_letivo) VALUES ('$date', '$date_hoje','$dis', '$dado', 'SIM','$ano')";
                                            // mysqli_query($conexao, $query);
                                    }
                                    echo "<script language='javascript'>window.alert('Atividades cadastradas');</script>";
                                }else{
                                 echo "<script language='javascript'>window.alert('ja existe atividades cadastradas');</script>";
                                }



                    }
                
                }else{
                //  echo "<script language='javascript'>window.alert('Esta unidade já existe');</script>";
               
                    switch ($categoria) {
                       
                            case 'todas':
                                $sql_2="SELECT bimestre from atividades_bimestrais where bimestre='$unidade'";
                                    $result2=mysqli_query($conexao,$sql_2);
                                     if(mysqli_num_rows($result2)==''){       
                                                                    $res = $pdo->prepare("SELECT DISTINCT c.id_cursos,p.code,d.id_disciplinas from categoria cat inner join cursos c on c.id_categoria=c.id_categoria inner join disciplinas d on d.id_cursos=c.id_cursos inner join professores p on p.id_professores=d.id_professores where cat.id_categoria=:categoria");

                                                        $res->bindValue(":categoria", '2');
                                                        $res->execute();

                                                        $dados = $res->fetchAll(PDO::FETCH_ASSOC);
                                                        $linhas = count($dados);
                                                        
                                                        foreach($dados AS $dado ){   
                                        
                                                            // $arr = filter( $_POST['excluir'] );
                                                        // atividades bimestrais.
                                                    $inseri=$pdo->prepare("INSERT INTO atividades_bimestrais (ano_letivo,bimestre,id_disciplina, id_curso,professor,data_aplicacao,data)
                                                    values(:ano,:bimestre,:disciplina,:curso,:professor,:data_aplica,:data)");
                                            
                                                    $inseri->bindvalue(":ano",$ano);
                                                    $inseri->bindvalue(":bimestre",$unidade);
                                                    $inseri->bindvalue(":disciplina",$dado['id_disciplinas']);
                                                    $inseri->bindvalue(":curso",$dado['id_cursos']);
                                                    $inseri->bindvalue(":professor",$dado['code']);
                                                    $inseri->bindvalue(":data_aplica",$data);
                                                    $inseri->bindvalue(":data",$date_hoje);                        
                                                     $inseri->execute();
                                                    // fim atividades bimestrais
                                                        // atividades coc.
                                                        $inseri=$pdo->prepare("INSERT INTO avaliacao_coc (ano_letivo,bimestre,id_disciplina, id_curso,professor,data_aplicacao,data)
                                                        values(:ano,:bimestre,:disciplina,:curso,:professor,:data_aplica,:data)");
                                                
                                                        $inseri->bindvalue(":ano",$ano);
                                                        $inseri->bindvalue(":bimestre",$unidade);
                                                        $inseri->bindvalue(":disciplina",$dado['id_disciplinas']);
                                                        $inseri->bindvalue(":curso",$dado['id_cursos']);
                                                        $inseri->bindvalue(":professor",$dado['code']);
                                                        $inseri->bindvalue(":data_aplica",$data);
                                                        $inseri->bindvalue(":data",$date_hoje);                        
                                                         $inseri->execute();
                                                        // fim atividades coc
                                                            // atividades teste.
                                                    $inseri=$pdo->prepare("INSERT INTO avaliacao_teste (ano_letivo,bimestre,id_disciplina, id_curso,professor,data_aplicacao,data)
                                                    values(:ano,:bimestre,:disciplina,:curso,:professor,:data_aplica,:data)");
                                            
                                                    $inseri->bindvalue(":ano",$ano);
                                                    $inseri->bindvalue(":bimestre",$unidade);
                                                    $inseri->bindvalue(":disciplina",$dado['id_disciplinas']);
                                                    $inseri->bindvalue(":curso",$dado['id_cursos']);
                                                    $inseri->bindvalue(":professor",$dado['code']);
                                                    $inseri->bindvalue(":data_aplica",$data);
                                                    $inseri->bindvalue(":data",$date_hoje);                        
                                                     $inseri->execute();
                                                    // fim atividades teste
                                                        // atividades prova.
                                                        $inseri=$pdo->prepare("INSERT INTO avaliacao_prova (ano_letivo,bimestre,id_disciplina, id_curso,professor,data_aplicacao,data)
                                                        values(:ano,:bimestre,:disciplina,:curso,:professor,:data_aplica,:data)");
                                                
                                                        $inseri->bindvalue(":ano",$ano);
                                                        $inseri->bindvalue(":bimestre",$unidade);
                                                        $inseri->bindvalue(":disciplina",$dado['id_disciplinas']);
                                                        $inseri->bindvalue(":curso",$dado['id_cursos']);
                                                        $inseri->bindvalue(":professor",$dado['code']);
                                                        $inseri->bindvalue(":data_aplica",$data);
                                                        $inseri->bindvalue(":data",$date_hoje);                        
                                                        $inseri->execute();
                                                        // fim atividades prova
                                                            // atividades inter.
                                                    $inseri=$pdo->prepare("INSERT INTO projetos_interdisciplinar (ano_letivo,bimestre,id_disciplina, id_curso,professor,data_aplicacao,data)
                                                    values(:ano,:bimestre,:disciplina,:curso,:professor,:data_aplica,:data)");
                                            
                                                    $inseri->bindvalue(":ano",$ano);
                                                    $inseri->bindvalue(":bimestre",$unidade);
                                                    $inseri->bindvalue(":disciplina",$dado['id_disciplinas']);
                                                    $inseri->bindvalue(":curso",$dado['id_cursos']);
                                                    $inseri->bindvalue(":professor",$dado['code']);
                                                    $inseri->bindvalue(":data_aplica",$data);
                                                    $inseri->bindvalue(":data",$date_hoje);                        
                                                    $inseri->execute();
                                                    // fim atividades inter
                                                        // atividades trans.
                                                        $inseri=$pdo->prepare("INSERT INTO projetos_transversal (ano_letivo,bimestre,id_disciplina, id_curso,professor,data_aplicacao,data)
                                                        values(:ano,:bimestre,:disciplina,:curso,:professor,:data_aplica,:data)");
                                                
                                                        $inseri->bindvalue(":ano",$ano);
                                                        $inseri->bindvalue(":bimestre",$unidade);
                                                        $inseri->bindvalue(":disciplina",$dado['id_disciplinas']);
                                                        $inseri->bindvalue(":curso",$dado['id_cursos']);
                                                        $inseri->bindvalue(":professor",$dado['code']);
                                                        $inseri->bindvalue(":data_aplica",$data);
                                                        $inseri->bindvalue(":data",$date_hoje);                        
                                                        $inseri->execute();
                                                        // fim atividades trans
                                                            // $query ="INSERT INTO chamadas_em_sala (date, date_day, id_disciplinas, matricula, presente, ano_letivo) VALUES ('$date', '$date_hoje','$dis', '$dado', 'SIM','$ano')";
                                                            // mysqli_query($conexao, $query);
                                                    }
                                                    echo "<script language='javascript'>window.alert('Atividades cadastradas');</script>";
                                                }else{
                                                 echo "<script language='javascript'>window.alert('ja existe atividades cadastradas');</script>";
                                                }
                                                    
                
                                break;
                     
                        default:
                            # code...
                            break;
                    }
                
               
                    }
                } ?>
        <form name="form1" accept-charset="utf-8" method="post" action="">
            <table class="users" id="table-responsive" border="0">

                <tr>

                    <td class="row-1 row-cur">Bimestres</td>
                    <td class="row-1 row-cur">Categoria</td>
                </tr>

                <tr>

                    <td class="row-1 row-cur">
                        <select name="unidade" size="1" id="turno">
                            <option value="1">I unidade</option>
                            <option value="2">II unidade</option>
                            <option value="3">III unidade</option>
                            <option value="4">IV unidade</option>
                        </select>
                    </td>
                    <td class="row-1 row-cur">
                        <select name="categoria" size="1" id="categoria">
                            <option value="todas">Criar todas atividades</option>
                        </select>
                    </td>
                    <td class="row-1 row-cur"><input class="input" type="submit" name="cadastra" id="button"
                            value="Cadastrar"></td>
                </tr>

            </table>
        </form>
        <br />
        <?php die;}
            ?>
        <!--visualizar cursos cadastrados -->
        <?php 
            $sql_1="select * from unidades";
            $result=mysqli_query($conexao,$sql_1);
                if(mysqli_num_rows($result)<=0 ){
                    # code...
                    echo "<br><br>No momento não existe nenhum curso cadastrado! <br><br>";
                } else {
                               
         ?>
        <br /><br />
        <h1>Turmas</h1>
        <table class="users" id="table-responsive" border="0">

            <tr>
                <td class="row-1 row-ID"><strong>Bimestres:</strong></td>
                <td class="row-2 row-ID"><strong>Total de atividade deste Bimestre:</strong></td>

                <td class="row-4 row-ID">&nbsp;</td>
            </tr>


            <?php while($res_1 = mysqli_fetch_assoc($result)){
                    
                ?>

            <tr>
                <td class="row-cur">
                    <h3>
                        <?php echo $curso = $res_1['unidade'].' bimestre';
                        
                        ?>
                    </h3>
                </td>
                <td class="row-name">
                    <h3><?php $sql_2="SELECT bimestre from atividades_bimestrais where bimestre='$curso'";
                    $result2=mysqli_query($conexao,$sql_2);
                    echo mysqli_num_rows($result2); ?>
                    </h3>
                </td>

            </tr>
            <?php }?>

        </table>
        <br /><br />
        <?php } ?>

        <!deleção dos cursos>
            <?php 
        if (@$_GET['deleta']=='cur') {
            # code...
            $id=@$_GET['id'];

            $sql_3="delete from cursos where id_cursos='$id'";
            mysqli_query($conexao, $sql_3);

                echo "<script language='javascript'>window.location='cursos_e_disciplinas.php?pg=curso';</script>";
        }?>

    </div>
    <!--box_curso-->
    <?php } ?>


    <!-- fim cadastra unidades -->

    <!-- criar categoria  -->
    <!-- <?php if(@$_GET['pg']=='categoria'){   ?>
        <div class="box_professores">
            <br /><br/>
            <a href="cursos_e_disciplinas.php?pg=categoria&cadastra=sim" class="a2">
                    Cadastrar Categoria
            </a>
             <?php if(@$_GET['cadastra']=='sim'){ ?>
             <br/><br/>
                <h1>Cadastrar Categoria</h1>
                <?php if(isset($_POST['cadastra'])){
                    
                    $categoria=$_POST['categoria'];

                    $sql_verif="select * from categoria where categoria='$categoria'";
                    $con_verif=mysqli_query($conexao,$sql_verif);
                     if(mysqli_num_rows($con_verif)==''){

                    $sql="insert into categoria (categoria) values ('$categoria')";
                    if($curso==''){
                            echo "<script language='javascript'>window.alert('Digite o nome da categoria!');</script>";
                    }else{
                    $cad=mysqli_query($conexao,$sql);
                    if($cad<=0){
                    echo "<script language='javascript'>window.alert('erro ao cadastrar!');</script>";
                    }else{
                     echo "<script language='javascript'>window.alert('categoria inserido com sucesso!');</script>";
                       echo "<script language='javascript'>window.location='cursos_e_disciplinas.php?pg=categoria';</script>";
                    }
                }
                }else{
                 echo "<script language='javascript'>window.alert('Esta categoria ja existe, altere o categoria');</script>";
                    }
                } ?>
                <form name="form1" method="post" action="">
                    <table width="900" border="0">
                        <tr>                           
                            <td width="134">Categoria</td>
                        </tr>
                        <tr>
                            <td>
                                <select name="categoria" size="1" id="categoria">
                                    <option value="fundamental-inicial">Fundamental-Inicial</option>
                                    <option value="fundamental-final">Fundamental-Final</option>
                                    <option value="ensino-medio-inicial">Ensino-Medio-Inicial</option>
                                    <option value="ensino-medio-final">Ensino-Medio-Final</option>
                                </select>
                            </td>
                            <td><input class="input" type="submit" name="cadastra" id="button" value="Cadastrar"></td>
                        </tr>
                    </table>
                </form>
                    <br/>
             <?php die;}
             else{?>
             <?php if(@$_GET['cadastra']=='nao'){?>
              <br/><br/>
                <h1>Atualiza categoria</h1>
                <?php
                    $id=$_GET['id'];
                    $sql_cat="select * from categoria where id_categoria='$id'";
                    $sql_con=mysqli_query($conexao,$sql_cat);
                    while($edit_categoria=mysqli_fetch_assoc($sql_con)){?>
                <?php if(isset($_POST['atualiza'])){
                    $categoria=$_POST['categoria'];
                    $sql_verif="select * from categoria where categoria='$categoria'";
                    $con_verif=mysqli_query($conexao,$sql_verif);
                     if(mysqli_num_rows($con_verif)==''){
                    $sql="update categoria set categoria='$categoria' where id_categoria='$id'";
                    if($categoria==''){
                            echo "<script language='javascript'>window.alert('Digite o nome da Categoria!');</script>";
                    }else{
                    $cad=mysqli_query($conexao,$sql);
                    if($cad<=0){
                    echo "<script language='javascript'>window.alert('erro ao cadastrar!');</script>";
                    }else{
                     echo "<script language='javascript'>window.alert('categoria atualizado com sucesso!');</script>";
                       echo "<script language='javascript'>window.location='cursos_e_disciplinas.php?pg=categoria';</script>";
                    }
                }
                }else{
                    echo "<script language='javascript'>window.alert('Esta categoria ja existe!');</script>";
                }
                } ?>
                <form name="form1" method="post" action="">
                    <table width="900" border="0">
                        <tr>
                            <td width="134">Categoria</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="curso"  id="textfield" value="<?php echo $edit_curso['curso'];?>"></td>
                            <td>
                                <select name="turno" size="1" id="turno">
                                    <option value="<?php echo $edit_categoria['categoria'];?>"><?php echo $edit_categoria['categoria'];?></option>
                                    <option value="fundamental-inicial">Fundamental-Inicial</option>
                                    <option value="fundamental-final">Fundamental-Final</option>
                                    <option value="ensino-medio-inicial">Ensino-Medio-Inicial</option>
                                    <option value="ensino-medio-final">Ensino-Medio-Final</option>
                                </select>
                            </td>
                            <td><input class="input" type="submit" name="atualiza" id="button" value="Atualizar"></td>
                        </tr>

                    </table>
                    <?php } ?>
                </form>
                    <br/>
             
             <?php
             die;}}
             ?>
  --visualizar cursos cadastrados -->
    <?php 
            $sql_1="select * from categoria";
            $result=mysqli_query($conexao,$sql_1);
                if(mysqli_num_rows($result)<=0 ){
                    # code...
                    echo "<br><br>No momento não existe nenhum categoria cadastrada! <br><br>";
                } else {
                               
         ?>
    <br /><br />
    <h1>Categoria</h1>
    <table width="900" border="0">
        <tr>
            <td><strong>Categoria:</strong></td>
            <td><strong>Total de cursos desta Categoria:</strong></td>
            <td>&nbsp;</td>
        </tr>
        <?php while($res_1 = mysqli_fetch_assoc($result)){
                    $cursos_id=$res_1['id_categoria'];
                ?>

        <tr>
            <td>
                <h3>
                    <?php echo $curso = $res_1['categoria'];
                        
                        ?>
                </h3>
            </td>
            <td>
                <h3><?php $sql_2="select * from cursos where id_categoria='$cursos_id'";
                    $result2=mysqli_query($conexao,$sql_2);
                    echo mysqli_num_rows($result2); ?>
                </h3>
            </td>
            <td>
                <a class="a" href="cursos_e_disciplinas.php?pg=curso&deleta=cur&id=<?php echo @$res_1['id_cursos'];?>">
                    <img title="Excluir curso" src="img/deleta.jpg" width="18" heigth="18" border="0" alt=""></a>
            </td>
            <td>
                <a class="a"
                    href="cursos_e_disciplinas.php?pg=curso&cadastra=nao&id=<?php echo $res_1['id_cursos'];?>"><img
                        title="Editar dados Cadastrais" src="../image/ico-editar.png" width="18" height="18"
                        border="0"></a>
            </td>
        </tr>
        <?php }?>
    </table>
    <br /><br />
    <?php } ?>

    <!-- <?php } ?> -->

    <!-- fim de categoria -->
    <!-- <!________________________________CADASTRAR DISCIPLINAS_________________________________________________> -->


        <?php  
    if (@$_GET['pg']=='disciplina') {?>

        <div class="box_professores">
            <a class="a2" href="cursos_e_disciplinas.php?pg=disciplina&cadastra=sim">
                Cadastrar disciplina</a>
            <?php if(@$_GET['cadastra']=='sim'){?>

            <h1>Cadastrar nova disciplina</h1>

            <?php if(isset($_POST['cadastra'])) {
                
                $curso=$_POST['curso'];
                $disciplina=$_POST['disciplina'];
                $professor=$_POST['professor'];
                $sala=$_POST['sala'];
                
                $sql_disc1="select * from disciplinas where disciplina='$disciplina' and id_professores='$professor' and sala='$sala'";
                $con_disc1=mysqli_query($conexao,$sql_disc1);
                if(mysqli_num_rows($con_disc1)==''){
                if ($disciplina=='') {
                    echo "<script language='javascript'>window.alert('Digite o nome da disciplica'); </script>";
                }else if($sala==''){
                    echo "<script language='javascript'>window.alert('Digite o numero da sala'); </script>";
                }else{
                    $sql_cad_disc="insert into disciplinas (id_cursos,disciplina,id_professores,sala)
                     values ('$curso','$disciplina','$professor','$sala')";
                    $cad_disc=mysqli_query($conexao,$sql_cad_disc);

                    if($cad_disc<=0){
                        echo "<script language='javascript'>window.alert('Ocorreu um erro!');</script>";
                    }else{
                        echo "<script language='javascript'>window.alert('Disciplina e Professor foram vinculados.');</script>";
                       echo "<script language='javascript'>window.location='cursos_e_disciplinas.php?pg=disciplina';</script>";
                    }

                }

            }
            else{
             echo "<script language='javascript'>window.alert('Dados existentes, cadastre um novo!');</script>";
            }    
            }    
            ?>

            <form name="form1" accept-charset="utf-8" method="post">
                <table class="users" id="table-responsive" border="0">

                    <tr>
                        <td class="row-1 row-cod">Turma:</td>
                        <td class="row-2 row-name">Disciplina:</td>
                        <td class="row-3 row-name">Professor:</td>
                        <td class="row-4 row-ID"> Sala: <em>Apenas o numero</em></td>
                        <td class="row-1 row-ID">&nbsp</td>
                        <td colspan="2"></td>
                    </tr>


                    <tr>
                        <td>
                            <select name="curso" onchange="submit();">
                                <?php 
                        if(isset($_POST['curso'])){
                           echo  $sql_curso="select * from cursos where id_cursos=".$_POST['curso'];
                            $result_curso = mysqli_query($conexao,$sql_curso);
                            while($r_c=mysqli_fetch_assoc($result_curso)){
                                ?>
                                <option value="<?php echo $r_c['id_cursos']; ?>">
                                    <?php echo $r_c['curso'];?></option>
                                <?php
                                }
                         }else{
                                echo ' <option value="">Selecione uma turma</option>';
                         }
                        
                       echo $busca_curso="select * from cursos";
                        $r_curso = mysqli_query($conexao,$busca_curso);

                            while($r_c=mysqli_fetch_assoc($r_curso)){
                    ?>
                                <option value="<?php echo $r_c['id_cursos']; ?>">
                                    <?php echo $r_c['curso'].' '.$r_c['turno'];?></option>
                                <?php  }?>
                            </select>
                        </td>
                        <td>
                            <select name="disciplina">
                                <?php 
                    $l=$_POST['curso'];
                        $sql_rec_dis="SELECT * FROM lista_disc l inner join cursos c on l.categoria=c.id_categoria where c.id_cursos='$l' order by nome asc";
                        $result_rec_dis = mysqli_query($conexao,$sql_rec_dis);

                            while($l2=mysqli_fetch_assoc($result_rec_dis)){
                    ?>
                                <option value="<?php echo $l2['id_lista']; ?>"><?php echo $l2['nome'];?></option>
                                <?php  }?>
                            </select>
                        </td>
                        <td width="143">
                            <select name="professor">
                                <?php 
                                $sql_result_prof="SELECT * FROM `professores`where nome!=''";
                                $sql_rec_prof=mysqli_query($conexao,$sql_result_prof);
                                while ($r3=mysqli_fetch_assoc($sql_rec_prof)) {?>
                                <option value="<?php echo $r3['id_professores'];?>"><?php echo $r3['nome'];?>
                                </option>
                                <?php  } ?>

                            </select>
                        </td>
                        <td><input type="text" name="sala" id="sala" maxlength="4" size="4"></td>

                        <td><input class="btn btn-success" type="submit" name="cadastra" id="button" value="Cadastrar">
                        </td>
                    </tr>

                </table>
            </form>
            <br /><br /><br />
        </div>
        <?php die;} else{?>


        <!editar DISCIPLINAS______________________________________________________________________________>



            <?php if(@$_GET['cadastra']=='nao'){?>

            <h1>Atualizar disciplina</h1>
            <?php $id=$_GET['id'];
                    $sql_disc="select * from disciplinas where id_disciplinas='$id'";
                    $con_disc=mysqli_query($conexao,$sql_disc);
                    while($edit_disc=mysqli_fetch_assoc($con_disc)){
                ?>
            <?php  
                if(isset($_POST['atualiza'])) {
                            $id=$_GET['id'];
                            $curso=$_POST['curso'];
                            $disciplina=$_POST['disciplina'];
                            $professor=$_POST['professor'];
                            $sala=$_POST['sala'];
                            $sql_disc1="select * from disciplinas where disciplina='$disciplina' and 
                            id_professores='$professor' and sala='$sala'";
                            $con_disc1=mysqli_query($conexao,$sql_disc1);
                            if(mysqli_num_rows($con_disc1)==0){
                                if ($disciplina=='') {
                                        echo "<script language='javascript'>window.alert('Digite o nome da disciplica'); </script>";
                                }else if($sala==''){
                                        echo "<script language='javascript'>window.alert('Digite o numero da sala'); </script>";
                                }else{
                                        $sql_cad_disc="update disciplinas set id_cursos='$curso', disciplina='$disciplina',id_professores='$professor',sala='$sala' where id_disciplinas='$id'";
                                        $cad_disc=mysqli_query($conexao,$sql_cad_disc);

                                    if($cad_disc<=0){
                                            echo "<script language='javascript'>window.alert('Ocorreu um erro!');</script>";
                                    }else{
                                            echo "<script language='javascript'>window.alert('Disciplina atualizada com sucesso!');</script>";
                                        echo "<script language='javascript'>window.location='cursos_e_disciplinas.php?pg=disciplina';</script>";
                                    }

                                }

                            }else{
                                echo "<script language='javascript'>window.alert('Estes dado ja esta cadastrado!!!');</script>";

                            }
                }        
            ?>

            <form name="form1" accept-charset="utf-8" method="post">
                <table class="users" id="table-responsive" border="0">

                    <tr>
                        <td class="row-1 row-cod">Turma:</td>
                        <td class="row-2 row-name">Disciplina:</td>
                        <td class="row-3 row-name">Professor:</td>
                        <td class="row-4 row-ID"> Sala: <em>Apenas o numero</em></td>
                        <td class="row-1 row-ID">&nbsp</td>
                        <td colspan="2"></td>
                    </tr>

                    <tr>
                        <td>
                            <select name="curso" onchange="submit();">

                                <?php
                     if(@$_POST['curso']){
                            $sql_rec_curso="select * from cursos where id_cursos=".$_POST['curso'];
                            $result_rec_curso = mysqli_query($conexao,$sql_rec_curso);
                            while($r2=mysqli_fetch_assoc($result_rec_curso)){
                                ?>
                                <option value="<?php echo $r2['id_cursos']; ?>">
                                    <?php echo $r2['curso'].' '.$r2['turno'];?></option>
                                <?php
                                }
                         }
                         $turma=$edit_disc['id_cursos'];
                               $sql_busca_turma="select * from cursos where id_cursos='$turma'";
                             $con_busca_turma=mysqli_query($conexao,$sql_busca_turma);
                             while($res_busca_turma=mysqli_fetch_assoc($con_busca_turma)){
                         ?>

                                <option value="<?php echo $res_busca_turma['id_cursos'];?>">
                                    <?php echo $res_busca_turma['curso'].' - '.$res_busca_turma['turno'];?></option>
                                <?php
                         }
                      ?>

                                <?php 
                       $sql_busca_turma2="select * from cursos";
                        $result_rec_curso = mysqli_query($conexao,$sql_busca_turma2);

                            while($r2=mysqli_fetch_assoc($result_rec_curso)){
                    ?>
                                <option value="<?php echo $r2['id_cursos']; ?>">
                                    <?php echo $r2['curso'].' ', $r2['turno'];?></option>
                                <?php  }?>
                            </select>
                        </td>
                        <td>
                            <select name="disciplina">
                                <?php  
                                 $d=$edit_disc['disciplina'];
                                 $sql_busca_d="select * from lista_disc where id_lista='$d'";
                                 $con_busca_d=mysqli_query($conexao,$sql_busca_d);
                                  while($res_busca_d=mysqli_fetch_assoc($con_busca_d)){
                                  ?>
         
                                         <option value="<?php echo $res_busca_d['id_lista'];?>">
                                             <?php echo $res_busca_d['nome'];?></option>
                                         <?php
                                  }
                            
                            ?>
                               
                                <?php 
                    $l=$_POST['curso'];
                        $sql_rec_dis="SELECT l.id_lista,l.nome FROM lista_disc l inner JOIN cursos c on c.id_categoria=l.categoria where c.id_cursos='$l' order by l.nome asc";
                        $result_rec_dis = mysqli_query($conexao,$sql_rec_dis);

                            while($l2=mysqli_fetch_assoc($result_rec_dis)){
                    ?>
                                <option value="<?php echo $l2['id_lista']; ?>"><?php echo $l2['nome'];?></option>
                                <?php  }?>
                            </select>
                        </td>
                        <td width="143">
                            <select name="professor">
                                <?php $code=$edit_disc['id_professores']; 
                            $sql_proc_prof="select nome,id_professores from professores where id_professores='$code'";
                            $con_proc_prof=mysqli_query($conexao,$sql_proc_prof);
                            while ($proc_prof=mysqli_fetch_assoc($con_proc_prof)){
                            ?>
                                <option value="<?php echo $proc_prof['id_professores']; ?>">
                                    <?php echo $proc_prof['nome'];?></option> <?php
                            }
                        ?>
                                <?php 
                                $sql_result_prof="SELECT * FROM `professores`where nome!=''";
                                $sql_rec_prof=mysqli_query($conexao,$sql_result_prof);
                                while ($r3=mysqli_fetch_assoc($sql_rec_prof)) {?>
                                <option value="<?php echo $r3['id_professores'];?>"><?php echo $r3['nome'];?>
                                </option>
                                <?php  } ?>

                            </select>
                        </td>
                        <td><input type="text" name="sala" id="textfield" maxlength="4" size="4"
                                value="<?php echo $edit_disc['sala'];?>"></td>

                        <td><input class="btn btn-danger" type="submit" name="atualiza" id="button" value="Atualizar">
                        </td>
                    </tr>

                </table>
                <?php } ?>
            </form>
            <br /><br /><br />
            </div>
            <?php die;}} ?>

            <!-- <!MOSTRAR AS DICIPLINAS NA TABELA> -->

            <br /><br />
            <h1>Disciplina</h1>
            <form name="button" accept-charset="utf-8" method="post" action="" enctype="multipart/form-data">
                <table class="users" id="table-responsive" border="0">
                    <tr>
                        <td><strong>Professor</strong></td>
                        <td><strong>Turma</strong></td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td><input type="text" class="pesq" name="nome" value=""
                                placeholder="pesquise pelo nome aqui ou escolha a turma"></td>
                        <td>
                            <select name="turma" class="pesq" id="select2">
                                <?php if(isset($_GET['turma'])){
        $t=$_GET['turma'];
        ?> <option value="<?php echo $_GET['turma']; ?>"><?php $sql_2 = mysqli_query($conexao, "SELECT curso FROM cursos where id_cursos='$t'");
	  	   while($res_2 = mysqli_fetch_assoc($sql_2)){ echo $res_2['curso'];}}?></option>
                                <?php
      $sql_2 = mysqli_query($conexao, "SELECT * FROM cursos");
	  	while($res_2 = mysqli_fetch_assoc($sql_2)){
	  ?>
                                <option value="<?php echo $res_2['id_cursos']; ?>"><?php echo $res_2['curso']; ?>
                                </option>
                                <?php } ?>
                            </select>
                        </td>
                        <td><input class="input" type="submit" name="button" id="button" value="Filtrar"></td>
                    </tr>
                </table>
            </form>
            <?php if(isset($_POST['button'])){

$tipo = $_POST['nome'];
$serie = $_POST['turma'];

$s = base64_encode('filtro');

echo "<script language='javascript'>window.location='cursos_e_disciplinas.php?pg=disciplina&s=$s&status=$tipo&turma=$serie';</script>";

}?>
            <?php 
                // $s = base64_decode($_GET['s']);;
                    if(isset($_GET['s'])){ 
                        $tipo=$_GET['status'];
                        $serie=$_GET['turma'];
                        if($tipo==''){
                                $s="SELECT d.* from disciplinas d inner join cursos c ON c.id_cursos=d.id_cursos INNER JOIN professores p ON d.id_professores=p.id_professores where  c.id_cursos='$serie' order by d.disciplina asc ";
                                $sql_1 = mysqli_query($conexao, $s);
                        }else{          
                            $s="SELECT d.* from disciplinas d inner join cursos c ON c.id_cursos=d.id_cursos INNER JOIN professores p ON d.id_professores=p.id_professores where p.nome like '%".$tipo."%' order by d.disciplina asc ";
                            $sql_1 = mysqli_query($conexao, $s);
                        
                        }
                        
                    }else{
                        $s="SELECT d.*,c.id_cursos from disciplinas d inner join lista_disc l ON l.id_lista=d.disciplina INNER JOIN cursos c on c.id_cursos=d.id_cursos INNER JOIN professores p ON d.id_professores=p.id_professores ORDER BY l.nome asc";
                        $sql_1 = mysqli_query($conexao, $s);
                    }
                if(mysqli_num_rows($sql_1)==''){
                    echo "<h2>No momento não existe nenhuma disciplina cadastrada!</h2><br><br>";
                }else{
                ?>
            <table class="users" id="table-responsive" border="0">

                <tr>
                    <td class="row-1 row-name"><strong>Turma:</strong></td>
                    <td class="row-2 row-name"><strong>Turno:</strong></td>
                    <td class="row-3 row-ID"><strong>Disciplina:</strong></td>
                    <td class="row-4 row-name"><strong>Professor:</strong></td>
                    <td class="row-2 row-name"><strong>Sala:</strong></td>
                    <td class="row-1 row-ID">&nbsp</td>
                    <td class="row-1 row-ID">&nbsp</td>
                </tr>

                <?php while($res_busca=mysqli_fetch_assoc($sql_1)){?>
                <tr>
                    <td class="row-name">
                        <h3>

                            <?php 
                            $turma=$res_busca['id_cursos'];
                             $sql_busca_turma="select curso,turno from cursos where id_cursos='$turma'";
                                     $con_busca_turma=mysqli_query($conexao,$sql_busca_turma);
                                    while($res_busca_turma=mysqli_fetch_assoc($con_busca_turma)){
                         ?>

                            <?php echo $res_busca_turma['curso'];?>
                        </h3>
                    </td>

                    <td class="row-name">
                        <h3>
                            <?php echo $res_busca_turma['turno'];?>
                        </h3>
                    </td>
                    <?php }?>
                    <td class="row-ID">
                        <h3>
                        <?php 
                            $d=$res_busca['disciplina'];
                             $sql_busca_d="select nome from lista_disc where id_lista='$d'";
                                     $con_busca_d=mysqli_query($conexao,$sql_busca_d);
                                    while($res_busca_turma=mysqli_fetch_assoc($con_busca_d)){
                         ?>

                            <?php echo $res_busca_turma['nome'];}?>    
                      </h3>
                    </td>
                    <td class="row-name">
                        <h3>
                            <?php
                                    $professor=$res_busca['id_professores'];
                                    $sql_busca_prof="select * from professores where id_professores='$professor'";
                                    $result_buscar_prof=mysqli_query($conexao,$sql_busca_prof);
                                    while($res_busca2=mysqli_fetch_assoc($result_buscar_prof)){
                                        echo $res_busca2['nome']; echo " - "; echo $res_busca2['code'];
                                    }
                                    
                                ?>

                        </h3>
                    </td>
                    <td class="row-name">
                        <h3><?php echo $res_busca['sala'];?></h3>
                    </td>
                    <td class="row-cod"><a class="a"
                            href="cursos_e_disciplinas.php?pg=disciplina&deleta=sim&id=<?php echo $res_busca['id_disciplinas']; ?>"><img
                                title="Excluir Disciplina" src="img/deleta.jpg" width="18" height="18" border="0"
                                alt=""></a></td>
                    <td class="row-cod">
                        <a class="a"
                            href="cursos_e_disciplinas.php?pg=disciplina&cadastra=nao&id=<?php echo $res_busca['id_disciplinas'];?>"><img
                                title="Editar dados Cadastrais" src="../image/ico-editar.png" width="18" height="18"
                                border="0"></a>
                    </td>
                </tr>
                <?php }?>

            </table>
            <?php } ?>

            <br /><br />



            <!deleção dos disciplinas_____________________________________________________________>
                <?php 
        if (@$_GET['deleta']=='sim') {
            # code...
            $id=@$_GET['id'];
            $sql_delete_disc="delete from disciplinas where id_disciplinas='$id'";
            mysqli_query($conexao, $sql_delete_disc);
                echo "<script language='javascript'>window.location='cursos_e_disciplinas.php?pg=disciplina';</script>";
        }?>

                </div>
                <!--disciplinas-->
                <?php } ?>






            <!--    <!MOSTRAR OS CURSOS E AS DISCIPLINAS> -->


                    <?php if(@$_GET['pg'] == 'cursoedisciplinas'){ ?>
                    <div class="box_professores">
                        <h1>Cursos e Disciplinas</h1>

                        <?php
$sql_ced = "SELECT * FROM cursos";
$result_ced = mysqli_query($conexao,  $sql_ced);
if(mysqli_num_rows($result_ced) == ''){
	echo "Não existe nenhum curso cadastrado no momento!";
}else{
?>
                        <table class="users" id="table-responsive" border="0">
                            <?php while($rs_ced = mysqli_fetch_assoc($result_ced)){
    $cursos_id=$rs_ced['id_cursos'];$turno=$rs_ced['turno'];
 ?>
                            <tr>
                                <td>Turma: <?php echo $curso = $rs_ced['curso'].     '  |  Turno:'.$turno; ?></td>
                            </tr>
                            <tr>
                                <td>
                                    <textarea disabled="disabled" name="textarea" cols="100" rows="5">
    <?php
     $sql_ced_prof = "SELECT * FROM disciplinas WHERE id_cursos = '$cursos_id'";
	 $result_ced_prof = mysqli_query($conexao,  $sql_ced_prof);
	 	while($rs_ced2 = mysqli_fetch_assoc($result_ced_prof)){
		
			$professor = $rs_ced2['id_professores'];
						
			echo $rs_ced2['disciplina']; 
			echo " - ";
	$sql_ced_cod = "SELECT * FROM professores WHERE id_professores = '$professor'";
	$result_ced_cod = mysqli_query($conexao,  $sql_ced_cod);
		while($rs_ced3 = mysqli_fetch_assoc($result_ced_cod)){
			echo $rs_ced3['nome'];
			echo " - ";
			echo $rs_ced3['code'];
            echo "    ";
			
		
		  }
          }
		
	?>
    </textarea>
                                </td>
                            </tr>
                            <?php } ?>
                        </table>
                        <br />
                        <?php } ?>

                    </div><!-- box_curso_e_disciplinas -->
                    <?php } ?>
                    </div>
                    <?php require_once "rodape.php"; ?>
</body>

</html>