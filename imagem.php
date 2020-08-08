<?php require_once "Control/conexao.php";
require 'site/classes/produto_class.php';
$p= new Produto_class();
$p-> ExecutaConexao();
if(@$_GET['id']){
$id=$_GET['id'];
$pasta="imagens-internas";
// if(isset($_GET['id'])&& !empty($_GET['id'])){
//   $id=addslashes($_GET['id']);

// }else{
//     // header('location: produtos.php');
// }

$dadosProduto=$p->buscarProdutosPorId($id);
$dadosImagem=$p->buscarImagensPorId($id);

}else{
    header('location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
	<link href="css/login.css" rel="stylesheet" id="bootstrap-css">
    <style>
    section {
    display: block;
    margin: 30px !important;
}
img {
    vertical-align: middle;
    border-style: none;
    width: 100% !important;
}
    </style>
</head>

<body>
                    <button class="btn btn-danger" id="voltar">VOLTAR</button>
                    <button class="btn btn-danger" id="pausar">FINALIZAR PROCESSAMENTO</button>
<p class="text-center">Visualizar imagens (clique na imagem finalizar o processamento)</p>
<section>
   
<div class="carousel slide">
<div class="slide_title carousel">
                                    <div class="slide_nav_title">
                                        <div class="slide_nav_item_title b  carousel-control-prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span></div>
                                        <div class="slide_nav_item_title g carousel-control-next"> <span class="carousel-control-next-icon" aria-hidden="true"></span></div>
                                    </div>
                                    <?php 
            // foreach ($dadosImagem as $value) {
            //     # code...
            // var_dump($dadosImagem);
           
            for($c=0;$c<count($dadosImagem);$c++){
                // echo "este é a imagem ".$dadosImagem[$c]['nome_imagem'];    
                $slide_title=str_pad($c,2,0,STR_PAD_LEFT);
                $first_title=($c==1?' fis' : '');

        ?>
        <article class="slide_item_title <?= $first_title;?>">
                <?php 
                // foreach($dadosImagem as $value){
                    ?>
                <img  id="image" src="anexos/<?= $pasta?>/<?= $dadosImagem[$c]['nome_imagem'];?>" alt="">
                <!-- <div class="slide_item_desc">
                    <h1>es=< $slide." ";?>opa</h1>
                    <p>sçdlasçdlçasldasçdlçsadlsaçdlsçad</p>
                </div> -->
                
        </article>
            <?php  }?>
            
        
        <!-- <div id="imagens">
            <div class="caixa-img"><img id="image" src="anexos/outdoor/<?php echo $value['nome_imagem']?>" alt=""></div>
        </div> -->
        <?php 
        //}?>

        
                                
            </div>
            </div>
</section>
           
</body>
</html>

 <!-- fim galeria -->
 <script src="//code.jquery.com/jquery-2.1.3.min.js"></script>
    <!-- Bootstrap core JS-->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
    <!-- Third party plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    
   <script>
   $(function() {
    
    var slideAutoTitle = setInterval(slideGoTitle, 1);
       // slide title
    $('.slide_nav_item_title.g').click(function() {
        slideGoTitle();
        clearInterval(slideAutoTitle);
    });
    $('.slide_nav_item_title.b').click(function() {
        slideBackTitle();
        clearInterval(slideAutoTitle);
    });
    $('.slide_title.carousel').click(function() {
       clearInterval(slideAutoTitle);
    });
    $('#pausar').click(function() {
       clearInterval(slideAutoTitle);
    });
    $('#pausar').dblclick(function() {
       var slideAutoTitle = setInterval(slideGoTitle, 1000);
    });
    $('#voltar').click(function() {
       window.location='index.php';
    });


});

function slideGoTitle() {
    if ($('.slide_item_title.fis').next().length) {
        $('.slide_item_title.fis').fadeOut(400, function() {
            $(this).removeClass('fis').next().fadeIn().addClass('fis');
            
        });
    } else {
            $('.slide_item_title.fis').fadeOut(400, function() {
            $('.slide_item_title').removeClass('fis');
            $('.slide_item_title:eq(0)').fadeIn().addClass('fis');
           
        });
       
    }
}


function slideBackTitle() {
    if ($('.slide_item_title.fis').index() > 1) {
        $('.slide_item_title.fis').fadeOut(400, function() {
            $(this).removeClass('fis').prev().fadeIn().addClass('fis');
        });
    } else {
        $('.slide_item_title.fis').fadeOut(400, function() {
            $('.slide_item_title').removeClass('fis');
            $('.slide_item_title:last-of-type').fadeIn().addClass('fis');
        });
    }

}
   </script>