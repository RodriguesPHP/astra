@include('layout.header')
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <div class="row align-items-center mb-2">
                    <div class="row col-12">
                        <div class="col-6">
                            <h2 class="h5 page-title mt-2">Bancos </h2>
                        </div>
                        <div class="col-6">
                            <div class="float-right">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#bancos">Adicionar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-2 align-items-center">
                    <div class="card mb-4">
                        <div class="card-body">
                            <table class="table table-hover text-center">
                                <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Prefix</th>
                                    <th>Nome</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($bancos as $banco)
                                    <tr>
                                        <td>{{$banco->id}}</td>
                                        <td>{{$banco->prefix}}</td>
                                        <td>{{$banco->nome}}</td>
                                        <td>
                                            <div class="dropdown show">
                                                <button class="btn btn-sm dropdown-toggle" type="button" id="dr1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    <span class="text-muted sr-only">Action</span>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dr1" style="position: absolute; transform: translate3d(-130px, 30px, 0px); top: 0px; left: 0px; will-change: transform;" x-placement="bottom-end">
                                                    <a class="dropdown-item" href="#">Editar</a>
                                                    <a class="dropdown-item" href="#">Deletar</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="bancos" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="defaultModalLabel">Adicionar Bancos</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form action="{{route('store.banco')}}" method="POST">
                            @csrf
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label for="simpleinput">Prefix (URL)</label>
                                <input type="text" id="prefix" name="prefix" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="simpleinput">Nome</label>
                                <input type="text" id="nome" name="nome" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn mb-2 btn-primary">Salvar banco</button>
                        </div>
                        </form>

                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="row align-items-center mb-2">
                    <div class="row col-12">
                        <div class="col-6">
                            <h2 class="h5 page-title mt-2">Produtos</h2>
                        </div>
                        <div class="col-6">
                            <div class="float-right">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#produtos">Adicionar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-2 align-items-center">
                    <div class="card mb-4">
                        <div class="card-body">
                            <table class="table table-hover text-center">
                                <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Prefix</th>
                                    <th>Nome</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($produtos as $produto)
                                    <tr>
                                        <td>{{$produto->id}}</td>
                                        <td>{{$produto->prefix}}</td>
                                        <td>{{$produto->nome}}</td>
                                        <td>
                                            <div class="dropdown show">
                                                <button class="btn btn-sm dropdown-toggle" type="button" id="dr1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    <span class="text-muted sr-only">Action</span>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dr1" style="position: absolute; transform: translate3d(-130px, 30px, 0px); top: 0px; left: 0px; will-change: transform;" x-placement="bottom-end">
                                                    <a class="dropdown-item" href="#">Editar</a>
                                                    <a class="dropdown-item" href="#">Deletar</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="produtos" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="defaultModalLabel">Adicionar Produto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form action="{{route('store.produto')}}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label for="simpleinput">Prefix (URL)</label>
                                <input type="text" id="prefix" name="prefix" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="simpleinput">Nome</label>
                                <input type="text" id="nome" name="nome" class="form-control"  required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn mb-2 btn-primary">Salvar banco</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="row align-items-center mb-2">
                    <div class="row col-12">
                        <div class="col-6">
                            <h2 class="h5 page-title mt-2">Produtos listados</h2>
                        </div>
                        <div class="col-6">
                            <div class="float-right">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#produtos_listados">Adicionar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-2 align-items-center">
                    <div class="card mb-4">
                        <div class="card-body">
                            <table class="table table-hover text-center">
                                <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Banco</th>
                                    <th>Produto</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($bancos_produtos as $banco_produto)
                                    <tr>
                                        <td>{{$banco_produto->id}}</td>
                                        <td>{{$banco_produto->bancos->nome}}</td>
                                        <td>{{$banco_produto->produto->nome}}</td>
                                        <td>
                                            <div class="dropdown show">
                                                <button class="btn btn-sm dropdown-toggle" type="button" id="dr1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    <span class="text-muted sr-only">Action</span>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dr1" style="position: absolute; transform: translate3d(-130px, 30px, 0px); top: 0px; left: 0px; will-change: transform;" x-placement="bottom-end">
                                                    <a class="dropdown-item" href="#">Editar</a>
                                                    <a class="dropdown-item" href="#">Deletar</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="produtos_listados" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="defaultModalLabel">Listar Produtos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{route('store.produtoslistados')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="banco">Banco</label>
                            <select class="form-control" name="banco" id="banco" required>
                                <option value="">Selecione um banco...</option>
                                @foreach($bancos as $banco)
                                    <option value="{{$banco->id}}">{{$banco->nome}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="produto">Produto</label>
                            <select class="form-control" name="produto" id="produto" required>
                                <option value="">Selecione um produto...</option>
                                @foreach($produtos as $produto)
                                    <option value="{{$produto->id}}">{{$produto->nome}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn mb-2 btn-primary">Salvar banco</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</main>
@include('layout.footer')
