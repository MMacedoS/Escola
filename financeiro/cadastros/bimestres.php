<?php

require_once "./bd/funcoes.php";
  $select=new funcoes;
$bimestre=$select->buscarBimestre();

?>
<style>
.table-sm td, .table-sm th {
    padding: .3rem;
    text-align: center;
    font-size: 25px;
}
.mystyle:before{
content:"Atividades Cadastradas";
    background: green;
    color: white;
    margin-left: 2%;

}
</style>
<div class="container">
    <div class="form-group">
        <div class="row">
            <div class="col-sm-4">
                <button class="btn btn-primary mt-2" id="novo">Adicionar</button>
            </div>
            <div class="col-sm-4">
                <button class="btn btn-primary mt-2" id="atividade" data-toggle="modal" data-target="#exampleModalLong">Criar Atividades</button>
            </div>
        </div>
    </div>
</div>
<div class="container"  style="{heigth:400px}">


    <form class="form-inline">
        <h1 class="mr-4">Lista de <?=@$_GET['tipo']?></h1>
        <input class="form-control mr-sm-2 " type="search" placeholder="pesquisar" id="pesquisa"  aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" onclick="busca2(event);">buscar</button>
    </form>


    <table class="table table-sm mr-4" id="lista">

        
    </table>
   
    <nav aria-label="Page navigation example">
   
    <ul class="pagination">
        
        <?php foreach($bimestre as $key=>$value){?>
        <li class="page-item"><a class="page-link" onclick="busca('<?=$value['unidade']?>')"><?=$value['unidade']?></a></li>
        <?php }?>
        </ul>
     
    </nav>

</div>
<br>
<hr>


<!--  -->

<!-- editar -->
<div class="modal fade" id="editaBimestre" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cadastro de <?=@$_GET['tipo']?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST">
            <div id="myDIV"></div>
            <div class="modal-body" id="bimestre">                               
                   
                       
                            
            </form>
        </div>
    </div>
</div>
<!-- editar -->



<script>
  $(document).ready(function(){
    $.post('./funcoes/listarBimestre.php',function(retorna){
      $('#lista').html(retorna);
    });
  });

window.turmas="";
  $(document).ready(function(){
    $(document).on('click','.view_data',function(){
    var user_id=$(this).attr("id");
      if(user_id!==''){
        var dados={
        user_id:user_id
      };
      $.post('./funcoes/cadBimestre.php', dados,function(retorna){
        $('#bimestre').html(retorna);
        $('#editaBimestre').modal('show');
      });
      }
    });
  });

  $('#novo').click(function(){
    $.post('./funcoes/cadBimestre.php',function(retorna){
        $('#bimestre').html(retorna);
        console.log(retorna);
        $('#editaBimestre').modal('show');
      });
  });
  $('#atividade').click(function(){
    $.post('./funcoes/cadAtividade.php',function(retorna){
        $('#bimestre').html(retorna);
        // console.log(retorna);
        $('#editaBimestre').modal('show');
      });
    
    
  });

  function verif(){
    var element = document.getElementById("myDIV");
    element.classList.add("mystyle");    
  }

function busca(busca){
  var dados={
        page:busca
      };
  $.post('./funcoes/listarBimestre.php',dados,function(retorna){
        $('#lista').html(retorna);
      });
}
function busca2(event){
  event.preventDefault();
   var busca=$('#pesquisa').val();
  var dados={
        texto:busca
      };
  $.post('./funcoes/listarBimestre.php',dados,function(retorna){
        $('#lista').html(retorna);
      });
}

</script>

