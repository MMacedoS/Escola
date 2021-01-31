<?php
  require_once "./bd/funcoes.php";
  $select=new funcoes;
  $estudant=$select->buscaQtdeEst();
 $qtde=count($estudant);
?>
<div class="container">
    <div class="form-group">
        <div class="row">
            <div class="col-sm-12">
                <button class="btn btn-primary mt-2" id="novo">Adicionar</button>
            </div>
        </div>
    </div>
</div>
<div class="container"  style="{heigth:400px}">


    <form class="form-inline">
        <h1 class="mr-4">Lista de <?=@$_GET['tipo']?></h1>
        <input class="form-control mr-sm-2 " type="search" onkeyup="busca2(event);"; placeholder="pesquisar" id="pesquisa"  aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0"  onclick="busca2(event);">buscar</button>
    </form>

    <div class="table-responsive">
    <table class="table table-sm mr-4" id="lista">

        
    </table>
    </div>
   
    <nav aria-label="Page navigation example">
   
    <ul class="pagination" style="{}">
         
        <?php for($i=0;$i<=count($estudant);$i=$i+30){?>
        <li class="page-item"><a class="page-link" onclick="busca(<?=$i?>);"><?=$i/30?></a></li>
        <?php }?>
        </ul>
     
    </nav>
</div>
<br>
<hr>


<!--  -->

<!-- editar -->
<div class="modal fade" id="professor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cadastro de Estudantes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST">
            <div class="modal-body" id="editarProfessor">                               
                   
                       
                  
           
            </form>
        </div>
    </div>
</div>
<!-- editar -->


<script>
 

$(document).ready(function(){
  $.post('./funcoes/listarEstudantes.php',function(retorna){
      $('#lista').html(retorna);
     });
  });

  $(document).ready(function(){
    $(document).on('click','.view_data',function(){
    var user_id=$(this).attr("id");
      if(user_id!==''){
        var dados={
        user_id:user_id
      };
      $.post('./funcoes/cadEstudantes.php', dados,function(retorna){
        $('#editarProfessor').html(retorna);
        $('#professor').modal('show');
      });
      }
    });

    $(document).on('click','.view_ativo',function(){
    var user_id=$(this).attr("id");
      if(user_id!==''){
        var dados={
        user_id:user_id
      };
      $.post('./funcoes/cadEstudantes.php', dados,function(retorna){
        $('#editarProfessor').html(retorna);
        $('#professor').modal('show');
      });
      }
    });
  });

  $('#novo').click(function(){
    $.post('./funcoes/cadEstudantes.php',function(retorna){
        $('#editarProfessor').html(retorna);
        $('#professor').modal('show');
      });
  });


function busca2(event){
  event.preventDefault();
  
   var busca=$('#pesquisa').val();
   if(busca!=''){
  var dados={
        texto:busca
      };
  $.post('./funcoes/listarEstudantes.php',dados,function(retorna){
        $('#lista').html(retorna);
      });
    }else{
      $.post('./funcoes/listarEstudantes.php',function(retorna){
      $('#lista').html(retorna);
     });
    }
}

</script>

