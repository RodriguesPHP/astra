@include('layout.header')
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row align-items-center mb-2">
                    <div class="col">
                        <h2 class="h5 page-title">Meus APPs</h2>
                    </div>
                    <div class="mr-3 float-right">
                        <button type="button" class="btn mb-2 btn-primary" data-toggle="modal" data-target="#store_app"> Criar APP </button>
                    </div>
                </div>
                <div class="mb-2 align-items-center">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="row my-4">
                                @foreach($apps as $app)
                                    <div class="col-md-4">
                                        <div class="card mb-4">
                                            <div class="card-body my-n3">
                                                <div class="row align-items-center">
                                                    <div class="col-3 text-center">
                                                  <span class="circle circle-lg bg-light">
                                                    <i class="fe fe-hard-drive fe-24 text-primary"></i>
                                                  </span>
                                                    </div> <!-- .col -->
                                                    <div class="col">
                                                        <div class="row-12 float-right">
                                                            <button class="btn btn-sm text-danger"><span class="fe fe-16 fe-trash-2"></span></button>
                                                        </div>
                                                        <ul>
                                                            <li><a href="#">
                                                                    <h2 class="h5 mt-4 mb-1">{{$app->banco_id}}</h2>
                                                                </a></li>
                                                            <li><strong>Produto: </strong> {{$app->produto}}</li>
                                                            <li><strong>Usuario: </strong> {{$app->usuario}}</li>
                                                            <li><strong>Senha: </strong> *********</li>
                                                            <li><strong>Criado: </strong> {{$app->created_at->format('d/m/Y H:i:s')}}</li>


                                                        </ul>

                                                    </div> <!-- .col -->

                                                </div> <!-- .row -->
                                            </div> <!-- .card-body -->
                                            <div class="card-footer">
                                                <a href="" class="d-flex justify-content-between text-muted"><span>Configuração do APP</span><i class="fe fe-chevron-right"></i></a>
                                            </div> <!-- .card-footer -->
                                        </div> <!-- .card -->
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="store_app" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="defaultModalLabel">Criar APP</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="#" method="post">
                    @csrf
                <div class="modal-body">
                    <div>
                        <div class="row">
                            <div class="col-12">
                                <label for="nome">Nome</label>
                                <input type="text" name="nome" id="nome" class="form-control" required>
                            </div>

                            <div class="col-6 mt-2">
                                <label for="banco">Selecione o banco</label>
                                <select name="banco" id="banco" class="form-control" required>
                                    <option value="">Selecione...</option>
                                    @foreach($bancos as $banco)
                                        <option value="{{$banco->id}}">{{$banco->nome}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6 mt-2">
                                <label for="produto">Selecione o produto</label>
                                <select name="produto" id="produto" class="form-control" required>
                                    <option value="">Selecione...</option>
                                    @foreach($produtos as $produto)
                                        <option value="{{$produto->prefix}}">{{$produto->nome}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div id="form_app">
                        <div class="row mt-2">
                            <div class="col-6 mt-2">
                                <label for="usuario">Usuario</label>
                                <input type="text" name="usuario" id="usuario" class="form-control" required>

                            </div>
                            <div class="col-6 mt-2">
                                <label for="senha">Senha</label>
                                <input type="text" name="senha" id="senha" class="form-control" required>
                            </div>
                            <div class="col-12 mt-2">
                                <label for="apikey">API Key</label>
                                <input type="text" name="apikey" id="apikey" class="form-control">
                            </div>
                            <div class="col-12 mt-2">
                                <label for="apikey">Secret Key</label>
                                <input type="text" name="secretkey" id="secretkey" class="form-control">
                            </div>
                            <div class="col-6 mt-2">
                                <label for="usuario_digitador">Usuario Digitador</label>
                                <input type="text" name="usuario_digitador" id="usuario_digitador" class="form-control">

                            </div>
                            <div class="col-6 mt-2">
                                <label for="cpf_digitador">CPF Digitador</label>
                                <input type="text" name="cpf_digitador" id="cpf_digitador" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn mb-2 btn-primary">Criar APP</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</main>
@include('layout.footer')
