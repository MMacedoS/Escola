
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistema Escolar</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
    <link rel="shortcut icon" href="image/logo_ist.gif">
    <?php require_once "Control/conexao.php"?>
</head>
<body>
<div id="logo">
 <img id="img" src="image/logo_ist.gif">   
</div>
<div id="caixa_login">
    <?php  if (isset($_POST['button'])) {
        # code...
        $nome=$_POST['nome'];
         $password=preg_replace('/[^[:alnum:]_]/', '',$_POST['password']);
        if ($nome=="") {
            # code...
            echo "<h2>email de acesso invalido!</h2>";
        } else if ($password==""){
            # code...
            echo "<h2>Por favor , digite a senha!</h2>";

        }else {
            # code...
            $sql= "select * from login where nome= '$nome'
            and senha='$password'";

            $resultado=mysqli_query($conexao, $sql);
            if (mysqli_num_rows($resultado)>0) {

                # code...

                while($res_1=mysqli_fetch_assoc($resultado)){
                    $status = $res_1['status'];
                    $code =$res_1['code'];
                    $senha =$res_1['senha'];
                    $nome =$res_1['nome'];
                    $painel =$res_1['painel'];

                    if ($status == 'inativo'){
                    echo "<h2> Você está inativo, procure a administração!! </h2>";

                        }else{
                            
                                # code...
                                session_start();
                                $_SESSION['code']=$code;
                                $_SESSION['nome']=$nome;
                                $_SESSION['painel']=$painel;
                
                                if($painel=='admin'){
                                    echo "<script language='javascript'> window.location='admin'; </script>";
                                } else if($painel=='Aluno'){
                                    echo "<script language='javascript'> window.location='aluno'; </script>";
                
                                }else if($painel=='professor'){
                                    echo "<script language='javascript'> window.location='professor'; </script>";
                
                                }
                                else if($painel=='secretaria'){
                                    echo "<script language='javascript'> window.location='secretaria'; </script>";
                
                                }
                                else if($painel=='tesouraria'){
                                    echo "<script language='javascript'> window.location='tesouraria'; </script>";
                
                                }
                
                            
                        }

                }
               
            }else{
            ?>
                <script>
                    alert('Usuario ou senha errada');
                </script>
            <?php
            } 
            
        }

        
    } 
    
    ?>
    <form name="form" action="" method="post">
        <table>
        <tr>
        <td> <h1>Nº Cartão ou Código de Acesso</h1>
        </td>
        </tr>
        <tr>
        <td><input type="email" name="nome"></td>
        </tr>
        <tr>
        <td> <h1>Senha</h1>
        </td>
        </tr>
        <tr>
        <td><input type="password" name="password"></td>
        </tr>
        <tr>
        <td><input class="input"type="submit" name="button" value="Entrar"><p align="right"><a href="recuperar_senha.php">Esqueceu a senha? Recupere já!</a></p></td>
        
        </tr>
        </table>
    </form>
</div>
</body>
</html>