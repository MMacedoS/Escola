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
    
    ini_set('default_charset','utf-8');
   require_once("topo.php");?>

    <!--cadastrar disciplinas  lista-->


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
        <form name="form1" method="post" action="">
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
        <form name="form1" method="post" action="">
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
        <form name="button" method="post" action="" enctype="multipart/form-data">
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
                            $busca_cat=$pdo->prepare("SELECT categoria FROM  categoria WHERE id_categoria=:categoria");
                            $busca_cat->bindValue(':categoria',$categoria);
                            $busca_cat->execute();
                        while ($res_cate=$busca_cat->fetch()){
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
            try {
                //code...
            
            $sql_3=$pdo->prepare("delete from lista_disc where id_lista=:id");
            $sql_3->bindValue('id',$id);
            $sql_3->execute();
            echo "<script language='javascript'>window.location='cursos_e_disciplinas.php?pg=cad_disc';</script>";
        } catch (\Throwable $th) {
            //throw $th;
            echo "<script language='javascript'>alert('erro ao apagar $th');</script>";
        }
            

                
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
                    $turno=$_POST['turno'];
                    $categoria=$_POST['categoria'];
                    try {
                        //code...
                   
                    $sql_verif=$pdo->prepare("SELECT * FROM cursos WHERE curso=:curso AND turno=:turno");
                    $sql_verif->bindValue(':curso',$curso);
                    $sql_verif->bindValue(':turno',$turno);
                    $sql_verif->execute();
                    $verif=$sql_verif->fetchAll();
                    $con_verif=count($verif);
                     if($con_verif==0){
                    $inserir=$pdo->prepare('INSERT INTO cursos (curso,turno,id_categoria) VALUES(:curso,:turno,:categoria)');
                    $inserir->bindValue(':curso',$curso);
                    $inserir->bindValue(':turno',$turno);
                    $inserir->bindValue(':categoria',$categoria);
                    
                    if($curso==''){
                            echo "<script language='javascript'>window.alert('Digite o nome da Turma!');</script>";
                    }else{
                        $inserir->execute();                    
                     echo "<script language='javascript'>window.alert('Turma inserida com sucesso!');</script>";
                       echo "<script language='javascript'>window.location='cursos_e_disciplinas.php?pg=curso';</script>";
                    
                    }
                }else{
                    echo "<script language='javascript'>window.alert('Este curso ja existe, altere o curso');</script>";
                    }
                } catch (\Throwable $th) {
                    //throw $th;
                    
                }
                } ?>
        <form name="form1" method="post" action="">
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
                    try {
                        //code...
                   
                    $sql_edit=$pdo->prepare("SELECT * FROM cursos where id_cursos=:id");
                    $sql_edit->bindValue(':id',$id);
                    $sql_edit->execute();
                    while($edit_curso=$sql_edit->fetch()){?>
        <?php if(isset($_POST['atualiza'])){
                     $curso=$_POST['curso'];
                     $turno=$_POST['turno'];
                     $categoria=$_POST['categoria'];
                     $sql_verif=$pdo->prepare("SELEC * FROM cursos where curso=:curso and turno=:turno and id_categoria=:categoria");
                     $sql_verif->bindValue(':curso',$curso);
                     $sql_verif->bindValue(':turno',$turno);
                     $sql_verif->bindValue(':categoria',$categoria);
                     $sql_verif->execute();
                     $dado=$sql_verif->fetchAll();
                     echo $dados=count($dado);
                    if($dados==0){
                        if($curso==' '){
                            echo "<script language='javascript'>window.alert('Digite o nome da Turma!');</script>";
                        }else{
                            try {
                                //code...
                                $sql=$pdo->prepare("UPDATE cursos SET curso=:curso, turno=:turno, id_categoria=:categoria WHERE id_cursos=:id");
                                $sql->bindValue(':curso',$curso);
                                $sql->bindValue(':turno',$turno);
                                $sql->bindValue('categoria',$categoria);
                                $sql->bindValue(':id',$_GET['id']);
                                $sql->execute();
                                echo "<script language='javascript'>window.alert('Curso atualizado com sucesso!');</script>";
                                echo "<script language='javascript'>window.location='cursos_e_disciplinas.php?pg=curso';</script>";
                            } catch (\Throwable $th) {
                                //throw $th;
                                echo "<script language='javascript'>window.alert('erro ao cadastrar! $th');</script>";
                            }
                    
                        }
                    }else{
                    echo "<script language='javascript'>window.alert('Este Curso ja existe!');</script>";
                }
                } ?>
        <form name="form1" method="post" action="">
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
                    <select name="cate" size="1" id="categoria">
                            <?php 
                                    $cate=$edit_curso['id_categoria'];
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
         } catch (\Throwable $th) {
            //throw $th;
            echo "<script language='javascript'>window.alert('erro na busca da turma, $th');</script>";
        }
             die;}}
             ?>
        <!--visualizar cursos cadastrados -->
        <br/><br/>
        <form name="button" method="post" action="" enctype="multipart/form-data">
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
                                <?php 
                                $sql_2=$pdo->prepare("SELECT curso,id_cursos FROM cursos where id_cursos=:id");
                                $sql_2->bindValue(':id',$t);
                                $sql_2->execute();
                    while($res_2 = $sql_2->fetch()){ 
                            echo $res_2['curso'];}
                            }?></option>
                               <option value="">Todos</option>
                            <?php
                            $sql_2=$pdo->query("SELECT * FROM cursos");
                            $sql_2->execute();
                            
                    while($res_2 = $sql_2->fetch()){
                ?>
                            <option value="<?php echo $res_2['id_cursos']; ?>"><?php echo $res_2['curso']; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </td>
                    <td>
                    <select name="categoria" size="1" id="categoria">

                                <?php 
                                if(@$_GET['tur']){
                                        $cate=$_GET['tur'];
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
                                $s=$pdo->prepare("SELECT * FROM cursos WHERE id_categoria=:categoria ORDER BY curso ASC");
                                $s->bindValue(':categoria',$c_cate);
                                $s->execute();
                                $dados= $s->fetch();
                                $s="SELECT * from cursos where  id_categoria='$c_cate'  order by curso asc ";
                                $sql_1 = mysqli_query($conexao, $s);
                        }else{          
                            $s="SELECT * from cursos where id_cursos ='$c_turma' order by curso asc ";
                            $sql_1 = mysqli_query($conexao, $s);
                        
                        }
                        
                    }else{
                        $s=$pdo->prepare("SELECT * FROM cursos ORDER BY id_categoria ASC");
                        $s->execute();
                        
                    } ?>
        <table class="users" id="table-responsive" border="0">

            <tr>
                <td class="row-1 row-ID"><strong>Turmas:</strong></td>
                <td class="row-2 row-ID"><strong>Total de disciplinas desta Turma:</strong></td>
                <td class="row-3 row-ID"> <strong> Categoria:</strong></td>
                <td class="row-4 row-ID">&nbsp;</td>
            </tr>


            <?php while($res_1 = $s->fetch()){
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
                    <h3><?php 
                    $sql_2=$pdo->prepare("SELECT * FROM lista_disc WHERE categoria=:id");
                    $sql_2->bindValue(':id',$cursos_id);
                    $sql_2->execute();
                    $dado=$sql_2->fetchAll();
                    echo $dados=count($dado); ?>
                    </h3>
                </td>
                <td class="row-cod">
                    <h3>

                        <?php 
                            $categoria=$res_1['id_categoria'];
                            $busca_cat=$pdo->prepare("SELECT categoria FROM  categoria WHERE id_categoria=:categoria");
                            $busca_cat->bindValue(':categoria',$categoria);
                            $busca_cat->execute();
                        while ($res_cate=$busca_cat->fetch()){
                            echo $res_cate['categoria'];
                        }
                         ?>
                    </h3>
                </td>
                <td class="">
                    <a class="a"
                        href="cursos_e_disciplinas.php?pg=curso&deleta=cur&id=<?php echo $res_1['id_cursos'];?>">
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
        

        <!-- <!deleção dos cursos> -->
            <?php 
        if (@$_GET['deleta']=='cur') {
            # code...
            $id=@$_GET['id'];

            try {
                //code...
            
            $sql_3=$pdo->prepare("delete from cursos where id_cursos=:id");
            $sql_3->bindValue('id',$id);
            $sql_3->execute();
            echo "<script language='javascript'>window.location='cursos_e_disciplinas.php?pg=curso';</script>";
        } catch (\Throwable $th) {
            //throw $th;
            echo "<script language='javascript'>alert('erro ao apagar $th');</script>";
        }
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

                    $sql_verif=$pdo->prepare("SELECT * FROM unidades WHERE unidade=:unidade");
                    $sql_verif->bindValue(':unidade',$unidade);
                    $sql_verif->execute();
                    $dado=$sql_verif->fetchAll();
                    $dados=count($dado);
                    if($dados==0){

                        $sql=$pdo->prepare("INSERT INTO unidades (unidade,status) VALUES (:unidade,:status)");
                        $sql->bindValue(':unidade',$unidade);
                        $sql->bindValue(':status','ativa');
                        $sql->execute();
                    if($sql){
                   
                    echo "<script language='javascript'>window.alert('unidade criada com sucesso!');</script>";
                    //    echo "<script language='javascript'>window.location='cursos_e_disciplinas.php?pg=curso';</script>";
                    $sql_2=$pdo->prepare("SELECT bimestre FROM atividades_bimestrais WHERE bimestre=:unidade");
                    $sql_2->bindValue(':unidade',$unidade);
                    $sql_2->execute();
                    $dado=$sql_2->fetchAll();
                    $dados=count($dado);
                     if($dados==0){       
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
                    }else{
                     
                        echo "<script language='javascript'>window.alert('erro ao atividades e unidade!');</script>";


                    }
                    
                
                }else{
                //  echo "<script language='javascript'>window.alert('Esta unidade já existe');</script>";
               
                    switch ($categoria) {
                       
                            case 'todas':
                                $sql_2=$pdo->prepare("SELECT bimestre FROM atividades_bimestrais WHERE bimestre=:unidade");
                                $sql_2->bindValue(':unidade',$unidade);
                                $sql_2->execute();
                                $dado=$sql_2->fetchAll();
                                $dados=count($dado);
                                     if($dados==0){       
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
        <form name="form1" method="post" action="">
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
        $sql_1=$pdo->prepare("SELECT * FROM unidades");
        $sql_1->execute();
        $dado=$sql_1->fetchAll();
        $dados=count($dado);
                if($dados==0 ){
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


            <?php foreach($dado as $res_1){
                    
                ?>

            <tr>
                <td class="row-cur">
                    <h3>
                        <?php echo $unidade = $res_1['unidade'].' bimestre';
                        
                        ?>
                    </h3>
                </td>
                <td class="row-name">
                    <h3><?php 
                    $sql_2=$pdo->prepare("SELECT bimestre FROM atividades_bimestrais WHERE bimestre=:curso");
                    $sql_2->bindValue(':curso',$unidade);
                    $sql_2->execute();
                    $dados=$sql_2->fetchAll();
                    echo $qtdo=count($dados);?>
                    </h3>
                </td>

            </tr>
            <?php }?>

        </table>
        <br /><br />
        <?php } ?>

        <!-- <!deleção dos cursos> -->
            <?php 
        if (@$_GET['deleta']=='cur') {
            # code...
            $id=@$_GET['id'];

            try {
                //code...
            
            $sql_3=$pdo->prepare("delete from unidades where id_unidade=:id");
            $sql_3->bindValue('id',$id);
            $sql_3->execute();
            echo "<script language='javascript'>window.location='cursos_e_disciplinas.php?pg=unidade';</script>";
        } catch (\Throwable $th) {
            //throw $th;
            echo "<script language='javascript'>alert('erro ao apagar $th');</script>";
        }
               
        }?>

    </div>
    <!--box_curso-->
    <?php } ?>


    <!-- fim cadastra unidades -->
    <!-- fim de categoria -->
    <!-- <!________________________________Vincula DISCIPLINAS professor______________________________________________> -->


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
                 $sql_disc1=$pdo->prepare("SELECT * FROM disciplinas WHERE disciplina=:disciplina and id_professores=:professor and sala=:sala and id_cursos=:curso");
                 $sql_disc1->bindValue(':disciplina',$disciplina);
                 $sql_disc1->bindValue(':professor',$professor);
                 $sql_disc1->bindValue(':sala',$sala);
                 $sql_disc1->bindValue(':curso',$curso);
                 $sql_disc1->execute();
                 $dados=$sql_disc1->fetchAll();
                 $con_disc1=count($dados);
                if($con_disc1==0){
                if ($disciplina=='') {
                    echo "<script language='javascript'>window.alert('Digite o nome da disciplica'); </script>";
                }else if($sala==''){
                    echo "<script language='javascript'>window.alert('Digite o numero da sala'); </script>";
                }else{
                    $sql_cad_disc=$pdo->prepare("INSERT INTO disciplinas (id_cursos,disciplina,id_professores,sala) VALUES (:cursos,:disciplina,:professor,:sala)");
                    $sql_cad_disc->bindValue('cursos',$curso);
                    $sql_cad_disc->bindValue('disciplina',$disciplina);
                    $sql_cad_disc->bindValue(':professor',$professor);
                    $sql_cad_disc->bindValue(':sala',$sala);
                    $sql_cad_disc->execute();
                    if($sql_cad_disc){
                        echo "<script language='javascript'>window.alert('Disciplina e Professor foram vinculados.');</script>";
                       echo "<script language='javascript'>window.location='cursos_e_disciplinas.php?pg=disciplina';</script>";
                       
                    }else{
                        echo "<script language='javascript'>window.alert('Ocorreu um erro!');</script>";
                    }

                }

            }
            else{
             echo "<script language='javascript'>window.alert('Dados existentes, cadastre um novo!');</script>";
            }    
            }    
            ?>

            <form name="form1" method="post">
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
                            $sql_curso=$pdo->prepare('SELECT * FROM  cursos WHERE id_cursos=:curso');
                            $sql_curso->bindValue('curso',$_POST['curso']);
                            $sql_curso->execute();
                            while($r_c=$sql_curso->fetch()){
                                ?>
                                <option value="<?php echo $r_c['id_cursos']; ?>">
                                    <?php echo $r_c['curso'];?></option>
                                <?php
                                }
                         }else{
                                echo ' <option value="">Selecione uma turma</option>';
                         }
                        
                         $sql_curso=$pdo->prepare('SELECT * FROM  cursos ');                     
                         $sql_curso->execute();
                        

                            while($r_c=$sql_curso->fetch()){
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
                    $sql_rec_dis=$pdo->prepare('SELECT * FROM lista_disc l inner join cursos c on l.categoria=c.id_categoria where c.id_cursos=:id order by nome asc');
                    $sql_rec_dis->bindValue('id',$l);
                    $sql_rec_dis->execute();

                            while($l2=$sql_rec_dis->fetch()){
                    ?>
                                <option value="<?php echo $l2['id_lista']; ?>"><?php echo $l2['nome'];?></option>
                                <?php  }?>
                            </select>
                        </td>
                        <td width="143">
                            <select name="professor">
                                <?php 
                                 $sql_result_prof=$pdo->prepare('SELECT * FROM `professores`where status=:status');                     
                                 $sql_result_prof->bindValue(':status','Ativo');
                                 $sql_result_prof->execute();
                                while ($r3=$sql_result_prof->fetch()) {?>
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


        <!-- <!editar DISCIPLINAS___> -->



            <?php if(@$_GET['cadastra']=='nao'){?>

            <h1>Atualizar disciplina</h1>
            <?php $id=$_GET['id'];
                    $sql_disc=$pdo->prepare('SELECT * FROM disciplinas WHERE id_disciplinas=:id');                     
                    $sql_disc->bindValue(':id',$id);
                    $sql_disc->execute();                   
                    while($edit_disc=$sql_disc->fetch()){
                ?>
            <?php  
                if(isset($_POST['atualiza'])) {
                            $id=$_GET['id'];
                            $curso=$_POST['curso'];
                            $disciplina=$_POST['disciplina'];
                            $professor=$_POST['professor'];
                            $sala=$_POST['sala'];
                                $sql_disc=$pdo->prepare('SELECT * FROM disciplinas WHERE disciplina=:disciplina AND id_professores=:professor AND sala=:sala AND id_cursos=:curso');                     
                                $sql_disc->bindValue(':disciplina',$disciplina);
                                $sql_disc->bindValue(':professor',$professor);
                                $sql_disc->bindValue(':sala',$sala);
                                $sql_disc->bindValue(':curso',$curso);
                                $sql_disc->execute();      
                                $dados=$sql_disc->fetchAll();
                                $con_disc1=count($dados);
                            if($con_disc1 == 0){
                                if ($disciplina=='') {
                                        echo "<script language='javascript'>window.alert('Digite o nome da disciplica'); </script>";
                                }else if($sala==''){
                                        echo "<script language='javascript'>window.alert('Digite o numero da sala'); </script>";
                                }else{
                                        $sql_cad_disc=$pdo->prepare('UPDATE disciplinas SET id_cursos=:curso,disciplina=:disciplina,id_professores=:professor,sala=:sala WHERE id_disciplinas=:id');                     
                                        $sql_cad_disc->bindValue(':disciplina',$disciplina);
                                        $sql_cad_disc->bindValue(':professor',$professor);
                                        $sql_cad_disc->bindValue(':sala',$sala);
                                        $sql_cad_disc->bindValue(':curso',$curso);
                                        $sql_cad_disc->bindValue(':id',$id);
                                        $sql_cad_disc->execute(); 
                                    if($sql_cad_disc){
                                        echo "<script language='javascript'>window.alert('Disciplina atualizada com sucesso!');</script>";
                                        echo "<script language='javascript'>window.location='cursos_e_disciplinas.php?pg=disciplina';</script>";
                                           
                                    }else{
                                        echo "<script language='javascript'>window.alert('Ocorreu um erro!');</script>";
                                    }

                                }

                            }else{
                                echo "<script language='javascript'>window.alert('Estes dado ja esta cadastrado!!!');</script>";

                            }
                }        
            ?>

            <form name="form1" method="post">
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
                     
                         $turma=$edit_disc['id_cursos'];
                         $sql_curso=$pdo->prepare('SELECT * FROM  cursos WHERE id_cursos=:curso');
                         $sql_curso->bindValue('curso',$turma);
                         $sql_curso->execute();
                              
                             while($res_busca_turma=$sql_curso->fetch()){
                         ?>

                                <option value="<?php echo $res_busca_turma['id_cursos'];?>">
                                    <?php echo $res_busca_turma['curso'].' - '.$res_busca_turma['turno'];?></option>
                                <?php
                         }
                      ?>

                                <?php 
                                $sql_busca_turma2=$pdo->prepare('SELECT * FROM  cursos ');                     
                                $sql_busca_turma2->execute();
                                while($r2=$sql_busca_turma2->fetch()){
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
                                 $con_busca_d=$pdo->prepare('SELECT * FROM lista_disc WHERE id_lista=:id'); 
                                 $con_busca_d->bindValue('id',$d);                    
                                 $con_busca_d->execute();
                                
                                  while($res_busca_d=$con_busca_d->fetch()){
                                  ?>
         
                                         <option value="<?php echo $res_busca_d['id_lista'];?>">
                                             <?php echo $res_busca_d['nome'];?></option>
                                         <?php
                                  }
                            
                            ?>
                               
                                <?php 
                    $l=$_POST['curso'];
                        $sql_rec_dis=$pdo->prepare('SELECT l.id_lista,l.nome FROM lista_disc l inner JOIN cursos c on c.id_categoria=l.categoria where c.id_cursos=:id order by l.nome asc'); 
                                  $sql_rec_dis->bindValue('id',$l);                    
                                 $sql_rec_dis->execute();
                       
                            while($l2=$sql_rec_dis->fetch()){
                    ?>
                                <option value="<?php echo $l2['id_lista']; ?>"><?php echo $l2['nome'];?></option>
                                <?php  }?>
                            </select>
                        </td>
                        <td width="143">
                            <select name="professor">
                                <?php $code=$edit_disc['id_professores']; 
                                $sql_rec_dis=$pdo->prepare('SELECT nome,id_professores FROM professores WHERE id_professores=:professor'); 
                                $sql_rec_dis->bindValue('professor',$code);                    
                               $sql_rec_dis->execute();
                            while ($proc_prof=$sql_rec_dis->fetch()){
                            ?>
                                <option value="<?php echo $proc_prof['id_professores']; ?>">
                                    <?php echo $proc_prof['nome'];?></option> <?php
                            }
                        ?>
                                <?php 
                                 $sql_rec_dis=$pdo->prepare('SELECT nome,id_professores FROM professores WHERE status=:professor'); 
                                 $sql_rec_dis->bindValue('professor','Ativo');                    
                                $sql_rec_dis->execute();
                                while ($r3=$sql_rec_dis->fetch()) {?>
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
            <form name="button" method="post" action="" enctype="multipart/form-data">
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
        ?> <option value="<?php echo $_GET['turma']; ?>"><?php 
        $sql_2=$pdo->prepare("SELECT curso FROM cursos where id_cursos=:t");
        $sql_2->bindValue(':t',$t);
        $sql_2->execute();
       
	  	   while($res_2 = $sql_2->fetch()){ echo $res_2['curso'];}}?></option>
                                <?php
                                $sql_2=$pdo->prepare("SELECT * FROM cursos");
                                $sql_2->execute();
    	  	while($res_2 =$sql_2->fetch()){
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
                            $s=$pdo->prepare("SELECT d.* from disciplinas d inner join cursos c ON c.id_cursos=d.id_cursos INNER JOIN professores p ON d.id_professores=p.id_professores where  c.id_cursos=:turma order by d.disciplina asc ");
                            $s->bindValue(':turma',$serie);
                            $s->execute();
                            $dados=$s->fetchAll();
                            $qtde=count($dados);     
                        }else{  
                            $s="SELECT d.* from disciplinas d inner join cursos c ON c.id_cursos=d.id_cursos INNER JOIN professores p ON d.id_professores=p.id_professores where p.nome like ? order by d.disciplina asc ";
                            $opcoes=array("%$tipo%");
                           
                            $b=$pdo->prepare($s);
                            $b->execute($opcoes);
                            $dados=$b->fetchAll();
                            $qtde=count($dados);     
                        
                        }
                        
                    }else{
                        $s=$pdo->prepare("SELECT d.*,c.id_cursos from disciplinas d inner join lista_disc l ON l.id_lista=d.disciplina INNER JOIN cursos c on c.id_cursos=d.id_cursos INNER JOIN professores p ON d.id_professores=p.id_professores ORDER BY l.nome asc");
                        $s->execute();
                        $dados=$s->fetchAll();
                        $qtde=count($dados);
                    }
                if($dados ==0){
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

                <?php foreach($dados as $res_busca){?>
                <tr>
                    <td class="row-name">
                        <h3>

                            <?php 
                            $turma=$res_busca['id_cursos'];
                            $s=$pdo->prepare("SELECT curso,turno FROM cursos WHERE id_cursos=:turma");
                            $s->bindValue(':turma',$turma);
                            $s->execute();
                            while($res_busca_turma=$s->fetch()){
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
                            $sql_busca_d=$pdo->prepare("select nome from lista_disc where id_lista=:d");
                            $sql_busca_d->bindValue(':d',$d);
                            $sql_busca_d->execute();
                            
                                    while($res_busca_turma=$sql_busca_d->fetch()){
                         ?>

                            <?php echo $res_busca_turma['nome'];}?>    
                      </h3>
                    </td>
                    <td class="row-name">
                        <h3>
                            <?php
                                    $professor=$res_busca['id_professores'];
                                    $sql_busca_d=$pdo->prepare("select * from professores where id_professores=:professor");
                                    $sql_busca_d->bindValue(':professor',$professor);
                                    $sql_busca_d->execute();                                  
                                    while($res_busca2=$sql_busca_d->fetch()){
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



            <!-- <!deleção dos disciplinas> -->
                <?php 
        if (@$_GET['deleta']=='sim') {
            $id=@$_GET['id'];
            # code...
            try {
                //code...
            
            $sql_3=$pdo->prepare("delete from disciplinas where id_disciplinas=:id");
            $sql_3->bindValue('id',$id);
            $sql_3->execute();
            echo "<script language='javascript'>window.location='cursos_e_disciplinas.php?pg=disciplina';</script>";
            } catch (\Throwable $th) {
                //throw $th;
                echo "<script language='javascript'>alert('erro ao apagar $th');</script>";
            }
   
        }?>

                </div>
                <!--disciplinas-->
                <?php } ?>






                <!-- <!MOSTRAR OS CURSOS E AS DISCIPLINAS> -->


                    <?php if(@$_GET['pg'] == 'cursoedisciplinas'){ ?>
                    <div class="box_professores">
                        <h1>Cursos e Disciplinas</h1>

                        <?php
                        $sql_busca_d=$pdo->prepare("SELECT * FROM cursos");                     
                        $sql_busca_d->execute();     
                        $dados=$sql_busca_d->fetchAll();
                        $dado=count($dados);      
            if($dado == 0){
                echo "Não existe nenhum curso cadastrado no momento!";
            }else{
            ?>
                                    <table class="users" id="table-responsive" border="0">
                            <?php foreach($dados as $rs_ced){
                             $cursos_id=$rs_ced['id_cursos'];
                             $turno=$rs_ced['turno'];
                    ?>
                            <tr>
                                <td>Turma: <?php echo $curso = $rs_ced['curso']. '  |  Turno:'.$turno; ?></td>
                            </tr>
                            <tr>
                                <td>
                                    <textarea disabled="disabled" name="textarea" cols="100" rows="5">
                            <?php
                             $sql_ced_prof=$pdo->prepare("SELECT l.nome as disc,d.id_professores,p.nome,p.code FROM disciplinas d inner join lista_disc l on d.disciplina=l.id_lista inner JOIN professores p on p.id_professores=d.id_professores WHERE id_cursos = :curso");                     
                             $sql_ced_prof->bindValue(':curso',$cursos_id);
                             $sql_ced_prof->execute(); 
                             $dados=$sql_ced_prof->fetchAll();    
                            foreach($dados as $res){
                                echo $res['disc'].', Prof:'.$res['nome'].', Cód.'.$res['code'].';';
                                  
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