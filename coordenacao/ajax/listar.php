<?php
require_once  '../../Control/conexao.php';
    $acao=@$_GET['botao'];
    $var=@$_GET['categoria'];
       
    $consulta=$pdo->prepare('SELECT * from valor_ativ where categoria=:categoria');
    $consulta->bindValue(':categoria',$var);
    $consulta->execute();
    $dados=$consulta->fetchAll();
    $qtde_dados=count($dados);   
    if($qtde_dados==0){
        // echo "<p>nenhum resultado encontrado!!</p>";
        echo '
        
        <form action="" name="button" method="post">
         
            <table id="customers">
                <tr>
                <th>1ª Atv:</th>
                <th>2ª Atv:</th>
                <th>3ª Atv:</th>
                <th>4ª Atv:</th>  
                </tr>
                <tr>
                <td><input type="text" class="form-control" name="primeira" id="primeira" value="'.@$dados[0]['primeira'].'"></td>
                <td><input type="text" name="segunda" class="form-control" id="segunda" value="'.@$dados[0]['segunda'].'"></td>
                <td><input type="text" name="terca" id="terceira" class="form-control" value="'.@$dados[0]['terceira'].'"></td>
                <td><input type="text" class="form-control"  name="quarta" id="quarta" value="'.@$dados[0]['quarta'].'"></td>
                
                <input type="hidden" name="categoria" id="categoria" value="'.@$var.'">
                        
                </tr>
            </table>

    
                 <input type="submit" class="btn btn-primary" name="botao" id="inserir" value="Inserir">
        </form>';
    }else{
        echo '<form action="" name="button" method="post">
         
                <table id="customers">
                    <tr>
                    <th>1ª Atv:</th>
                    <th>2ª Atv:</th>
                    <th>3ª Atv:</th>
                    <th>4ª Atv:</th>   
                    <th>Total</th>       
                    </tr>
                    <tr>
                    <td><input class="form-control"  type="text" name="primeira" id="primeira" value="'.@$dados[0]['primeira'].'"></td>
                    <td><input class="form-control"  type="text" name="segunda" id="segunda" value="'.@$dados[0]['segunda'].'"</td>
                    <td><input class="form-control"  type="text" name="terca" id="terceira" value="'.@$dados[0]['terceira'].'"</td>
                    <td><input class="form-control"  type="text" name="quarta" id="quarta" value="'.@$dados[0]['quarta'].'"</td>
                    
                    <td><input type="text" class="form-control"  name="quarta" id="quarta" disabled value="'.$soma=@$dados[0]['primeira']+@$dados[0]['segunda']+@$dados[0]['terceira']+@$dados[0]['quarta'].'"></td>
                    <input type="hidden" name="categoria" id="categoria" value="'.@$var.'">     
                    </tr>
                </table>

                
                       <input type="submit" class="btn btn-primary" name="botao" id="alterar" value="Alterar">
            </form>';

    }

    // var_dump($acao);

            // echo "<p>Selecione uma categoria para fazer a busca!!</p>";
      
?>
<script>
    $('#inserir').click(function(event){
        event.preventDefault();
        // window.alert('funcionou');
        var acao=$('#inserir').val();
        var u_primeira=$('#primeira').val();
        var u_segunda=$('#segunda').val();
        var u_terceira=$('#terceira').val();
        var u_quarta=$('#quarta').val();
        var u_categoria=$('#categoria').val();
        // window.alert(acao);
        $.ajax({
            url:"ajax/inserir.php",
            method: 'POST',
            data: {acao:acao,primeira:u_primeira,segunda:u_segunda,terceira:u_terceira,quarta:u_quarta,categoria:u_categoria},
            datatype:'json',
            success:function(result){
                $('#botao').click();
                $('#mensagem').text(result)
            },
              })
    })
</script>

<script>
    $('#alterar').click(function(event){
        event.preventDefault();
        // window.alert('funcionou');
        var acao=$('#alterar').val();
        var u_primeira=$('#primeira').val();
        var u_segunda=$('#segunda').val();
        var u_terceira=$('#terceira').val();
        var u_quarta=$('#quarta').val();
        var u_categoria=$('#categoria').val();
        // window.alert(acao);
        $.ajax({
            url:"ajax/inserir.php",
            method: 'POST',
            data: {acao:acao,primeira:u_primeira,segunda:u_segunda,terceira:u_terceira,quarta:u_quarta,categoria:u_categoria},
            datatype:'json',
            success:function(result){
                $('#botao').click(); 
                $('#mensagem').text(result)
            },
              })
    })
</script>