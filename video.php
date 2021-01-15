<?php 
require_once 'site/classes/Produto_class.php';
$p= new produto_class();
$p-> ExecutaConexao();

$videos=$p->buscaVideos();
$qtdeVideo=count($videos);

if(isset($_POST['busca'])){
    echo' <video style="width:100%;" controls>
                <source src="anexos/videos/'.$_POST['busca'].'" type="video/mp4">
                Your browser does not support HTML video.
                </video>';

}else{
    
echo' <video style="width:100%;" controls>
                <source src="anexos/videos/'.$videos[0]['name'].'" type="video/mp4">
                Your browser does not support HTML video.
                </video>';

}