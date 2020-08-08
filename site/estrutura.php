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
    <a href="produtos.php">Ver Todos os internas</a>
    <form action="" enctype="multipart/form-data" method="post">
        <h1>Envio de Imagens</h1>
        <label for="nome">Nome do Produto</label>
        <input type="text" name="nome" id="nome">

        <label for="des">Descrição</label>
       <textarea name="desc" id="desc"></textarea>

        <input type="file" name="foto[]" multiple id="foto">
        <div class="row">
        <input type="submit" id="botao">
        <input type="submit" id="botao2" Value="Voltar" name="voltar">
        </div>
        <br>
        <br>
    </form>
    </section>


    <?php
        if (isset($_POST['nome'])) {
        //     $nome= addslashes($_POST['nome']);
        //     $descricao= addslashes($_POST['desc']);
        //     $fotos=array();
        //     if(isset($_FILES['foto'])){
        //         for ($i=0; $i < count($_FILES['foto']['name']) ; $i++) { 
        //             # code...
        //             $name="imagens/". md5($_FILES['foto']['name'][$i].rand(1,999)).'.jpeg';
        //             move_uploaded_file($_FILES['foto']['tmp_name'][$i],$name);
        //         }
        //     }
        // }
         
        if(isset($_FILES['foto']))
        {

            $nome= addslashes($_POST['nome']);
            $descricao= addslashes($_POST['desc']);
            $fotos=array();

            // var_dump($_FILES['foto']);
        for ($i=0;$i<count($_FILES['foto']['name']); $i++){
             // extensões permitidas
        $exts = ['png', 'gif', 'jpg', 'jpeg'];
        $ext = pathinfo($_FILES['foto']['name'][$i], PATHINFO_EXTENSION);
        echo $_FILES['foto']['type'][$i];
        $types = ['image/gif', 'image/png', 'image/jpg', 'image/jpeg'];

        if (is_uploaded_file($_FILES['foto']['tmp_name'][$i])) {

            // move_uploaded_file($_FILES['foto']['tmp_name'][$i],'imagens/');

            if (in_array($_FILES['foto']['type'][$i], $types)) {

                switch ($_FILES['foto']['type'][$i]) {
                    case 'image/jpeg':
                                    # code...
                                    $nome_foto= $_FILES['foto']['name'][$i];
                                    $name="../anexos/imagens-internas/".$nome_foto;
                                    move_uploaded_file($_FILES['foto']['tmp_name'][$i],"$name"); // line 21
                                    array_push($fotos,$nome_foto);
                                  
                                    break;
                                    case 'image/jpg':
                                        # code...
                                        $nome_foto= $_FILES['foto']['name'][$i];
                                        $name="../anexos/imagens-internas/".$nome_foto;
                                        move_uploaded_file($_FILES['foto']['tmp_name'][$i],"$name"); // line 21
                                        array_push($fotos,$nome_foto);
                                    
                                     
                                        break;
                                        case 'image/png':
                                            # code...
                                            $nome_foto= $_FILES['foto']['name'][$i];
                                            $name="../anexos/imagens-internas/".$nome_foto;
                                            move_uploaded_file($_FILES['foto']['tmp_name'][$i],"$name"); // line 21
                                            array_push($fotos,$nome_foto);
                                        
                                          
                                            break;
                                            case 'image/gif':
                                                $nome_foto= $_FILES['foto']['name'][$i];
                                                $name="../anexos/imagens-internas/".$nome_foto;
                                                move_uploaded_file($_FILES['foto']['tmp_name'][$i],"$name"); // line 21
                                                array_push($fotos,$nome_foto);                                           
                                               
                                                # code...
                                                break;
                                                
                
                }// swhitch
                
            }//if in array

        }//if is_upload 
      }//laço for
    //   echo "Processo finalizado com sucesso";
    }//if isset files
if(!empty($nome) && !empty($descricao)){
    require 'classes/Produto_class.php';
    $p= new Produto_class();
    $p-> ExecutaConexao();
    $p->enviarProduto($nome,$descricao,$fotos);
    ?>
    <script> alert('Produto cadastrado com sucesso!!');</script>
    <script>window.location='index.php'</script>
    <?php
}else{
    ?>
    <script> alert('Preecha todos os campos!!');</script>
    <?php
}
}//primeiro if 
if(@$_POST['voltar']){
    header('location: index.php');

}




            // upload 1 imagem
//         $file = $_FILES['foto'];

//         // extensões permitidas
//         $exts = ['png', 'gif', 'jpg', 'jpeg'];

//         // extensão da imagem
//         $ext = pathinfo($file['name'], PATHINFO_EXTENSION);

//         // ou verificar usando o type que é mais seguro (tipos permitidos)
//         $types = ['image/gif', 'image/png', 'image/jpg'];

//         if (is_uploaded_file($file['tmp_name'])) {

//         // ou if (in_array($file['type'], $types)) {
//         if (in_array($ext, $exts)) {

//     //move_upload...
//     switch ($file['type']) {
//         case 'image/jpeg':
//             # code...
//             $name="imagens/". md5($_FILES['foto']['name'].rand(1,999)).'.jpeg';
//             move_uploaded_file($_FILES['foto']['tmp_name'],"$name"); // line 21
        
//             echo "imagem enviada com sucesso";
//             break;
//             case 'image/jpg':
//                 # code...
//                 $name="imagens/". md5($_FILES['foto']['name'].rand(1,999)).'.jpg';
//                 move_uploaded_file($_FILES['foto']['tmp_name'],"$name"); // line 21
            
//                 echo "imagem enviada com sucesso";
//                 break;
//                 case 'image/png':
//                     # code...
//                     $name="imagens/". md5($_FILES['foto']['name'].rand(1,999)).'.png';
//                     move_uploaded_file($_FILES['foto']['tmp_name'],"$name"); // line 21
                
//                     echo "imagem enviada com sucesso";
//                     break;
//                     case 'image/gif':
//                         $name="imagens/". md5($_FILES['foto']['name'].rand(1,999)).'.gif';
//                         move_uploaded_file($_FILES['foto']['tmp_name'],"$name"); // line 21
                    
//                         echo "imagem enviada com sucesso";
//                         # code...
//                         break;
                        
//     }

//   }
//   else {
//     echo 'Somente imagem no formato GIF, PNG ou JPG!';
//   }


// }

// // if file exist
// if (!file_exists($direktori)){
//   echo "Upload Failed !!! <br>";
// }
// else{
//   move_uploaded_file($_FILES['foto']['tmp_name'],"$name"); // line 21

//     echo "imagem enviada com sucesso";
//   $input="INSERT INTO tb_gallery(gal_name,gal_size)
//           VALUES('$name','$size')";
//   mysql_query($input);
// }


    ?>
</body>
</html>