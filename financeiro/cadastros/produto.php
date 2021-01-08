<h1>Grid de <?=@$_GET['tipo']?></h1>
<div class="container">
    <div class="row ">
        <div class="col-sm-3">
            <div class="card" style="width: 15rem; heigth:8rem;">
                <img src="_imagens/carnes.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card</h5>
                    <p class="card-text">Text</p>
                   
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card" style="width: 15rem; heigth:8rem;">
                <img src="_imagens/carnes.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card</h5>
                    <p class="card-text">Text</p>
                   
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card" style="width: 15rem; heigth:8rem;">
                <img src="_imagens/carnes.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card</h5>
                    <p class="card-text">Text</p>
                   
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card" style="width: 15rem; heigth:8rem;">
                <img src="_imagens/carnes.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card</h5>
                    <p class="card-text">Text</p>
                   
                </div>
            </div>
        </div>
        
        
        
    </div>
</div>
<br>
<hr>
<h1>Cadastro de <?=@$_GET['tipo']?></h1>
<form>
    <div class="form-row">
        <div class="col-sm-6">
            <input type="text" class="form-control" placeholder="Produto">
        </div>
        <div class="col-sm-6">
            <input type="text" class="form-control" placeholder="Descrição">
        </div>
    </div>
    <br>
    <div class="form-row">
        <div class="col-sm-6">
            <input type="text" class="form-control" placeholder="valor">
        </div>
        <div class="col-sm-6">
            <select id="inputState" class="form-control">
                <option selected>Choose...</option>
                <option>...</option>
            </select>
        </div>
    </div>
    <br>
    <div class="form-row">
        <div class="col-sm-6">
            <input type="text" class="form-control" placeholder="quantidade">
        </div>
        <div class="col-sm-6">
            <input type="file" class="form-control" placeholder="imagem">
        </div>

    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Cadastrar</button>
    </div>
</form>