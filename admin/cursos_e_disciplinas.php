<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta http-equiv="Content-type" content="text/html" charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administração</title>
    
<link rel="shortcut icon" href="../image/logo_ist.gif">
    <link rel="stylesheet" href="css/cursos_e_disciplinas.css" type="text/css">
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
</head>
<body>
<?php
  require_once"topo.php";?>

<!--cadastrar cursos-->


  <div id="caixa_preta">
  </div>

  <?php if(@$_GET['pg']=='curso'){   ?>
        <div class="box_professores">
            <br /><br/>
            <a href="cursos_e_disciplinas.php?pg=curso&cadastra=sim" class="a2">
                    Cadastrar Turma
            </a>
             <?php if(@$_GET['cadastra']=='sim'){ ?>
             <br/><br/>
                <h1>Cadastrar Turma</h1>
                <?php if(isset($_POST['cadastra'])){
                    $curso=$_POST['curso'];
                    $turno=$_POST['turno'];
                    $categoria=$_POST['categoria'];

                    $sql_verif="select * from cursos where curso='$curso' and turno='$turno'";
                    $con_verif=mysqli_query($conexao,$sql_verif);
                     if(mysqli_num_rows($con_verif)==''){

                    $sql="insert into cursos (curso, turno,id_categoria) values ('$curso','$turno','$categoria')";
                    if($curso==''){
                            echo "<script language='javascript'>window.alert('Digite o nome da Turma!');</script>";
                    }else{
                    $cad=mysqli_query($conexao,$sql);
                    if($cad<=0){
                    echo "<script language='javascript'>window.alert('erro ao cadastrar!');</script>";
                    }else{
                     echo "<script language='javascript'>window.alert('Curso inserido com sucesso!');</script>";
                       echo "<script language='javascript'>window.location='cursos_e_disciplinas.php?pg=curso';</script>";
                    }
                }
                }else{
                 echo "<script language='javascript'>window.alert('Este curso ja existe, altere o curso');</script>";
                    }
                } ?>
                <form name="form1" method="post" action="">
                    <table class="users" id="table-responsive" border="0">
                    <thead>    
                    <tr>
                            <td class="row-1 row-cur">Curso</td>
                            <td class="row-1 row-cur">Turno</td>
                            <td class="row-1 row-cur">Categoria</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="row-1 row-cur"><input type="text" name="curso"  width="40px" value=""></td>
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
                                    <option value="<?php echo $bus_categoria['id_categoria'] ?>"><?php echo $bus_categoria['categoria'] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td class="row-1 row-cur"><input class="input" type="submit" name="cadastra" id="button" value="Cadastrar"></td>
                        </tr>
                        </tbody>
                    </table>
                </form>
                    <br/>
             <?php die;}
             else {?>
             <?php if(@$_GET['cadastra']=='nao'){?>
              <br/><br/>
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
                <form name="form1" method="post" action="">
                <table class="users" id="table-responsive" border="0">
                <thead>    
                    <tr>
                            <td class="row-1 row-cur">Curso</td>
                            <td class="row-1 row-cur">Turno</td>
                            <td class="row-1 row-cur">Categoria</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="row-1 row-cur"><input type="text" name="curso"  id="textfield" value="<?php echo $edit_curso['curso'];?>"></td>
                            <td class="row-1 row-cur">
                                <select name="turno" size="1" id="turno">
                                    <option value="<?php echo $edit_curso['turno'];?>"><?php echo $edit_curso['turno'];?></option>
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
                                    <option value="<?php echo $edit_curso['id_categoria'];?>"><?php echo $res_cat['categoria'];?></option>
                                    <?php }
                                     $busca_cat="select * from categoria";
                                    $con_busca=mysqli_query($conexao,$busca_cat);
                                    while($res_cat=mysqli_fetch_assoc($con_busca)){
                                   ?>
                                    ?>
                                    
                                    <option value="<?php echo $res_cat['id_categoria'];?>"><?php echo $res_cat['categoria'];?></option>

                                    <?php } ?>
                                </select>
                            
                            </td>
                            <td class="row-1 row-cur"><input class="input" type="submit" name="atualiza" id="button" value="Atualizar"></td>
                        </tr>
                        </tbody>
                    </table>
                    <?php } ?>
                </form>
                    <br/>
             
             <?php
             die;}}
             ?>
  <!--visualizar cursos cadastrados -->  
        <?php 
            $sql_1="select * from cursos";
            $result=mysqli_query($conexao,$sql_1);
                if(mysqli_num_rows($result)<=0 ){
                    # code...
                    echo "<br><br>No momento não existe nenhum curso cadastrado! <br><br>";
                } else {
                               
         ?>
         <br/><br/>
         <h1>Turmas</h1>
         <table class="users" id="table-responsive" border="0">
                <thead>
                <tr>
                    <td class="row-1 row-ID"><strong>Turmas:</strong></td>
                    <td class="row-2 row-ID"><strong>Total de disciplinas desta Turma:</strong></td>
                    <td class="row-3 row-ID"> <strong> Categoria:</strong></td>
                    <td class="row-4 row-ID">&nbsp;</td>
                </tr>
                </thead>
                <tbody>
                <?php while($res_1 = mysqli_fetch_assoc($result)){
                    $cursos_id=$res_1['id_cursos'];
                ?>

                <tr>
                    <td class="row-cur"><h3>
                        <?php echo $curso = $res_1['curso'].' || '.$res_1['turno'];
                        
                        ?>
                    </h3></td>
                    <td class="row-name"><h3><?php $sql_2="select * from disciplinas where id_cursos='$cursos_id'";
                    $result2=mysqli_query($conexao,$sql_2);
                    echo mysqli_num_rows($result2); ?>                
                    </h3></td>
                    <td class="row-cod"> <h3>
                        
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
                    <a class="a" href="cursos_e_disciplinas.php?pg=curso&deleta=cur&id=<?php echo @$res_1['id_cursos'];?>">
                    <img title="Excluir curso" src="img/deleta.jpg" width="18" heigth="18" border="0" alt=""></a>
                    </td>
                    <td class="row-ID">
                    <a class="a" href="cursos_e_disciplinas.php?pg=curso&cadastra=nao&id=<?php echo $res_1['id_cursos'];?>"><img title="Editar dados Cadastrais"
                     src="../image/ico-editar.png" width="18" height="18" border="0" ></a>
                    </td>
                </tr>
                <?php }?>
                </tbody>
            </table>
             <br/><br/>
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

        </div><!--box_curso-->
  <?php } ?>

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
         <br/><br/>
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
                    <td><h3>
                        <?php echo $curso = $res_1['categoria'];
                        
                        ?>
                    </h3></td>
                    <td><h3><?php $sql_2="select * from cursos where id_categoria='$cursos_id'";
                    $result2=mysqli_query($conexao,$sql_2);
                    echo mysqli_num_rows($result2); ?>                
                    </h3></td>
                    <td>
                    <a class="a" href="cursos_e_disciplinas.php?pg=curso&deleta=cur&id=<?php echo @$res_1['id_cursos'];?>">
                    <img title="Excluir curso" src="img/deleta.jpg" width="18" heigth="18" border="0" alt=""></a>
                    </td>
                    <td>
                    <a class="a" href="cursos_e_disciplinas.php?pg=curso&cadastra=nao&id=<?php echo $res_1['id_cursos'];?>"><img title="Editar dados Cadastrais"
                     src="../image/ico-editar.png" width="18" height="18" border="0" ></a>
                    </td>
                </tr>
                <?php }?>
            </table>
             <br/><br/>
  <?php } ?>

<!-- <?php } ?> -->

<!-- fim de categoria -->
  <!________________________________CADASTRAR DISCIPLINAS______________________________________________________________________________>


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
                
                $sql_disc1="select * from disciplinas where disciplina='$disciplina' and id_cursos='$curso' and 
                id_professores='$professor' and sala='$sala'";
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
                        echo "<script language='javascript'>window.alert('Disciplina cadastrada com sucesso!');</script>";
                       echo "<script language='javascript'>window.location='cursos_e_disciplinas.php?pg=disciplina';</script>";
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
                <thead>
                <tr>
                    <td class="row-1 row-cod">Turma:</td>
                    <td class="row-2 row-name">Disciplina:</td>
                    <td class="row-3 row-name">Professor:</td>
                    <td class="row-4 row-ID"> Sala: <em>Apenas o numero</em></td>
                    <td class="row-1 row-ID">&nbsp</td>
                    <td colspan="2"></td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                    <select name="curso">
                    <?php 
                        $sql_rec_curso="select * from cursos";
                        $result_rec_curso = mysqli_query($conexao,$sql_rec_curso);

                            while($r2=mysqli_fetch_assoc($result_rec_curso)){
                    ?>
                    <option value="<?php echo $r2['id_cursos']; ?>"><?php echo $r2['curso'].' '.$r2['turno'];?></option>
                            <?php  }?>
                    </select>
                    </td>
                    <td>
                        <input type="text" name="disciplina" id="textfield">
                    </td>
                    <td width="143">
                        <select name="professor" >
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
                    
                    <td><input class="btn btn-success" type="submit" name="cadastra" id="button" value="Cadastrar"></td>
                </tr>
                </tbody>
            </table>
        </form>
       <br/><br/><br/>
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
            <?php if(isset($_POST['atualiza'])) {
                  $id=$_GET['id'];
                $curso=$_POST['curso'];
                $disciplina=$_POST['disciplina'];
                $professor=$_POST['professor'];
                $sala=$_POST['sala'];
                $sql_disc1="select * from disciplinas where disciplina='$disciplina' and id_cursos='$curso' and 
                id_professores='$professor' and sala='$sala'";
                $con_disc1=mysqli_query($conexao,$sql_disc1);
                if(mysqli_num_rows($con_disc1)==0){
                if ($disciplina=='') {
                    echo "<script language='javascript'>window.alert('Digite o nome da disciplica'); </script>";
                }else if($sala==''){
                    echo "<script language='javascript'>window.alert('Digite o numero da sala'); </script>";
                }else{
                    $sql_cad_disc="update disciplinas set id_cursos='$curso',disciplina='$disciplina',id_professores='$professor',sala='$sala' where id_disciplinas='$id'";
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

        <form name="form1" method="post">
            <table class="users" id="table-responsive" border="0">
            <thead>    
            <tr>
            <td class="row-1 row-cod">Turma:</td>
                    <td class="row-2 row-name">Disciplina:</td>
                    <td class="row-3 row-name">Professor:</td>
                    <td class="row-4 row-ID"> Sala: <em>Apenas o numero</em></td>
                    <td class="row-1 row-ID">&nbsp</td>
                    <td colspan="2"></td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                    <select name="curso">
                    <?php $turma=$edit_disc['id_cursos'];
                        $sql_busca_turma="select * from cursos where id_cursos='$turma'";
                        $con_busca_turma=mysqli_query($conexao,$sql_busca_turma);
                         while($res_busca_turma=mysqli_fetch_assoc($con_busca_turma)){
                         ?>
                         
                            <option  value="<?php echo $res_busca_turma['id_cursos'];?>"><?php echo $res_busca_turma['curso'].' - '.$res_busca_turma['turno'];?></option>
                         <?php
                         }
                      ?>
                    
                    <?php 
                       $sql_busca_turma2="select * from cursos";
                        $result_rec_curso = mysqli_query($conexao,$sql_busca_turma2);

                            while($r2=mysqli_fetch_assoc($result_rec_curso)){
                    ?>
                    <option value="<?php echo $r2['id_cursos']; ?>"><?php echo $r2['curso'].' ', $r2['turno'];?></option>
                            <?php  }?>
                    </select>
                    </td>
                    <td>
                        <input type="text" name="disciplina" id="textfield" value="<?php echo $edit_disc['disciplina'];?>">
                    </td>
                    <td width="143">
                        <select name="professor" >
                        <?php $code=$edit_disc['professor']; 
                            $sql_proc_prof="select nome,id_professores from professores where code='$code'";
                            $con_proc_prof=mysqli_query($conexao,$sql_proc_prof);
                            while ($proc_prof=mysqli_fetch_assoc($con_proc_prof)){
                            ?>
                            <option value="<?php echo $proc_prof['id_professores']; ?>"><?php echo $proc_prof['nome'];?></option> <?php
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
                    <td><input type="text" name="sala" id="textfield" maxlength="4" size="4" value="<?php echo $edit_disc['sala'];?>"></td>
                    
                    <td><input class="btn btn-danger" type="submit" name="atualiza" id="button" value="Atualizar"></td>
                </tr>
                </tbody>
            </table>
                    <?php } ?>
        </form>
       <br/><br/><br/>
        </div>
   <?php die;}} ?>

   <!MOSTRAR AS DICIPLINAS NA TABELA>
            <br/><br/>
                <h1>Disciplina</h1>
                <?php $sql_buscar_disc="select * from disciplinas";
                $result_buscar_disc=mysqli_query($conexao,$sql_buscar_disc);
                if(mysqli_num_rows($result_buscar_disc)==''){
                    echo "<h2>No momento não existe nenhuma disciplina cadastrada!</h2><br><br>";
                }else{
                ?>
               <table class="users" id="table-responsive" border="0">
                  <thead>
                    <tr>
                        <td class="row-1 row-name"><strong>Curso:</strong></td>
                        <td class="row-2 row-name"><strong>Turno:</strong></td>
                        <td class="row-3 row-ID"><strong>Disciplina:</strong></td>
                        <td class="row-4 row-name" ><strong>Professor:</strong></td>
                        <td class="row-2 row-name"><strong>Sala:</strong></td>
                        <td class="row-1 row-ID">&nbsp</td>
                        <td class="row-1 row-ID">&nbsp</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php while($res_busca=mysqli_fetch_assoc($result_buscar_disc)){?>
                    <tr>
                        <td class="row-name"><h3>
                          
                            <?php 
                            $turma=$res_busca['id_cursos'];
                             $sql_busca_turma="select curso,turno from cursos where id_cursos='$turma'";
                                     $con_busca_turma=mysqli_query($conexao,$sql_busca_turma);
                                    while($res_busca_turma=mysqli_fetch_assoc($con_busca_turma)){
                         ?>
                         
                        <?php echo $res_busca_turma['curso'];;?>
                        </h3></td>
                        
                        <td class="row-name"><h3>
                        <?php echo $res_busca_turma['turno'];?>
                        </h3></td>
                        <?php }?>
                        <td class="row-ID"><h3><?php echo $res_busca['disciplina']?></h3></td>
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
                        <td class="row-name"><h3><?php echo $res_busca['sala'];?></h3></td>
                        <td class="row-cod" ><a class="a"
                         href="cursos_e_disciplinas.php?pg=disciplina&deleta=sim&id=<?php echo $res_busca['id_disciplinas']; ?>"><img title="Excluir Disciplina" src="img/deleta.jpg" width="18" 
                        height="18" border="0" alt=""></a></td>
                        <td class="row-cod">
                            <a class="a" href="cursos_e_disciplinas.php?pg=disciplina&cadastra=nao&id=<?php echo $res_busca['id_disciplinas'];?>"><img title="Editar dados Cadastrais"
                            src="../image/ico-editar.png" width="18" height="18" border="0" ></a>
                        </td>
                    </tr>
                    <?php }?>
                    </tbody>
                </table>
                <?php } ?>

  <br/><br/>



  <!deleção dos disciplinas_____________________________________________________________>
    <?php 
        if (@$_GET['deleta']=='sim') {
            # code...
            $id=@$_GET['id'];
            $sql_delete_disc="delete from disciplinas where id_disciplinas='$id'";
            mysqli_query($conexao, $sql_delete_disc);
                echo "<script language='javascript'>window.location='cursos_e_disciplinas.php?pg=disciplina';</script>";
        }?>

        </div><!--disciplinas-->
  <?php } ?>






<!MOSTRAR OS CURSOS E AS DISCIPLINAS>


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
    <textarea disabled="disabled" name="textarea"  cols="100"  rows="5">
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
            echo " \n    ";
			
		
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