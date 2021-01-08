<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, width=device-width">

<link href="css/funcionarios.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/bootstrap.min.css">
<title>Administração</title>
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
            width:23%;
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
<?php header('Content-Type: text/html; charset=UTF-8'); require "topo.php"; ?>
<div id="caixa_preta">
</div><!-- caixa_preta -->

<?php if(@$_GET['pg'] == 'todos'){ ?>
<div id="box_funcionarios">
<br /><br />
<a class="btn btn-success" href="funcionarios.php?pg=cadastra">Cadastrar funcionário</a>
<br /><br />
<hr />
<h1>Funcionários</h1>
<?php

$sql_1 = mysqli_query($conexao, "SELECT * FROM funcionarios ");
if(mysqli_num_rows($sql_1) == ''){
	echo "Nenhum funcionário cadastrado no momento";
}else{
?>
   <table  id="customers" border="0">
      <tr>
        <th><strong>Código:</strong></th>
        <th><strong>Nome:</strong></th>
        <th><strong>Profissão:</strong></th>
        <th><strong>Status:</strong></th>
        <th colspan="4">Executar ação:</th>
      </tr>
      <?php while($res_1 = mysqli_fetch_assoc($sql_1)){ ?>
      <tr>
        <td><?php echo $res_1['code']; ?></td>
        <td><?php echo $res_1['nome']; ?></td>
        <td><?php echo $res_1['profissao']; ?></td>
        <!-- <td>R$ <?php //echo number_format($res_1['salario'],2); ?></td> -->
        <td><?php echo $res_1['status']; ?></td>
        <td>
        <a class="a" href="funcionarios.php?pg=todos&func=deleta&id=<?php echo $res_1['id_func']; ?>"><img title="Excluir Funcionário" src="img/deleta.jpg" width="18" height="18" border="0"></a>
        <?php if($res_1['status'] == 'Inativo'){?>
          </td>
          <td>
        <a class="a" href="funcionarios.php?pg=todos&func=ativa&id=<?php echo $res_1['id_func']; ?>&code=<?php echo $res_1['code']; ?>"><img title="Ativar novamente o acesso do funcionário" src="../img/correto.jpg" width="20" height="20" border="0"></a>
        <?php } ?>
        </td>
        <td>          
        <?php if($res_1['status'] == 'Ativo'){?>       
        <a class="a" href="funcionarios.php?pg=todos&func=inativa&id=<?php echo $res_1['id_func']; ?>&code=<?php echo $res_1['code']; ?>"><img title="Inativar funcionário(a)" src="../image/ico_bloqueado.png" width="18" height="18" border="0">		</a>
        <?php } ?>
        </td>
        <td>
        <a class="a" href="funcionarios.php?pg=todos&func=edita&id=<?php echo $res_1['id_func']; ?>"><img title="Editar Dados Cadastrais" src="../image/ico-editar.png" width="18" height="18" border="0"></a>
</td>
      </tr>
      <?php } ?>
    </table>
<br />
<?php } ?>
</div><!-- box_funcionarios -->

<?php if(@$_GET['func'] == 'deleta'){

$id = $_GET['id'];
mysqli_query($conexao, "DELETE FROM funcionarios WHERE id_func = '$id'");
echo "<script language='javascript'>window.location='funcionarios.php?pg=todos';</script>";
}?>

<?php if(@$_GET['func'] == 'ativa'){

$id = $_GET['id'];
$code_f = $_GET['code'];
mysqli_query($conexao, "UPDATE funcionarios SET status = 'Ativo' WHERE id_func = '$id'");
mysqli_query($conexao, "UPDATE  login SET status = 'Ativo' WHERE code = '$code_f'");
echo "<script language='javascript'>window.location='funcionarios.php?pg=todos';</script>";
}?>
<?php if(@$_GET['func'] == 'inativa'){

$id = $_GET['id'];
$code_f = $_GET['code'];
mysqli_query($conexao, "UPDATE funcionarios SET status = 'Inativo' WHERE id_func = '$id'");
mysqli_query($conexao, "UPDATE  login SET status = 'Inativo' WHERE code = '$code_f'");
echo "<script language='javascript'>window.location='funcionarios.php?pg=todos';</script>";
}?>

<?php } ?>
</div><!-- cadastra_funcionarios -->



<?php if($_GET['pg'] == 'cadastra'){ ?>
<div id="cadastra_funcionarios" >
<h1>Cadastrar Funcionários</h1>

<?php if(isset($_POST['button'])){

$code = $_POST['code'];
$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$email = $_POST['email'];
$formacao = $_POST['formacao'];
$graduacao = $_POST['graduacao'];
$pos_graduacao = $_POST['pos_graduacao'];
$mestrado = $_POST['mestrado'];
$doutorado = $_POST['doutorado'];
$salario = $_POST['salario'];
$acesso  = $_POST['acesso'];
$login =$_POST['email'];

$sql_2 = mysqli_query($conexao, "INSERT INTO funcionarios (code, status, profissao, nome, cpf, email, formacao, graduacao, pos_graduacao, mestrado, doutorado, salario) VALUES ('$code', 'Ativo', '$acesso', '$nome', '$cpf', '$email', '$formacao', '$graduacao', '$pos_graduacao', '$mestrado', '$doutorado', '$salario')");

if($acesso != 'Sem acesso'){
  $cpf_crip=md5($cpf);
mysqli_query($conexao, "INSERT INTO login (status, code, senha,senha_rec, nome, painel) VALUES ('Ativo', '$code', '$cpf','$cpf_crip', '$login', '$acesso')");	
enviar($login,$cpf);
}

	echo "<script language='javascript'>window.alert('Funcionário cadastrado com sucesso');window.location='funcionarios.php?pg=todos';</script>";

}?>
<?php if(isset($_POST['cancelar'])){?> 
    <script>window.location='funcionarios.php?pg=todos';</script>
  <?php  }?>



<form name="form1" method="post" action="">
  <table class="users table-resposive" id="table-responsive" border="0">
    <br>
      <!-- <tr>
        <td colspan="1"><center><Code>CÓDIGO</Code></center></td>
      </tr> -->
      <tr>
      <td colspan="1"><center>
      <?php
      $sql_1 = mysqli_query($conexao, "SELECT * FROM funcionarios ORDER BY id_func DESC LIMIT 1");
	  if(mysqli_num_rows($sql_1) == ''){
		  $novo_code = "2597418795";
	  ?>
      <input type="hidden" name="code" class="form-control" value="<?php echo $novo_code; ?>" />
      <input type="text" name="code" class="form-control"  id="" disabled="disabled" value="<?php echo $novo_code; ?>"></td>
	 <?php
      }else{
	  	while($res_1 = mysqli_fetch_assoc($sql_1)){
			$novo_code = $res_1['code']+713;
	  ?>
      <input type="hidden" class="form-control" name="code" value="<?php echo $novo_code; ?>" />
      <input type="hidden" class="form-control" name="code" id="" disabled="disabled" value="<?php echo $novo_code; ?>">
      </center>
    </td>
      <?php }} ?>
      </tr>
  
    <tr>
      <td>Email:</td>
      <td>Nome Completo:</td>
      <td>CPF:</td>
    </tr>
    <tr>
    <td>
      <input type="email" class="form-control" name="email" id="" required></td>
      <td>
      <input type="text" class="form-control" name="nome" id="" required></td>
      <td>
      <input type="text" class="form-control" name="cpf" id="textfield3" required></td>
    </tr>
    <tr>
      <td>Acesso</td>
      <td>Formação Acadêmica</td>
      <td>Graduação(ões):</td>
    </tr>
    <tr>
    <td><select name="acesso" class="form-control" size="1">
        <option value="Sem acesso">Sem acesso</option>
        <option value="tesouraria">Tesoureiro</option>
        <option value="Administracao">Administradores</option>
        <option value="secretaria">Secretaria</option>
        <option value="Coordenacao">Coordenação</option>
      </select></td>
      <td>
        <select name="formacao" class="form-control col-sm-12" size="1" id="select">
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
      <td><input type="text" class="form-control" name="doutorado" id=""></td>
    </tr>
    <tr>
      <td>Salário:</td>
    </tr>
    <tr>
      <td><input type="text" class="form-control"  name="salario" id="" required></td>
    </tr>
    <tr>
      <td><input class="input" type="submit" name="button" id="button" value="Cadastrar"></td>
      <td><button class="btn btn-danger"  name="cancelar" >Cancelar</button></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
</div><!-- cadastra_funcionarios -->
<?php }?>


<?php if(@$_GET['func'] == 'edita'){ ?>
<div id="edita_funcionarios">
<h1>Editar dados cadastrais</h1>

<?php if(isset($_POST['button'])){
$id = $_GET['id'];
$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$email = $_POST['email'];
$formacao = $_POST['formacao'];
$graduacao = $_POST['graduacao'];
$pos_graduacao = $_POST['pos_graduacao'];
$mestrado = $_POST['mestrado'];
$doutorado = $_POST['doutorado'];
$salario = $_POST['salario'];
$profissao = $_POST['acesso'];
$code_f=$_POST['code'];


$sql_2 = mysqli_query($conexao, "UPDATE funcionarios SET nome = '$nome', cpf = '$cpf', email = '$email', formacao = '$formacao', graduacao = '$graduacao', pos_graduacao = '$pos_graduacao', mestrado = '$mestrado', doutorado = '$doutorado', salario = '$salario', profissao='$profissao' WHERE id_func = '$id'");

if($sql_2 == ''){
	echo "<script language='javascript'>window.alert('Ocorreu um erro tente novamente!');window.location='';</script>";
}else{
  if($profissao != 'Sem acesso'){
    mysqli_query($conexao, "UPDATE login SET  nome='$email', painel='$profissao' WHERE code='$code_f'");	
    echo "<script language='javascript'>window.alert('Atualização realizada com sucesso');window.location='funcionarios.php?pg=todos';</script>";
    exit();
  }
    
     
    
 
  echo "<script language='javascript'>window.alert('Atualização realizada com sucesso!');window.location='funcionarios.php?pg=todos';</script>";
  exit();

}}?>

<?php if(isset($_POST['cancelar'])){?> 
    <script>window.location='funcionarios.php?pg=todos';</script>
  <?php  }?>

<?php 
$sql_1 = mysqli_query($conexao, "SELECT * FROM funcionarios WHERE id_func = ".$_GET['id']."");
while($res_1 = mysqli_fetch_assoc($sql_1)){
?>
<form name="form1" method="post" action="">
  <table width="900" class="users" id="table-responsive"border="0">
    <tr>
      <td>Nome:</td>
      <td>CPF:</td>
      <td>E-mail:</td>
    </tr>
    <tr>
      <td><input type="text" name="nome" id="textfield2" value="<?php echo $res_1['nome']; ?>"></td>
      <td>
        <input type="text" name="cpf" id="textfield3" value="<?php echo $res_1['cpf']; ?>">
     </td>
      <td>
        <input type="email" name="email" id="textfield4" value="<?php echo $res_1['email']; ?>">
      </td>
    </tr>
    <tr>
      <td>Formação Acadêmica</td>
      <td>Graduação(ões):</td>
      <td>Pos-graduação(ões):</td>
    </tr>
    <tr>
      <td>
        <select name="formacao" size="1" id="select">
          <option value="<?php echo $res_1['formacao']; ?>"><?php echo $res_1['formacao']; ?></option>
          <option value=""></option>
          <option value="Ensino Médio Incompleto">Ensino Médio Incompleto</option>
          <option value="Ensino Médio Completo">Ensino Médio Completo</option>
          <option value="Superior Incompleto">Superior Incompleto</option>
          <option value="Superior Completo">Superior Completo</option>
        </select>
      </td>
      <td>
        <input type="hidden" name="code" value="<?php echo $res_1['code']?>">
        <input type="text" name="graduacao" id="textfield5" value="<?php echo $res_1['graduacao']; ?>">
     </td>
      <td><input type="text" name="pos_graduacao" id="textfield6" value="<?php echo $res_1['pos_graduacao']; ?>"></td>
    </tr>
    <tr>
      <td>Mestrado(s):</td>
      <td>Doutorado(s):</td>
      <td>Salário:</td>
    </tr>
    <tr>
      <td><input type="text" name="mestrado" id="textfield7" value="<?php echo $res_1['mestrado']; ?>"></td>
      <td><input type="text" name="doutorado" id="textfield" value="<?php echo $res_1['doutorado']; ?>"></td>
      <td><input type="text" name="salario" id="textfield9" value="<?php echo $res_1['salario']; ?>"></td>
    </tr>
    <tr>
      <td>ACESSO:</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
    <td>
        <select name="acesso" size="1">
          <option value="<?php echo $res_1['profissao']; ?>"><?php echo $res_1['profissao']; ?></option>
          <option value=""></option>
          <option value="Coordenacao">COORDENAÇÃO</option>
          <option value="tesoureiro">TESOURARIA</option>
          <option value="secretaria">SECRETARIA</option>
          <option value="Administracao">ADMINISTRAÇÃO</option>
        </select>
     </td>
      
      <td><input class="input" type="submit" name="button" id="button" value="Atualizar"></td>
      <td><button class="btn btn-danger"  name="cancelar" >Cancelar</button></td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
<?php } ?>
</div><!-- cadastra_funcionarios -->

<?php } ?>
</div><!-- box_funcionarios -->
<?php require "rodape.php"; ?>
</body>
</html>