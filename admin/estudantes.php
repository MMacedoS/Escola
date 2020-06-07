<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Estudante</title>

    <link rel="shortcut icon" href="../image/logo_ist.gif">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
  

	<script type="text/javascript" src="js/jquery.js"></script>
  
  <script src="js/jquery.maskedinput-1.3.js" type="text/javascript"></script>
    <?php require_once("topo.php");
    
    ?>
  <script>
    function is_cpf (c) {

        if((c = c.replace(/[^\d]/g,"")).length != 11)
        return false

        if (c == "00000000000")
        return false;

        var r;
        var s = 0;

        for (i=1; i<=9; i++)
        s = s + parseInt(c[i-1]) * (11 - i);

        r = (s * 10) % 11;

        if ((r == 10) || (r == 11))
        r = 0;

        if (r != parseInt(c[9]))
        return false;

        s = 0;

        for (i = 1; i <= 10; i++)
        s = s + parseInt(c[i-1]) * (12 - i);

        r = (s * 10) % 11;

        if ((r == 10) || (r == 11))
        r = 0;

        if (r != parseInt(c[10]))
        return false;

        return true;
        }


        function fMasc(objeto,mascara) {
        obj=objeto
        masc=mascara
        setTimeout("fMascEx()",1)
        }

        function fMascEx() {
        obj.value=masc(obj.value)
        }

        function mCPF(cpf){
        cpf=cpf.replace(/\D/g,"")
        cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
        cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
        cpf=cpf.replace(/(\d{3})(\d{1,2})$/,"$1-$2")
        return cpf
        }

        cpfCheck = function (el) {
        document.getElementById('cpfResponse').innerHTML = is_cpf(el.value)? '<span style="color:green">válido</span>' : '<span style="color:red">inválido</span>';
        if(el.value=='') document.getElementById('cpfResponse').innerHTML = '';
        }
  </script>
   
</head>

<body>
    <!--Buscando estudante do banco -->
    <div id="caixa_preta">
    </div>

    <!-- caixa_preta -->
    <?php if(@$_GET['pg'] == 'todos'){ ?>
    <div id="box_aluno">
        <br /><br />
        <div class="row">
            <a class="a2" href="estudantes.php?pg=cadastra&bloco=1">Cadastrar novo aluno </a>
            <form class="form" method="post" action="estudantes.php?pg=todos">
                <input type="text" class="pesq" name="nome" value="" placeholder="pesquise o aluno...">
                <input class="pesq" type="submit" value="Pesquisar">
            </form>
        </div>
        <h1>Alunos que estão cadastrados</h1>
        <?php
if(isset($_POST['nome'])){
  $pesquisa=$_POST['nome'];
  $sql_1 = "SELECT * FROM estudantes WHERE  nome like '%".$pesquisa."%'  and status != 'encerrado' order by nome asc";
}else{
  $sql_1 = "SELECT * FROM estudantes WHERE  nome != '' and status != 'encerrado' order by nome asc";
}
$consulta = mysqli_query($conexao, $sql_1);
if(mysqli_num_rows($consulta) == ''){
	echo "<h2>Não exisite nenhum aluno cadastrado no momento</h2>";
}else{
?>

        <table class="users" id="table-responsive" border="0">

            <tr>
                <td class="row-1 row-email"><strong>Status:</strong></td>
                <td class="row-1 row-email"><strong>Código:</strong></td>
                <td class="row-2 row-name"><strong>Nome:</strong></td>
                <td class="row-3 row-email"><strong>Turma(ano):</strong></td>
                <td class="row-4 row-email"><strong>Turno:</strong></td>
                <td class="row-2 row-email"><strong>Mensalidade:</strong></td>
                <td class="row-2 row-executar" colspan="4">Executar</td>
            </tr>


            <?php while($res_1 = mysqli_fetch_assoc($consulta)){ ?>
            <tr>
                <td class="row-email">
                    <h3><?php echo $res_1['status']; ?></h3>
                </td>

                <td class="row-email">
                    <h3><?php echo $res_1['matricula']; ?></h3>
                </td>

                <td class="row-name">
                    <h3><?php echo $res_1['nome']; ?></h3>
                </td>

                <td class="row-email">
                    <h3>
                        <?php 
                  $id_aluno=$res_1['id_estudantes'];
                  $busca_curso="SELECT c.curso, c.turno FROM cursos c 
                  inner join cursos_estudantes ce on c.id_cursos=ce.id_cursos 
                  INNER join estudantes e on ce.id_estudantes=e.id_estudantes where 
                      e.id_estudantes='$id_aluno' ";
                    $con_curso=mysqli_query($conexao,$busca_curso);
                    $res_curso=mysqli_fetch_assoc($con_curso);
                    echo $res_curso['curso']; ?>
                    </h3>
                </td>
                <td class="row-email">
                    <h3>
                        <?php echo $res_curso['turno']; ?>
                    </h3>
                </td>

                <td class="row-job">
                    <h3>R$ <?php echo $res_1['mensalidade']; ?></h3>
                </td>
                <td class="row-ID"></td>
                <td class="row-executar">
                    <a class="a" href="estudantes.php?pg=todos&func=deleta&id=<?php 
        echo $res_1['id_estudantes'];?>&code=<?php echo $res_1['matricula']; ?>">
                        <img title="Excluir Aluno(a)" src="img/deleta.jpg" width="18" height="18" border="0"></a>
                    <?php if($res_1['status'] == 'Inativo'){ ?>
                    <a class="a" href="estudantes.php?pg=todos&func=ativa&id=<?php 
        echo $res_1['id_estudantes']; ?>&code=<?php echo $res_1['matricula']; ?>">
                        <img title="Ativar novamente Aluno(a)" src="../image/correto.jpg" width="20" height="20"
                            border="0"></a>
                    <?php } ?>
                    <?php if($res_1['status'] == 'Ativo'){?>
                    <a class="a" href="estudantes.php?pg=todos&func=inativa&id=<?php 
        echo $res_1['id_estudantes']; ?>&code=<?php echo $res_1['matricula']; ?>">
                        <img title="Inativar Aluno(a)" src="../image/ico_bloqueado.png" width="18" height="18"
                            border="0"></a>
                    <?php } ?>
                    <a class="a" href="estudantes.php?pg=cadastra&edita=1&id=<?php echo $res_1['id_estudantes'];?>"><img
                            title="Editar dados Cadastrais" src="../image/ico-editar.png" width="18" height="18"
                            border="0" alt=""></a>
                    <?php 
          $busca_est="SELECT id_cursos FROM cursos_estudantes where id_estudantes=".$res_1['id_estudantes'];
          $con_estudante=mysqli_query($conexao,$busca_est);
          while($res_estudantes=mysqli_fetch_assoc($con_estudante)){
         ?>
                    <a class="a" rel='superbox[iframe][800x600]' href="mostrar_resultado.php?q=<?php
        echo $res_1['matricula']; ?>&s=aluno&curso=<?php echo $res_estudantes['id_cursos']; ?>">
                        <img title="Informações detalhada deste aluno(a)" src="../image/visualizar16.gif" width="18"
                            height="18" border="0"></a>
                    <?php } ?>
                </td>

            </tr>

            <?php } ?>

        </table>

        <br />
        <?php } // aqui fecha a consulta ?>








        <!-- Exclusão, ativação e Desativação-->

        <?php if(@$_GET['func'] == 'deleta'){

$id = $_GET['id'];
$code = $_GET['code'];

$sql_del = "UPDATE estudantes SET status = 'encerrado' WHERE id_estudantes = '$id'";
$sql_del2 = "UPDATE login SET status = 'Inativo' WHERE code = '$code'";
mysqli_query($conexao, $sql_del);
mysqli_query($conexao, $sql_del2);

echo "<script language='javascript'>
window.location='estudantes.php?pg=todos';</script>";
}?>


        <?php if(@$_GET['func'] == 'ativa'){

$id = $_GET['id'];
$code = $_GET['code'];

$sql_editar = "UPDATE estudantes SET status = 'Ativo' WHERE id_estudantes = '$id'";
$sql_editar2 = "UPDATE login SET status = 'Ativo' WHERE code = '$code'";
mysqli_query($conexao, $sql_editar);
mysqli_query($conexao,$sql_editar2);

echo "<script language='javascript'>window.location='estudantes.php?pg=todos';</script>";
}?>


        <?php if(@$_GET['func'] == 'inativa'){

$id = $_GET['id'];
$code = $_GET['code'];

$sql_editar = "UPDATE estudantes SET status = 'Inativo' WHERE id_estudantes = '$id'";
$sql_editar2 = "UPDATE login SET status = 'Inativo' WHERE code = '$code'";
mysqli_query($conexao, $sql_editar);
mysqli_query($conexao,$sql_editar2);

echo "<script language='javascript'>window.location='estudantes.php?pg=todos';</script>";
}?>


        <?php }// aqui fecha a PG todos ?>





        <!--CADASTRO DOS ESTUDANTES - ETAPA 1-->


        <?php  if(@$_GET['pg'] == 'cadastra'){ ?>
        <?php  if(@$_GET['bloco'] == '1'){ ?>
        <div id="box_aluno">
            <div id="cadastra_estudante">
                <h1>1º Passo - Cadastre os dados pessoais</h1>

                <?php  if(isset($_POST['button'])){

$code = $_POST['code'];
$nome = $_POST['nome']." ".$_POST['sobrenome'];
$cpf = $_POST['cpf'];
$email = $_POST['email'];
$nascimento = $_POST['nascimento'];
$mae = $_POST['mae'];
$pai = $_POST['pai'];
$estado = $_POST['estado'];
$cidade = $_POST['cidade'];
$bairro = $_POST['bairro'];
$endereco = $_POST['endereco'];
$complemento = $_POST['complemento'];
$tel_residencial = $_POST['tel_residencial'];
$cep = $_POST['cep'];
$celular = $_POST['celular'];
$usuario =$_POST['email'];
$senha_rec=md5($cpf);

$sql_2 = "INSERT INTO estudantes (matricula, status, nome, cpf, email, nascimento, mae, pai, estado, cidade, bairro, endereco, complemento, cep, tel_residencial, celular) VALUES ('$code', 'Ativo', '$nome', '$cpf', '$email', '$nascimento', '$mae', '$pai', '$estado', '$cidade', '$bairro', '$endereco', '$complemento', '$cep', '$tel_residencial', '$celular')";

$sql_login = "INSERT INTO login (status, code, senha,senha_rec, nome, painel) VALUES ('Ativo', '$code', '$cpf','$senha_rec', '$usuario', 'Aluno')";

$cadastra = mysqli_query($conexao, $sql_2);
if($cadastra){
$cadastra_login = mysqli_query($conexao, $sql_login);
enviar($usuario,$cpf);
echo "<script language='javascript'>window.alert('Dados cadastrados com sucesso! Click em OK para avançar');window.location='estudantes.php?pg=cadastra&bloco=2&code=$code';</script>";


}else{
  ?>
                <script>
                alert('erro ao cadastrar');
                </script>

                <?php
}
}?>
                <?php if(isset($_POST['cancelar'])){?>
                <script>
                window.location = 'estudantes.php?pg=todos';
                </script>
                <?php  }?>


                <form name="form1" method="post" action="">
                    <table class="users" id="table-responsive" border="0">
                        <tr>
                            <td></td>
                            <td colspan="2"><strong>Foi criado um código único para este aluno</strong></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <?php 
	 $sql_1 = "SELECT * FROM estudantes ORDER BY id_estudantes DESC LIMIT 1";
	 $con_est = mysqli_query($conexao, $sql_1);
	 if(mysqli_num_rows($con_est) == ''){
		 $novo_code = "587418";
	?>
                            <td><input type="text" name="code" id="textfield" disabled="disabled"
                                    value="<?php echo $novo_code; ?>"></td>
                            <input type="hidden" name="code" value="<?php echo $novo_code; ?>" />
                            <?php
		 }else{
	 
	 	while($res_1 = mysqli_fetch_assoc($con_est)){
			$novo_code = $res_1['matricula']+741+$res_1['id_estudantes'];
	 ?>
                            <td><input type="text" class="form-control" name="code" id="textfield" disabled="disabled"
                                    value="<?php echo $novo_code; ?>"></td>
                            <input type="hidden" class="form-control" name="code" value="<?php echo $novo_code; ?>" />
                            <?php } } ?>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Nome:</td>
                            <td>Sobrenome:</td>
                            <td>CPF:</td>

                        </tr>
                        <td><label for="celular"></label>
                            <input type="text" name="nome" class="form-control" id="textfield2"></td>
                        <td><label for="celular"></label>
                            <input type="text" name="sobrenome" class="form-control" id="textfield2" required></td>
                        <td><label for="tel_amigo"></label>
                        <input id="cpf" name="cpf" class="form-control" type="text" onkeyup="cpfCheck(this)" maxlength="18" onkeydown="javascript: fMasc( this, mCPF );"required> <span id="cpfResponse"></span>

                            </tr>
                            <tr>
                                <td>Email:</td>
                                <td>Data de nascimento:</td>
                                <td>Nome da mãe:</td>
                            </tr>
                            <tr>
                                <td><label for="tel_amigo"></label>
                                    <input type="email" class="form-control" name="email" id="textfield3" required></td>
                                <td><label for="nascimento"></label>
                                    <input type="date" class="form-control" name="nascimento" id="textfield4"></td>
                                <td><label for="select"></label>
                                    <input type="text" class="form-control" name="mae" id="textfield12"></td>

                            </tr>
                            <tr>

                                <td>Pai:</td>
                                <td>Cidade:</td>
                                <td>Bairro:</td>
                            </tr>
                            <tr>
                                <td><input type="text" class="form-control" name="pai" id="textfield5"></td>
                                <td><input type="text" class="form-control" name="cidade" id="textfield7"></td>
                                <td><input type="text" class="form-control" name="bairro" id="textfield8"></td>
                            </tr>
                            <tr>
                                <td>Estado:</td>
                                <td>Endereço:</td>
                                <td>Complemento:</td>

                            </tr>
                            <tr>
                                <td><input type="text" class="form-control" name="estado" id="textfield5"></td>
                                <td><input type="text" class="form-control" name="endereco" id="textfield8"></td>
                                <td><input type="text" class="form-control" name="complemento" id="textfield8"></td>
                            </tr>
                            <tr>
                                <td>CEP:</td>
                                <td>Telefone residencial:</td>
                                <td>Telefone Celular:</td>
                            </tr>
                            <tr>
                                <td><input type="text" class="form-control" name="cep" id="textfield8"
                                        placeholder="ex. 00000-000"></td>
                                <td><input type="phone" class="form-control" name="tel_residencial" id="textfield9"
                                        placeholder="ex. (00) 0000-0000"></td>
                                <td><input type="number" class="form-control" name="celular" id="textfield10"
                                        placeholder="ex. (00) 00000-0000"></td>
                            </tr>
                            <tr>
                                <td><input class="input" type="submit" name="button" id="button" value="Avançar"></td>
                                <td><button class="btn btn-danger" name="cancelar">Cancelar</button></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                    </table>
                </form>
                <br />

            </div><!-- cadastra_estudante -->
        </div>
        <!-- box aluno -->
        <?php } // aqui fecha o bloco 1 ?>




        <!--CADASTRO DOS ESTUDANTES - ETAPA 2-->

        <?php if(@$_GET['bloco'] == '2'){ ?>
        <div id="box_aluno">
            <div id="cadastra_estudante">
                <h1>2º Passo - Finalizar preenchimento de dados</h1>

                <?php if(isset($_POST['button'])){

$code = $_GET['code'];
$serie = $_POST['serie'];
$cuidado_especial = $_POST['cuidado_especial'];
$mensalidade = $_POST['mensalidade'];
$vencimento = $_POST['vencimento'];
$tel_cobranca = $_POST['tel_cobranca'];
$obs = $_POST['obs'];
$d = date("d");
$m = date("m");
$a = date("Y");
$code_cobranca = $code*2;
///buscando estudante para armazenar nas tabela cursos_estudantes
$sql_busca_est="select id_estudantes from estudantes where matricula='$code'";
$cadastra=$con_busca_est=mysqli_query($conexao,$sql_busca_est);

while($res_busca_est=mysqli_fetch_assoc($con_busca_est)){
$estudante=$res_busca_est['id_estudantes'];}

$sql_cursos_est="INSERT INTO `cursos_estudantes` (`id_cursos`, `id_estudantes`, `ano_letivo`) VALUES ('$serie', '$estudante', '$a');";
$cadastra=mysqli_query($conexao,$sql_cursos_est);
if($cadastra){

$sql_3 = "UPDATE estudantes SET  atendimento_especial = '$cuidado_especial', mensalidade = '$mensalidade', vencimento = '$vencimento', tel_cobranca = '$tel_cobranca', obs = '$obs' WHERE matricula = '$code'";

$cadastra=mysqli_query($conexao, $sql_3);
if($cadastra){


$sql_mensal = "INSERT INTO mensalidades (code, matricula, d_cobranca, vencimento, valor, status, dia, mes, ano) VALUES ('$code_cobranca', '$code', '$d/$m/$a', '$vencimento/$m/$a', '$mensalidade', 'Aguarda Pagamento', '$d', '$m', '$a')";

$cadastra=mysqli_query($conexao, $sql_mensal);
if($cadastra){
echo "<script language='javascript'>window.location='estudantes.php?pg=cadastra&bloco=3';</script>";
}else{
  ?><script>
                alert('erro ao inserir mensalidades');
                </script>
                <?php
}//mensalidades

}///upadate atendimento especial
else{?>
                <script>
                alert('erro ao atualizar atendimento especial');
                </script>
                <?php }//update atendimento especial
}else{?>
                <script>
                alert('erro ao inserir o cursos e estudante ');
                </script>
                <?php }

}?>
                <?php if(isset($_POST['cancelar'])){?>
                <script>
                window.location = 'estudantes.php?pg=todos';
                </script>
                <?php  }?>

                <form name="form1" method="post" action="">
                    <table class="users" id="table-responsive" border="0">
                        <tr>
                            <td width="350">Série que este aluno vai se matricular:</td>
                            <td width="204">Cuidado Especial</td>
                        </tr>
                        <tr>
                            <td>
                                <select name="serie" id="serie">
                                    <?php
      $sql_4 = "SELECT * FROM cursos";
	  $resultado = mysqli_query($conexao, $sql_4);
	  	while($res_1 = mysqli_fetch_assoc($resultado)){
	  ?>
                                    <option value="<?php echo $res_1['id_cursos']; ?>">
                                        <?php echo $res_1['curso'].' '.$res_1['turno']; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td><label for="cuidado_especial"></label>
                                <select name="cuidado_especial" size="1" id="cuidado_especial">
                                    <option value="SIM">SIM</option>
                                    <option value="NÃO">NÃO</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>Valor da mensalidade:</td>
                            <td>Dia de vencimento:</td>
                            <td>Telefone de cobrança:</td>
                        </tr>
                        <tr>
                            <td><label for="mensalidade"></label>
                                <input type="text" name="mensalidade" id="mensalidade"></td>
                            <td><label for="vencimento"></label>
                                <input type="text" name="vencimento" id="vencimento"></td>
                            <td><label for="tel_cobranca"></label>
                                <input type="text" name="tel_cobranca" id="tel_cobranca"></td>
                        </tr>
                        <tr>
                            <td>Observações para este(a) aluno(a)</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="3"><label for="obs"></label>
                                <textarea name="obs" id="obs" cols="45" rows="5"></textarea></td>
                        </tr>
                        <tr>
                            <td><input class="input" type="submit" name="button" id="button" value="Finalizar"></td>
                            <td><button class="btn btn-danger" name="cancelar">Cancelar</button></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                    </table>
                </form>
                <br />

            </div><!-- cadastra_estudante -->


            <?php }// aqui fecha o bloco 2 ?>


            <?php if(@$_GET['bloco'] == '3'){ ?>
            <div id="cadastra_estudante">
                <h1>3º Passo - Mensagem de confirmação</h1>
                <table>
                    <tr>
                        <td>
                            <h4>Este(a) Estudante foi cadastrado perfeitamente no sistema!
                                <ul>
                                    <li>Mensalmente será gerado a cobrança no valor informado!</li>
                                    <li>Este estudante já tem acesso ao sistema usando seu código e seu CPF como senha!
                                    </li>
                                </ul>
                                <a href="estudantes.php?pg=todos">Clique aqui para voltar para página inicial</a>
                            </h4>
                        </td>
                    </tr>
                </table>
                <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
            </div><!-- cadastra_estudante -->
        </div><!-- box aluno -->


        <?php }// aqui fecha o bloco 3 ?>


        <?php }// aqui fecha a PG cadastra ?>

        <!--ATUALIZAÇÃO DOS ESTUDANTES - ETAPA 1-->


        <?php  if(@$_GET['pg'] == 'cadastra'){ ?>
        <?php  if(@$_GET['edita'] == '1'){ ?>
        <div id="box_aluno">
            <div id="cadastra_estudante">
                <h1>1º Passo - Atualiza os dados pessoais</h1>
                <?php 
                    $id=$_GET['id'];
                   
                    $sql_1 = "SELECT * FROM estudantes WHERE id_estudantes = '$id'";
                    $edit= mysqli_query($conexao,$sql_1);
                        while($res_1 = mysqli_fetch_assoc($edit)){
                        ?>
                <?php  if(isset($_POST['button'])){
$id=$_GET['id'];
$code = $_POST['code'];
$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$email = $_POST['email'];
$nascimento = $_POST['nascimento'];
$mae = $_POST['mae'];
$pai = $_POST['pai'];
$estado = $_POST['estado'];
$cidade = $_POST['cidade'];
$bairro = $_POST['bairro'];
$endereco = $_POST['endereco'];
$complemento = $_POST['complemento'];
$tel_residencial = $_POST['tel_residencial'];
$cep = $_POST['cep'];
$celular = $_POST['celular'];
$status=$_POST['status'];

$sql_2 = "update estudantes set status='$status', nome='$nome',
 cpf='$cpf', email='$email', nascimento='$nascimento', mae='$mae', pai='$pai', estado='$estado',
  cidade='$cidade', bairro='$bairro', endereco='$endereco', complemento='$complemento',
   cep='$cep', tel_residencial='$tel_residencial', celular='$celular' 
   where id_estudantes='$id'";

$sql_login = "update login set status='$status', nome='$email',painel='Aluno'
 where code='$code'";

$cadastra = mysqli_query($conexao, $sql_2);
if($cadastra == ''){
 echo "<script language='javascript'>window.alert('Ocorreu um erro tente novamente!');window.location='';</script>";
}else{

$cadastra_login = mysqli_query($conexao, $sql_login);
echo "<script language='javascript'>window.alert('Dados atualizados com sucesso! Click em OK para avançar');window.location='estudantes.php?pg=cadastra&edita=2&code=$code&id=$id';</script>";

}}?>
                <?php if(isset($_POST['cancelar'])){?>
                <script>
                window.location = 'estudantes.php?pg=todos';
                </script>
                <?php  }?>

                <form name="form1" method="post" action="">
                    <table class="users" id="table-responsive" border="0">
                        <tr>
                            <td></td>
                            <td colspan="2"><strong>código único do aluno</strong></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>

                            <td><input type="text" name="code" id="textfield" disabled="disabled"
                                    value="<?php echo $res_1['matricula']; ?>"></td>
                            <input type="hidden" name="code" value="<?php echo $res_1['matricula'];?>" />

                            <td></td>
                        </tr>
                        <tr>
                            <td>Nome:</td>
                            <td>CPF:</td>
                            <td>E-mail:</td>

                        </tr>
                        <td><label for="celular"></label>
                            <input type="text" name="nome" id="textfield2" value="<?php echo $res_1['nome'];?>"></td>
                        <td><label for="tel_amigo"></label>
                            <input type="text" name="cpf" id="doc" value="<?php echo $res_1['cpf'];?>"></td>
                        <td><label for="tel_amigo"></label>
                            <input type="text" name="email" id="textfield3" value="<?php echo $res_1['email'];?>"></td>

                        </tr>
                        <tr>
                            <td>Data de nascimento:</td>
                            <td>Nome da mãe:</td>
                            <td>Nome do Pai:</td>
                        </tr>
                        <tr>
                            <td><label for="nascimento"></label>
                                <input type="text" name="nascimento" id="textfield4"
                                    value="<?php echo $res_1['nascimento'];?>"></td>
                            <td><label for="select"></label>
                                <input type="text" name="mae" id="textfield12" value="<?php echo $res_1['mae'];?>"></td>
                            <td><input type="text" name="pai" id="textfield5" value="<?php echo $res_1['pai'];?>"></td>
                        </tr>
                        <tr>
                            <td>Estado:</td>
                            <td>Cidade:</td>
                            <td>Bairro:</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="estado" id="textfield6" value="<?php echo $res_1['estado'];?>">
                            </td>
                            <td><input type="text" name="cidade" id="textfield7" value="<?php echo $res_1['cidade'];?>">
                            </td>
                            <td><input type="text" name="bairro" id="textfield8" value="<?php echo $res_1['bairro'];?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Endereço:</td>
                            <td>Complemento:</td>
                            <td>Cep:</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="endereco" id="textfield8"
                                    value="<?php echo $res_1['endereco'];?>"></td>
                            <td><input type="text" name="complemento" id="textfield8"
                                    value="<?php echo $res_1['complemento'];?>"></td>
                            <td><input type="text" name="cep" id="textfield8" value="<?php echo $res_1['cep'];?>"></td>
                        </tr>
                        <tr>
                            <td>Telefone residencial:</td>
                            <td>Telefone Celular:</td>

                        </tr>
                        <tr>
                            <td><input type="text" name="tel_residencial" id="textfield9"
                                    value="<?php echo $res_1['tel_residencial'];?>"></td>
                            <td><input type="text" name="celular" id="textfield10"
                                    value="<?php echo $res_1['celular'];?>"></td>
                            <!-- <td><input type="text" name="tel_amigo" id="textfield11" value="<?php echo $res_1['tel_amigo'];?>"></td> -->
                        </tr>
                        <tr>
                            <td>Status:</td>
                        </tr>
                        <tr>
                            <th>
                                <label for="select"></label>
                                <select name="status" id="select" size="1">
                                    <option value="<?php echo $res_1['status'];?>">
                                        <?php echo $res_1['status'];?>
                                    </option>
                                    <option value="Ativo">Ativo</option>
                                    <option value="Inativo">Inativo</option>
                                </select>
                            </th>
                        </tr>
                        <tr>
                            <td><input class="input" type="submit" name="button" id="button" value="Atualizar"></td>
                            <td><button class="btn btn-danger" name="cancelar">Cancelar</button></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                    </table>
                    <?php }?>
                </form>
                <br />

            </div><!-- cadastra_estudante -->
        </div><!-- box aluno-->
        
        <?php }?>
        <?php } // aqui fecha o bloco 1 ?>


        <!ATUALIZANDO DOS ESTUDANTES - ETAPA 2>

            <?php if(@$_GET['edita'] == '2'){ ?>
            <div id="box_aluno">
                <div id="cadastra_estudante">
                    <h1>2º Passo - Finalizar preenchimento de dados</h1>
                    <?php 
                    $code=$_GET['code'];
                   
                    $sql_1 = "SELECT * FROM estudantes WHERE matricula='$code'";
                    $edit= mysqli_query($conexao,$sql_1);
                        while($res_2=mysqli_fetch_assoc($edit)){
                        ?>
                    <?php if(isset($_POST['button'])){
$id_estuda=$res_2['id_estudantes'];
$code = $_GET['code'];
$serie = $_POST['serie'];
$cuidado_especial = $_POST['cuidado_especial'];
$mensalidade = $_POST['mensalidade'];
$vencimento = $_POST['vencimento'];
$tel_cobranca = $_POST['tel_cobranca'];
$obs = $_POST['obs'];

///buscando estudante para armazenar nas tabela cursos_estudantes

$d = date("d");
$m = date("m");
$a = date("Y");
$code_cobranca = $code*2;


echo $sql_cursos_est="UPDATE `cursos_estudantes` set id_cursos='$serie', ano_letivo='$a' where id_estudantes='$id_estuda'";
$cadastra=mysqli_query($conexao,$sql_cursos_est);
if($cadastra){
$sql_3 = "UPDATE estudantes SET  atendimento_especial = '$cuidado_especial', mensalidade = '$mensalidade', vencimento = '$vencimento', tel_cobranca = '$tel_cobranca', obs = '$obs' WHERE matricula = '$code'";

$cadastra=mysqli_query($conexao, $sql_3);

if($cadastra){

$sql_mensal = "UPDATE mensalidades SET d_cobranca='$d/$m/$a', vencimento='$vencimento/$m/$a', valor='$mensalidade', status='Aguarda Pagamento', dia='$d', mes='$m', ano='$a' 
where code='$code_cobranca'";

$cadastra=mysqli_query($conexao, $sql_mensal);
if($cadastra){
echo "<script language='javascript'>window.location='estudantes.php?pg=cadastra&edita=3';</script>";
}//update mensalidades
else{?>
                    <script>
                    alert('erro ao inserir mensalidades');
                    </script>
                    <?php
}
}else{?>
                    <script>
                    alert('Erro ao inserir atendimento especial');
                    </script>
                    <?php
}//update atendimento especial
}//update cursos estudantes
else{
?>
                    <script>
                    alert('Erro ao cadastrar o curso para este estudante');
                    </script>
                    <?php
echo $sql_cursos_est;
}
 }?>
                    <?php if(isset($_POST['cancelar'])){?>
                    <script>
                    window.location = 'estudantes.php?pg=todos';
                    </script>
                    <?php  }?>

                    <form name="form1" method="post" action="">
                        <table class="users" id="table-responsive" border="0">
                            <tr>
                                <td width="350">Série que este aluno vai se matricular:</td>
                                <td width="204">Cuidado Especial</td>
                            </tr>
                            <tr>
                                <td>
                                    <select name="serie" id="serie">
                                        <?php $atua=$res_2['id_estudantes'];
          
          $a = date("Y");
        $sql_buscaid="Select id_cursos from cursos_estudantes where id_estudantes='$atua'";
        $con_buscaid=mysqli_query($conexao,$sql_buscaid);
        while($res_buscaid=mysqli_fetch_assoc($con_buscaid)){
          $cursosid=$res_buscaid['id_cursos'];
        }        

        $sql_busca_curso="Select curso, turno from cursos where id_cursos ='$cursosid'";
        $con_busca_curso=mysqli_query($conexao,$sql_busca_curso);
        while($res_buscacurso=mysqli_fetch_assoc($con_busca_curso)){
          $cursos=$res_buscacurso['curso'];
       
        ?>
                                        <option value="<?php echo $cursosid; ?>">
                                            <?php echo $cursos.' | '.$res_buscacurso['turno'];?></option>
                                        <?php } ?>

                                        <?php 


      $sql_4 = "SELECT * FROM cursos";
	  $resultado = mysqli_query($conexao, $sql_4);
	  	while($res_1 = mysqli_fetch_assoc($resultado)){
	  ?>
                                        <option value="<?php echo $res_1['id_cursos']; ?>">
                                            <?php echo $res_1['curso'].' '.$res_1['turno']; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>

                                <td><label for="cuidado_especial"></label>
                                    <select name="cuidado_especial" size="1" id="cuidado_especial">
                                        <option value="<?php echo $res_2['atendimento_especial']; ?>">
                                            <?php echo $res_2['atendimento_especial']; ?></option>
                                        <option value="SIM">SIM</option>
                                        <option value="NÃO">NÃO</option>
                                    </select></td>
                            </tr>
                            <tr>
                                <td>Valor da mensalidade:</td>
                                <td>Data de vencimento:</td>
                                <td>Telefone de cobrança:</td>
                            </tr>
                            <tr>
                                <td><label for="mensalidade"></label>
                                    <input type="text" name="mensalidade" id="mensalidade"
                                        value="<?php echo $res_2['mensalidade'];?>"></td>
                                <td><label for="vencimento"></label>
                                    <input type="text" name="vencimento" id="vencimento"
                                        value="<?php echo $res_2['vencimento'];?>"></td>
                                <td><label for="tel_cobranca"></label>
                                    <input type="text" name="tel_cobranca" id="tel_cobranca"
                                        value="<?php echo $res_2['tel_cobranca'];?>"></td>
                            </tr>
                            <tr>
                                <td>Observações para este(a) aluno(a)</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="3"><label for="obs"></label>
                                    <textarea name="obs" id="obs" cols="45"
                                        rows="5"> <?php echo $res_2['obs'];?></textarea></td>
                            </tr>
                            <tr>
                                <td><input class="input" type="submit" name="button" id="button" value="Finalizar"></td>
                                <td><button class="btn btn-danger" name="cancelar">Cancelar</button></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                        </table>
                        <?php }?>
                    </form>
                    <br />

                </div><!-- cadastra_estudante -->
            </div>
            <!-- box aluno -->

            <?php }// aqui fecha o bloco 2 ?>


            <?php if(@$_GET['edita'] == '3'){ ?>
            <div id="box_aluno">
                <div id="cadastra_estudante">
                    <h1>3º Passo - Mensagem de confirmação</h1>
                    <table>
                        <tr>
                            <td>
                                <h4>Este(a) Estudante foi atualizado perfeitamente no sistema!
                                    <ul>
                                        <li>Mensalmente será gerado a cobrança no valor informado!</li>
                                        <li>Este estudante já tem acesso ao sistema usando seu código e seu CPF como
                                            senha!</li>
                                    </ul>
                                    <a href="estudantes.php?pg=todos">Clique aqui para voltar para página inicial</a>
                                </h4>
                            </td>
                        </tr>
                    </table>
                    <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
                </div><!-- cadastra_estudante -->
            </div><!-- box_aluno -->

            <?php }// aqui fecha o bloco 3 ?>
            
       

            <?php require_once("rodape.php");?>
</body>


</html>     

