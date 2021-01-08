
<h1>Lista de <?=@$_GET['tipo']?></h1>
<table class="table table-sm">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
      <th>Ações</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
      <td>Fechar</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
      <td>fechar</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td colspan="2">Larry the Bird</td>
      <td>@twitter</td>
      <td>fechar</td>
    </tr>
  </tbody>
</table>
<br>
<hr>
<h1>Cadastro de Fornecedor</h1>
<form>
  <div class="form-row">
    <div class="col-sm-6">
      <input type="text" class="form-control" placeholder="Nome">
    </div>
    <div class="col-sm-6">
      <input type="text" class="form-control" placeholder="CNPJ">
    </div>
  </div>
  <br>
  <div class="form-row">
    <div class="col-sm-4">
      <input type="text" class="form-control" placeholder="Telefone">
    </div>
    <div class="col-sm-8">
      <input type="text" class="form-control" placeholder="endereço">
    </div>
  </div>
  <br>
  <div class="form-row">
    <div class="col-sm-3">
      <input type="text" class="form-control" placeholder="Cidade">
    </div>
    <div class="col-sm-3">
      <input type="text" class="form-control" placeholder="Estado">
    </div>
    <div class="col-sm-6">
      <input type="text" class="form-control" placeholder="email">
    </div>
  </div>

  <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Cadastrar</button>
      </div>
</form>