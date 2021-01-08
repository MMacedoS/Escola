<?php require_once "../Control/conexao.php"; ?>
<form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
    <div class="input-group">
        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
            <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
        </div>
    </div>
</form>
<div class="table-responsive-sm">
<table class="table ml-3">
    <thead>
        <tr>
            <th scope="col">Contrato</th>
            <th scope="col">Aluno</th>
            <th scope="col">Resposáveis</th>
            <th scope="col">Data de renovação</th>
            <th scope="col">Visualizar</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $buscaContrato=$pdo->query("select c.nome_um,c.nome_dois,c.created_at,c.contrato_id, e.nome  from contrato c inner join estudantes e on c.id_estudantes=e.id_estudantes ");
        $buscaContrato=$buscaContrato->fetchAll(PDO::FETCH_ASSOC);
           foreach($buscaContrato as $key=>$r_aluno){

            echo ' <tr>
                <th scope="row">'.$r_aluno['contrato_id'].'</th>
                <td>'.$r_aluno['nome'].'</td>
                <td>'.$r_aluno['nome_um']."/".$r_aluno['nome_dois'].'</td>
                <td>'.$r_aluno['created_at'].'</td>
                <td><a target="_blank" href="../Contrato/contrato_assinado.php?id_contrato='.$r_aluno['contrato_id'].'"> <i class="fas fa-record-vinyl"></i></a></td>
             </tr>';
           }
        ?>
    </tbody>
</table>
        </div>