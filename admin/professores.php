<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <?php require_once("topo.php");   ?>
    <title>Professores</title>

    <link rel="shortcut icon" href="../image/logo_ist.gif">
    

<link rel="stylesheet" href="../jquery.superbox.css" type="text/css" media="all" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
  

	<script type="text/javascript" src="../jquery.superbox-min.js"></script>
  
  <script src="js/jquery.maskedinput-1.3.js" type="text/javascript"></script>
</head>

<body>

    <div id="caixa_preta">
    </div><!-- caixa_preta-->

    <!exibir tabela de professores cadastrados>

        <?php if(@$_GET['pg']=='todos'){ ?>
        <div class="box_professores">
            <br /><br />
            <a class="a2" href="professores.php?pg=cadastra">Cadastrar Professor</a>
            <h1>Lista de Professores</h1>
            <?php 
            $sql="select * from professores where nome !=''";
            $con=mysqli_query($conexao,$sql);
            if(mysqli_num_rows($con)==''){
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
                <?php while($res_1=mysqli_fetch_assoc($con)){
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
       (function( $ ) {
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