    
<?php require_once "../Control/conexao.php"; 
$select=$pdo->query("SELECT id_categoria,categoria FROM categoria");
$select=$select->fetchAll(PDO::FETCH_ASSOC);
?>
    <div class="container">
        <h2>Formulario de Envio</h2>
        
        <form action="" method="post">
        
            <div class="form-group">
                <fieldset>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Categoria para envio</label>
                                <select name="destinatario" id="" class="form-control">
                                <?php foreach($select as $key=>$value){?>
                                    <option value="<?=$value['id_categoria']?>"><?=$value['categoria']?></option>
                                <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Assunto</label>
                                <input type="text" class="form-control" name="assunto" required>
                            </div>

                        </div>
                    </div>
                
                </fieldset>
                <fieldset>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <textarea type="text" rows="4" cols="50" class="form-control" name="mensagem" required ></textarea>
                        </div>
                    </div>
                </div>
                </fieldset>
                <fieldset>
                    <div class="footer mt-2 float-right">
                        <div class="row">
                            <button class="btn btn-success mr-2" name="envio" type="submit">Enviar</button>
                            <button  class="btn btn-danger mr-2" type="submit">Cancelar</button>
                        </div>
                    </div>
                </fieldset>
            </div>
            </form>
        
    </div>


<?php
if(isset($_POST['envio'])){
$destinatario=@$_POST['destinatario'];
$assunto=@$_POST['assunto'];
$mensagem=@$_POST['mensagem'];

$emails=$pdo->query("SELECT email from estudantes e inner join cursos_estudantes ce on e.id_estudantes=ce.id_estudantes inner join
cursos c on ce.id_cursos=c.id_cursos inner join categoria cat on cat.id_categoria=c.id_categoria where cat.id_categoria='$destinatario' LIMIT 1");
$emails=$emails->fetchAll(PDO::FETCH_ASSOC);
$count=0;
foreach($emails as $key=>$email)
{
	//AQUI VAI O CÓDIGO DE ENVIO DO EMAIL
	$to = $email['email'];
	$subject = $assunto;

	$message = $mensagem."<br><br> <p>Att: Escola Ist</>";

	$remetente = $email_adm;
	$headers = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8;' . "\r\n";
	$headers .= "From: " .$remetente;
    mail($to, $subject, $message, $headers);
    $count++;
    // echo "<script>console.log('".$email['email']."');</script>";

}
echo "
<script>
window.alert('".$count." emails enviados!!');
</script>
";
   
}
?>
<script src="">
window.alert('envio de email ok');
</script>