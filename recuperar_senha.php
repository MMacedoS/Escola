<!DOCTYPE html>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistema Escolar</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
    <link rel="shortcut icon" href="image/logo_ist.gif">
    <?php require_once "functions.php"?>
</head>
<body>
<div id="logo">
 <img src="image/logo_ist.gif">   
</div>
<div id="caixa_login">
    
      <form name="form" action="" method="post">
        <table>
        <tr>
        <td> <h1>Insira o email cadastrado para recuperar senha!!</h1>
        </td>
        </tr>
        <tr>
        <td><input type="email" name="email" class="form-control" required></td>
        </tr>
        <tr>
            <td>Selecione o tipo do usuário:<select  name="painel" class="form-control">
            
                <option  value="Aluno">Aluno</option>
                <option value="professor">Professor</option>
                <option value="secretaria">Secretaria</option>
                <option value="coordenacao">Coordenação</option>
                <option value="Financeiro">Financeiro</option>
            </select></td>
        
        </tr>
        <tr>
        <input type="hidden" name="env" value="form">
        <td><Center><input class="input"type="submit" name="button" value="Enviar   "></Center><p align="right"><a href="index.php">retornar ao login!</a></p></td>
        
        </tr>
        </table>
    </form>
</div>
<?php echo verifica_dados($conexao);?>
</body>
</html>