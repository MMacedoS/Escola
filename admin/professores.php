<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <?php header('Content-Type: text/html; charset=UTF-8'); require_once("topo.php");   ?>
    <title>Professores</title>

    <link rel="shortcut icon" href="../image/logo.png">


    <link rel="stylesheet" href="../jquery.superbox.css" type="text/css" media="all" />
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>


    <script type="text/javascript" src="../jquery.superbox-min.js"></script>

    <script src="js/jquery.maskedinput-1.3.js" type="text/javascript"></script>
    <style>
    .col, .col-1, .col-10, .col-11, .col-12, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-auto, .col-lg, .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-auto, .col-md, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-auto, .col-sm, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-auto, .col-xl, .col-xl-1, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-auto {
    position: unset !important;
}
       #customers {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 97%;
        }
        
        #customers td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }
        #customers th {
            width:20%;
        }
        
        #customers tr:nth-child(even){background-color: #f2f2f2;}
        
        #customers tr:hover {background-color: #ddd;}
        
        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>

<body>

    <div id="caixa_preta">
    </div><!-- caixa_preta-->
    <?php if(@$_GET['pg']=='coord'){   ?>
    <div class="box_professores">
        <br /><br />
        <a href="professores.php?pg=coord&cadastra=sim" class="a2">
            Cadastrar Coordenador
        </a>
        <?php if(@$_GET['cadastra']=='sim'){ ?>
        <br /><br />
        <h1>Cadastrar Disciplina</h1>
        <?php if(isset($_POST['cadastra'])){
                    $L_disc=$_POST['disc'];
                    $l_cate=$_POST['cate'];
                    $ano=Date('Y');
                    $res = $pdo->prepare("select * from coordenador where code=:L_disc and categoria=:l_cate");
                        $res->bindValue(':L_disc',$L_disc);
                        $res->bindValue(':l_cate',$l_cate);
                        $res->execute();    
                        $dados = $res->fetchAll(PDO::FETCH_ASSOC);
                        $con_verif = count($dados);
                      if($con_verif==0){
                        if($L_disc!=''){
                        $res=$pdo->prepare("INSERT INTO coordenador (code,categoria,ano_letivo) values(:nome,:categoria,:ano)");
                        $res->bindvalue(":nome",$L_disc);
                        $res->bindvalue(":categoria",$l_cate);
                        $res->bindvalue(":ano",$ano);
                        $res->execute();
                        echo "<script language='javascript'>window.alert('Este coordenador para esta categoria ja foi cadastrado');</script>";
                        }else{
                            echo "<script language='javascript'>window.alert('coordenador vazio');</script>";
                        }
                    }else{
                 echo "<script language='javascript'>window.alert('Este coordenador para esta categoria ja foi cadastrado');</script>";
                    }
                } ?>
        <form name="form1" method="post" action="">
            <table id="customers" border="0">

                <tr>
                    <th>Coordenador</th>
                    <th>Categoria</th>
                    <th>&nbsp;</th>
                </tr>

                <tr>
                    <td><select name="disc" size="1" id="categoria">
                            <?php 
                                    $sql_cat = $pdo->prepare("select * from funcionarios where profissao=:coor");
                                    $sql_cat->bindValue(':coor','Coordenacao');
                                    $sql_cat->execute();    
                                    
                                    while($bus_categoria=$sql_cat->fetch()){
                                    
                                    ?>
                            <option value="<?php echo $bus_categoria['code'] ?>">
                                <?php echo $bus_categoria['nome'] ?></option>
                            <?php } ?>
                        </select></td>
                    <td>
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
                    <td><input class="input" type="submit" name="cadastra" id="button"
                            value="Cadastrar"></td>
                </tr>

            </table>
        </form>
        <br />
        <?php die;}
             else {?>
        <?php if(@$_GET['cadastra']=='nao'){?>
        <br /><br />
        <h1>Atualiza Coordenação</h1>
        <?php
           $id=$_GET['id'];
                    $sql_edit = $pdo->prepare("select * from coordenador where id_coor=:id");
                    $sql_edit->bindValue(':id',$id);
                    $sql_edit->execute();                        
                    while($edit_curso=$sql_edit->fetch()){
                    ?>
        <?php if(isset($_POST['atualiza'])){
                     $L_disc=$_POST['disc'];
                     $l_cate=$_POST['cate'];
                      $res = $pdo->prepare("select * from coordenador where code=:L_disc and categoria=:l_cate");
                        $res->bindValue(':L_disc',$L_disc);
                        $res->bindValue(':l_cate',$l_cate);
                        $res->execute();    
                        $dados = $res->fetchAll(PDO::FETCH_ASSOC);
                        $con_verif = count($dados);
                     if($con_verif==0){
                        $res=$pdo->prepare("UPDATE coordenador set code=:code,categoria=:categoria where id_coor=:lista");
                        $res->bindvalue(":code",$L_disc);
                        $res->bindvalue(":categoria",$l_cate);
                        $res->bindvalue(":lista",$id);
                        $res->execute();
                     echo "<script language='javascript'>window.alert('coordenacao atualizada com sucesso!');</script>";
                       echo "<script language='javascript'>window.location='professores.php?pg=coord';</script>";
                   
                }else{
                    echo "<script language='javascript'>window.alert('Esta coordenação ja existe!');</script>";
                }
                } ?>
        <form name="form1" method="post" action="">
            <table id="customers" border="0">

                <tr>
                    <th>Coordenador</th>
                    <th>Categoria</th>
                    <th>&nbsp;</th>
                </tr>

                <tr>
                <td>
                <select name="disc" size="1">

                        <?php 
                                $cate=$edit_curso['code'];
                                $sql_edit = $pdo->prepare("select * from funcionarios where code=:cate");
                                $sql_edit->bindValue(':cate',$cate);
                                $sql_edit->execute();    
                                
                                while($res_cat=$sql_edit->fetch()){
                            ?>
                        <option value="<?php echo $edit_curso['code'];?>"><?php echo $res_cat['nome'];?>
                        </option>
                        <?php }
                                $sql_cat = $pdo->prepare("select * from funcionarios where profissao=:coor");
                                $sql_cat->bindValue('coor','Coordenacao');
                                $sql_cat->execute();    
                                
                            while($res_cat=$sql_cat->fetch()){
                            ?>
                        ?>

                        <option value="<?php echo $res_cat['code'];?>"><?php echo $res_cat['nome'];?>
                        </option>

                        <?php } ?>
                        </select>

                    <td>
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
        <!--visualizar coordenador lista cadastrados -->

        <br /><br />
        <h1>Disciplinas</h1>
        <form name="button" method="post" action="" enctype="multipart/form-data">
            <table class="users" id="customers" border="0">
                <tr>
                    <th colspan="2"><strong>Categoria</strong></th>
                </tr>
                <tr>
                    
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


$serie = $_POST['categoria'];

$s = base64_encode('filtro');

echo "<script language='javascript'>window.location='professores.php?pg=coord&lista=$s&disc=$serie';</script>";

}?>
        <?php 
                // $s = base64_decode($_GET['s']);;
                    if(isset($_GET['lista'])){ 
                        $tipo=@$_GET['status'];
                        $categ=$_GET['disc'];
                        if($tipo==''){
                                $s=$pdo->prepare("SELECT  coor.*,f.nome from funcionarios f INNER join coordenador coor on coor.code=f.code where categoria=:cate  order by f.nome asc ");
                                $s->bindValue(':cate',$cate);
                                $s->execute(); 
                                $dados=$s->fetchAll();
                                $con_verif = count($dados);
                        }
                        
                    }else{
                        $stmt = $pdo->prepare("SELECT  coor.*,f.nome from funcionarios f INNER join coordenador coor on coor.code=f.code");
                        $stmt->execute(); 
                        $dados=$stmt->fetchAll();
                        $con_verif = count($dados);
                    }

                if($con_verif==0){
                    echo "<h2>No momento não existe!</h2><br><br>";
                }else{

                ?>
        <table id="customers" border="0">

            <tr>
                <th><strong>Coordenador:</strong></th>
                <th> <strong> Categoria:</strong></th>
                <th>Ano Letivo</th>
                <th colspan="2">&nbsp;</th>
            </tr>


            <?php foreach($dados as $res_1){
                    // $cursos_id=$res_1['id_lista'];
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
                <td>
                <?php echo $disc = $res_1['ano_letivo'];
                       
                        ?>
                </td>
                <td >
                    <a class="a"
                        href="professores.php?pg=coord&deleta=cur&id=<?php echo @$res_1['id_coor'];?>">
                        <img title="Excluir curso" src="img/deleta.jpg" width="18" heigth="18" border="0" alt=""></a>
                </td>
                <td >
                    <a class="a"
                        href="professores.php?pg=coord&cadastra=nao&id=<?php echo $res_1['id_coor'];?>"><img
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
            
            $sql_3=$pdo->prepare("delete from coordenador where id_coor=:id");
            $sql_3->bindValue('id',$id);
            $sql_3->execute();
            echo "<script language='javascript'>window.location='professores.php?pg=coord';</script>";
        } catch (\Throwable $th) {
            //throw $th;
            echo "<script language='javascript'>alert('erro ao apagar $th');</script>";
        }
            

                
        }?>

    </div>
    <!--box_curso-->
    <?php } ?>
    <!-- <!exibir tabela de professores cadastrados> -->

        <?php if(@$_GET['pg']=='todos'){ ?>
        <div class="box_professores">
            <br /><br />
            <a class="a2" href="professores.php?pg=cadastra">Cadastrar Professor</a>
            <h1>Lista de Professores</h1>
            <form name="button" method="post" action="" enctype="multipart/form-data">
                <table class="users" id="table-responsive" border="0">
                    <tr>
                        <td><strong>Professor</strong></td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td><input type="text" class="pesq" name="nome" value="" placeholder="pesquise o professor..."></td>
                        
                        <td><input class="input" type="submit" name="button" id="button" value="Filtrar"></td>
                    </tr>
                </table>
            </form>
            <?php if(isset($_POST['button'])){

$tipo = $_POST['nome'];

$s = base64_encode('filtro');

echo "<script language='javascript'>window.location='professores.php?pg=todos&s=$s&status=$tipo';</script>";

}?>
            <?php 
                if(isset($_GET['s'])){ 
                    $tipo=$_GET['status'];
                    $s="SELECT * from professores where nome like '%".$tipo."%'";
                    $sql_1 = mysqli_query($conexao, $s);
                }else{
                    $s="SELECT * from professores order by nome asc";
                    $sql_1 = mysqli_query($conexao, $s);
                }
            if(mysqli_num_rows($sql_1)==''){
                echo "No momento não existe professores cadastrados!";
            }else{
        ?>
            <table class="users" id="table-responsive" border="0">
                <tr>
                    <th>Código:</th>
                    <th>Nome:</th>
                    <th>QTD disciplina(s):</th>
                    <th>email:</th>
                    <th>Status:</th>
                    <th></th>
                </tr>
                <?php while($res_1=mysqli_fetch_assoc($sql_1)){
                $professor_id=$res_1['id_professores'];
                ?>
                <tr>
                    <td>
                        <h3><?php echo $code=$res_1['code'];?></h3>
                    </td>
                    <td>
                        <h3><?php echo $res_1['nome'];?></h3>
                    </td>
                    <td>
                        <h3><?php 
                        $sql2="select * from disciplinas where id_professores='$professor_id'";
                            echo mysqli_num_rows(mysqli_query($conexao,$sql2));
                        ?></h3>
                    </td>
                    <td>
                        <h3> <?php echo $res_1['email'];?></h3>
                    </td>
                    <td>
                        <h3><?php echo $res_1['status'];?></h3>
                    </td>
                    <td></td>
                    <td>
                        <a class="a"
                            href="professores.php?pg=todos&func=deleta&id=<?php echo $res_1['id_professores'];?>">
                            <img title="Excluir Professor" src="img/deleta.jpg" alt="" width="18" height="18"
                                border="0">
                        </a>
                        <?php if($res_1['status']=='Inativo'){?>
                        <a class="a"
                            href="professores.php?pg=todos&func=ativa&id=<?php echo $res_1['id_professores'];?>&code=<?php echo $res_1['code'];?>">
                            <img title="Ativar novamente professor" src="../image/correto.jpg" width="20" height="20"
                                border="0" alt="">
                        </a>
                        <?php }?>
                        <?php if ($res_1['status']=='Ativo') {?>
                        <a class="a" href="professores.php?pg=todos&func=inativa&id=<?php echo 
                              $res_1['id_professores'];?>&code=<?php echo $res_1['code'];?>">
                            <img title="Inativar Professor(a)" src="../image/ico_bloqueado.png" width="18" height="18"
                                border="0" alt=""></a>
                        <?php }?>
                        <a class="a"
                            href="professores.php?pg=todos&func=edita&id=<?php echo $res_1['id_professores'];?>"><img
                                title="Editar dados Cadastrais" src="../image/ico-editar.png" width="18" height="18"
                                border="0" alt=""></a>
                        <a class="a" rel="superbox[iframe][930x500]" href="historico_professor.php?id=<?php echo
                              $res_1['id_professores'];?>"><img title="Historico deste professor"
                                src="../image/visualizar16.gif" width="18" height="18" border="0" alt=""></a>

                    </td>

                </tr>
                <?php } ?>
            </table>
            <br /> <br />
            <?php } ?>
            <br />

            <!DELETAR O PROFESSOR>
                <?php if(@$_GET['func']=='deleta'){
                $id=$_GET['id'];

                $sql_del="delete from professores where id_professores='$id'";
                mysqli_query($conexao,$sql_del);
                echo "<script language='javascript'>window.location='professores.php?pg='todos';</script>";
            }?>
                <!-- <!ativar professor> -->
                <?php 
                if (@$_GET['func']=='ativa') {
                    $id=$_GET['id'];
                    $code=$_GET['code'];

                    $sql_edit1="update professores set status='Ativo' where id_professores='$id'";
                    $sql_edit2="update login set status='Ativo' where code='$code'";
                    mysqli_query($conexao,$sql_edit1);
                    mysqli_query($conexao,$sql_edit2);

                    echo "<script language='javascript'>window.location='professores.php?pg=todos';</script>";
                }
            
            
            
            ?>
                <!inativar professor>
                    <?php 
                if (@$_GET['func']=='inativa') {
                    $id=$_GET['id'];
                    $code=$_GET['code'];

                    $sql_edit3="update professores set status='Inativo' where id_professores='$id'";
                    $sql_edit4="update login set status='Inativo' where code='$code'";
                    mysqli_query($conexao,$sql_edit3);
                    mysqli_query($conexao,$sql_edit4);

                    echo "<script language='javascript'>window.location='professores.php?pg=todos';</script>";
                }
            
            
            
            ?>
        </div>
        <!--Editar professor-->
        <?php 
                if (@$_GET['func']=='edita') {?>
        <div id="editar_professores">
            <hr />
            <h1>Editar Professor</h1>

            <?php 
                    $id=$_GET['id'];
                   
                    $sql_1 = "SELECT * FROM professores WHERE id_professores = '$id'";
                    $edit= mysqli_query($conexao,$sql_1);
                        while($res_1 = mysqli_fetch_assoc($edit)){
                        ?>
            <?php
                        if (isset($_POST['button'])) {
                            $id=$_GET['id'];
                            $nome=$_POST['nome'];
                            $cpf=$_POST['cpf'];
                            $nascimento=$_POST['nascimento'];
                            $formacao=$_POST['formacao'];
                            $graduacao=$_POST['graduacao'];
                            $pos_graduacao=$_POST['pos_graduacao'];
                            $mestrado=$_POST['mestrado'];
                            $doutorado=$_POST['doutorado'];
                            $salario=$_POST['salario'];
                            $usuario=$_POST['usuario'];

                          
                            $sql_2="update professores set nome='$nome',cpf='$cpf',nascimento='$nascimento',
                            formacao='$formacao', graduacao='$graduacao', pos_graduacao='$pos_graduacao', mestrado='$mestrado',
                            doutorado='$doutorado', salario='$salario', email='$usuario' where id_professores='$id'";
                            $res_editar=mysqli_query($conexao,$sql_2);
                            $sql_l="update login set nome='$usuario' where code=(select p.code from professores p where p.id_professores='$id')";
                            $res_l=mysqli_query($conexao,$sql_l);
                            if($res_editar == ''){
                                    echo "<script language='javascript'>window.alert('Ocorreu um erro tente novamente!');window.location='';</script>";
                                }else{
                                    echo "<script language='javascript'>window.alert('Atualização realizada com sucesso!');window.location='professores.php?pg=todos';</script>";

                                }
                              
                                }
                                
                                ?>
            <?php if(isset($_POST['cancelar'])){?>
            <script>
            window.location = 'professores.php?pg=todos';
            </script>
            <?php  }?>

            <form name="form1" action="" method="post" enctype="multipart/form-data">
                <table class="users" id="table-responsive" border="0">
                    <tr>
                        <td>NOME:</td>
                        <td>CPF</td>
                        <td>SALÁRIO</td>
                    </tr>
                    <tr>
                        <td><label for="textfield2"></label>
                            <input type="text" class="form-control" name="nome" id="textfield2" value="<?php 
                                echo $res_1['nome'];?>">
                        </td>
                        <td><label for="textfield3"></label>
                            <input type="text" class="form-control" name="cpf" id="cpf" value="<?php
                                 echo $res_1['cpf'];?>"></td>
                        <td>
                            <input type="text" class="form-control" name="salario" id="textfield8" value="<?php
                                     echo $res_1['salario'];?>">
                        </td>

                    </tr>
                    <tr>
                        <td>Data de nascimento:</td>
                        <td>Formação academica:</td>
                        <td>graduacão(ões):</td>
                    </tr>
                    <tr>
                        <td><label for="textfield4"></label>
                            <input type="text" class="form-control" name="nascimento" id="textfield4" value="<?php
                                     echo $res_1['nascimento'];?>">
                        </td>
                        <td>
                            <label for="select"></label>
                            <select name="formacao" class="form-control" id="select" size="1">
                                <option value="<?php echo $res_1['formacao'];?>">
                                    <?php echo $res_1['formacao'];?>
                                </option>
                                <option value=""></option>
                                <option value="Ensino Médio Incompleto">Ensino Médio Incompleto</option>
                                <option value="Ensino Médio Completo">Ensino Médio Completo</option>
                                <option value="Superior Incompleto">Superior Incompleto</option>
                                <option value="Superior Completo">Superior Completo</option>

                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="graduacao" id="textfield5"
                                value="<?php echo $res_1['graduacao'];?>"></td>
                    </tr>
                    <tr>
                        <td>Pos-Graduação(ões):</td>
                        <td>Mestrado(s):</td>
                        <td>Doutorado(s):</td>
                    </tr>

                    <tr>
                        <td><input type="text" class="form-control" name="pos_graduacao" id="textfield6" value="<?php echo 
                                $res_1['pos_graduacao']; ?>"></td>
                        <td><input type="text" class="form-control" name="mestrado" id="textfield6" value="<?php echo 
                                $res_1['mestrado']; ?>"></td>
                        <td><input type="text" class="form-control" name="doutorado" id="textfield6" value="<?php echo 
                                $res_1['doutorado']; ?>"></td>

                    </tr>
                    <tr>
                        <td>Email:</td>
                    </tr>
                    <tr>
                        <td><input type="email" class="form-control" name="usuario" id="" value="<?php echo 
                                $res_1['email']; ?>"></td>

                    </tr>
                    <tr>
                        <td><button class="btn btn-success" type="submit" name="button">Atualizar</button></td>
                        <td><button class="btn btn-danger" name="cancelar">Cancelar</button></td>
                        <td>&nbsp</td>
                        <td>&nbsp</td>
                    </tr>
                </table>
                <?php }?>
            </form>
            <?php }?>
            <br />

        </div>



        <?php } ?>
        <!--fechamaenot do pg-->
        <!CADASTRO DOS PROFESSORES>

            <?php if(@$_GET['pg'] == 'cadastra'){ ?>
            <div id="cadastra_professores">
                <h1>Cadastrar novo professor</h1>
                <?php if(isset($_POST['button'])){
	
$code = $_POST['code'];
$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$nascimento = $_POST['nascimento'];
$formacao = $_POST['formacao'];
$graduacao = $_POST['graduacao'];
$pos_graduacao = $_POST['pos_graduacao'];
$mestrado = $_POST['mestrado'];
$doutorado = $_POST['doutorado'];
$salario = $_POST['salario'];
$usuario=$_POST['usuario'];
$s=md5($cpf);

$sql_2 = "INSERT INTO professores (code, status, nome, cpf, nascimento, formacao, graduacao, pos_graduacao, mestrado, doutorado, salario,email) VALUES ('$code', 'Ativo', '$nome', '$cpf', '$nascimento', '$formacao', '$graduacao', '$pos_graduacao', '$mestrado', '$doutorado', '$salario','$usuario')";
$cadastra = mysqli_query($conexao, $sql_2);
if($cadastra == ''){
	echo "<script language='javascript'>window.alert('Ocorreu um erro ao cadastrar!');</script>";
}else{
	
$sql_3 = "INSERT INTO login (status, code, senha, senha_rec, nome, painel) VALUES ('Ativo', '$code', '$cpf','$s', '$usuario', 'professor')";
$cadastra_login = mysqli_query($conexao, $sql_3);
enviar($usuario,$cpf);
	echo "<script language='javascript'>window.alert('Professor cadastrado com sucesso!');window.location='professores.php?pg=todos';</script>";
 }
}?>

                <?php if(isset($_POST['cancelar'])){?>
                <script>
                window.location = 'professores.php?pg=todos';
                </script>
                <?php  }?>


                <form name="form1" method="post" action="">
                    <table class="users" id="table-responsive" border="0">
                        <div class="form-control col-sm-12">
                            <tr>
                                <td>Código:</td>
                                <td>Nome:</td>
                                <td>CPF:</td>
                            </tr>
                            <tr>
                                <td>
                                    <?php
      $sql_4 = "SELECT * FROM professores ORDER BY id_professores DESC LIMIT 1";
	  $buscar_prof = mysqli_query($conexao, $sql_4);
	  if(mysqli_num_rows($buscar_prof) == ''){
		  $new_code = "87415978";
	  ?>
                                    <input type="text" name="code" id="textfield" disabled="disabled"
                                        value="<?php echo $new_code;  ?>">
                                    <input type="hidden" name="code" value="<?php echo $new_code;  ?>" />
                                </td>
                                <?php
	  }else{
	  	while($res_1 = mysqli_fetch_assoc($buscar_prof)){
			
			$new_code = $res_1['code']+$res_1['id_professores']+741;
	  ?>
                                <input type="text" name="code" id="textfield" disabled="disabled"
                                    value="<?php echo $new_code;  ?>">
                                <input type="hidden" name="code" value="<?php echo $new_code;  ?>" />
                                </td>
                                <?php }} ?>
                                <td>
                                    <input type="text" class="form-control" name="nome" id="textfield2" required></td>
                                <td>
                                    <input type="text" class="form-control" name="cpf" id="cpf" required></td>
                            </tr>
                        </div>
                        <tr>
                            <td>Data de nascimento:</td>
                            <td>Formação Acadêmica</td>
                            <td>Graduação(ões):</td>
                        </tr>
                        <tr>
                            <td><label for="textfield4"></label>
                                <input type="date" class="form-control" name="nascimento" id="textfield4"></td>
                            <td><label for="select"></label>
                                <select class="form-control" name="formacao" size="1" id="select">
                                    <option value="Ensino Médio Incompleto">Ensino Médio Incompleto</option>
                                    <option value="Ensino Médio Completo">Ensino Médio Completo</option>
                                    <option value="Superior Incompleto">Superior Incompleto</option>
                                    <option value="Superior Completo">Superior Completo</option>
                                </select></td>
                            <td><input type="text" class="form-control" name="graduacao" id="textfield5"></td>
                        </tr>
                        <tr>
                            <td>Pos-graduação(ões):</td>
                            <td>Mestrado(s):</td>
                            <td>Doutorado(s):</td>
                        </tr>
                        <tr>
                            <td><input type="text" class="form-control" name="pos_graduacao" id="textfield6"></td>
                            <td><input type="text" class="form-control" name="mestrado" id="textfield7"></td>
                            <td><input type="text" class="form-control" name="doutorado" id="textfield8"></td>
                        </tr>
                        <tr>
                            <td>Salário:</td>
                            <td>Email:</td>
                        </tr>
                        <tr>
                            <td><input type="number" class="form-control" name="salario" id="textfield8"></td>
                            <td><input type="email" name="usuario" class="form-control" id="textfield8" required></td>
                        </tr>
                        <tr>
                            <td><input class="input" type="submit" name="button" id="button" value="Cadastrar"></td>
                            <td><button class="btn btn-danger" name="cancelar">Cancelar</button></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                    </table>
                </form>
                <br />
            </div><!-- cadastra_professores -->
            <?php } ?>

            <script>
            (function($) {
                $(function() {
                    //$("#date").mask("99/99/9999");
                    //$("#phone").mask("(99) 999-9999");
                    //$("#cep").mask("99.999-99");
                    $("#cpf").mask("999.999.999-99");


                });
            })(jQuery);
            </script>

            <?php require_once("rodape.php");   ?>
</body>

</html>