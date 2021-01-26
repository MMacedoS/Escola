<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de Imagens</title>

    <style>
    body {
    font-family: Arial, Helvetica, sans-serif;
}

section {
    background-color: rgb(123, 104, 238, .4);
    width: 70%;
    margin: auto;
}

input,
label,
textarea {
    display: block;
    width: 100%;
    height: 30px;
}

label {
    line-height: 30px;
    margin-top: 10px;
}

textarea {
    height: 150px;
}

form {
    width: 60%;
    margin: auto;
    box-sizing: border-box;
    padding: 20px;
}

#botao {
    margin-bottom: 10px;
    width: 40%;
    background-color: rgba(11, 91, 200, 0.8);
    color: white;
    height: 40px;
    float: left;
    cursor: pointer;
    border: none;
    margin-right:5px;
    font-size: 15px;}
#botao2 {
    margin-bottom: 10px;
    width: 40%;
    margin-right:5px;
    background-color: rgba(0, 0, 0, .8);
    color: white;
    height: 40px;
    float:right;
    cursor: pointer;
    border: none;
    font-size: 15px;
}

h1 {
    text-align: center;
}

#foto {
    margin-top: 20px;
    margin-bottom: 20px;
}

a {
    background-color: rgb(0, 255, 127);
    display: block;
    width: 220px;
    height: 50px;
    color: black;
    text-decoration: none;
    float: right;
    text-align: center;
    line-height: 50px;
    margin: 20px;
    border: 1px solid rgba(0, 0, 0, .2);
}
    </style>
</head>
<body>
    <section>
    <a href="listaVideos.php">Ver Todos os Outdoors</a>
    <form action="" enctype="multipart/form-data" method="post">
        <h1>Envio de Outdoors</h1>
        <label for="nome">Local</label>
         <select name="name" id="">
            <option value="">Notícias</option>
            <option value="outdoor">Outdoor</option>
         </select>

        <!-- <label for="nome">Link</label>
        <input type="text" name="link" id="link">

        <label for="nome">Titulo</label>
        <input type="text" name="titulo" id="titulo">

        <label for="des">Descrição</label>
       <textarea name="desc" id="desc"></textarea> --> 

        <input type="file" name="foto"  id="foto">
        <div class="row">
        <input type="submit" id="botao">
        <input type="submit" id="botao2" Value="Voltar" name="voltar">
        </div>
        <br>
        <br>
    </form>
    </section>


    <?php
       
        //     
       
         
        if(isset($_FILES['foto']))
        {

            $fotos=array();

           
        $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
      

        if (is_uploaded_file($_FILES['foto']['tmp_name'])) {

           
                                    # code...
                                    if($_POST['name']==''){
                                        $nome_foto= md5($_FILES['foto']['name'].rand(1,999)).'.mp4';
                                        $name="../anexos/videos/".$nome_foto;
                                    }else{
                                        $nome_foto= $_POST['name'];
                                        $name="../anexos/videos/".$nome_foto.'.mp4';
                                    }
                                   
                                   
                                    move_uploaded_file($_FILES['foto']['tmp_name'],"$name"); // line 21
                                    
        }//if is_upload 
      
    //   echo "Processo finalizado com sucesso";
    }//if isset files

if(@$nome_foto!=''){

    require 'classes/Produto_class.php';
    $p= new Produto_class();
    $p-> ExecutaConexao();
    $p->enviarVideo($nome_foto);
    ?>
    <script> alert('Video cadastrado com sucesso!!');</script>
    <script>window.location='videos.php'</script>
    <?php
}

if(@$_POST['voltar']){
    header('location: index.php');

}


    ?>
</body>
</html>