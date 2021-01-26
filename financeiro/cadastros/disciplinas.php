<?php
  require_once "./bd/funcoes.php";
  $select=new funcoes;
  $dis=$select->buscaQtdDis();
 $qtde=count($dis);
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
        <input class="form-control mr-sm-2 " type="search" placeholder="pesquisar" id="pesquisa"  aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" onclick="busca2(event);">buscar</button>
    </form>

    <div class="table-responsive">
    <table class="table table-sm mr-4" id="lista">

        
    </table>
    </div>
   
    <nav aria-label="Page navigation example">
   
    <ul class="pagination" style="{}">
         
        <?php for($i=0;$i<=count($dis);$i=$i+25){?>
        <li class="page-item"><a class="page-link" onclick="busca(<?=$i?>);"><?=$i/25?></a></li>
        <?php }?>
        </ul>
     
    </nav>
</div>
<br>
<hr>


<!--  -->

<!-- editar -->
<div class="modal fade" id="disciplina" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cadastro de Disciplinas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST">
            <div class="modal-body" id="editarDisciplina">                               
                   
                       
                  
           
            </form>
        </div>
    </div>
</div>
<!-- editar -->


<script>
  $(document).ready(function(){
    $.post('./funcoes/listarDisciplinas.php',function(retorna){
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
      $.post('./funcoes/cadDisciplinas.php', dados,function(retorna){
        $('#editarDisciplina').html(retorna);
        $('#disciplina').modal('show');
      });
      }
    });
  });

  $(document).ready(function(){
    $(document).on('change','#categoria',function(){
    var user_id=$(this).val();
      if(user_id!==''){
        var dados={
        categoria:user_id
      };
      $.post('./funcoes/listarNomeDisc.php', dados,function(retorna){
        $('#disciplinas').html(retorna);
     
      });
      $.post('./funcoes/listarNomeCat.php', dados,function(retorna){
        $('#turmas').html(retorna);
     
      });
      }
    });
  });

  

  $('#novo').click(function(){
    $.post('./funcoes/cadDisciplinas.php',function(retorna){
        $('#editarDisciplina').html(retorna);
        $('#disciplina').modal('show');
      });
  });


function busca(busca){
  var dados={
        page:busca
      };
  $.post('./funcoes/listarDisciplinas.php',dados,function(retorna){
        $('#lista').html(retorna);
      });
}
function busca2(event){
  event.preventDefault();
   var busca=$('#pesquisa').val();
  var dados={
        texto:busca
      };
  $.post('./funcoes/listarDisciplinas.php',dados,function(retorna){
        $('#lista').html(retorna);
      });
}

</script>

