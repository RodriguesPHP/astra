@include('layout.header')
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row align-items-center mb-2">
                    <div class="col">
                        <h2 class="h5 page-title">Campanhas</h2>
                    </div>
                </div>
                <div class="mb-2 align-items-center">
                    <div class="card mb-4">
                        <div class="card-body">

                            <div class="toolbar row mb-3">
                                <div class="col">
                                    <form class="form-inline">
                                        <div class="form-row">
                                            <div class="form-group col-auto">
                                                <label for="search" class="sr-only">Search</label>
                                                <input type="text" class="form-control" id="search" value="" placeholder="Pesquisa">
                                            </div>
                                            <div class="form-group col-auto ml-3">
                                                <label class="my-1 mr-2 sr-only" for="inlineFormCustomSelectPref">Status</label>
                                                <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
                                                    <option selected="">Filtrar...</option>
                                                    <option value="0">Pendente</option>
                                                    <option value="1">Processando</option>
                                                    <option value="2">Finalizada</option>
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col">
                                    <div class="dropdown float-right">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="actionMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Ações </button>
                                        <div class="dropdown-menu float-left" aria-labelledby="actionMenuButton" style="">
                                            <a class="dropdown-item" href="#">Download</a>
                                            <a class="dropdown-item" href="#">Deletar</a>
                                            <a class="dropdown-item" href="#">Unificar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- table -->
                            <table class="table table-bordered">
                                <thead>
                                <tr role="row">
                                    <th colspan="3">Campanha</th>
                                    <th colspan="4">Detalhes</th>
                                    <th colspan="3">Status</th>
                                </tr>
                                <tr role="row">
                                    <th>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="all">
                                            <label class="custom-control-label" for="all"></label>
                                        </div>
                                    </th>
                                    <th>ID</th>
                                    <th>Criada</th>
                                    <th>Nome</th>
                                    <th>Banco</th>
                                    <th>Registros</th>
                                    <th>Processados</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $statuses = [
                                        0 => ['label' => 'Pendente', 'class' => 'badge-warning'],
                                        1 => ['label' => 'Processando', 'class' => 'badge-primary'],
                                        2 => ['label' => 'Finalizada', 'class' => 'badge-success'],
                                    ];
                                @endphp

                                @foreach ($statuses as $status => $info)
                                    @if($info['label'] != 'Pendente')
                                    <tr role="group" class="bg-light">
                                        <td colspan="10"><strong>{{ $info['label'] }}</strong></td>
                                    </tr>
                                    @endif
                                    @foreach ($campanhas as $campanha)
                                        @if ($campanha->sit == $status)
                                            @php
                                                $porcetagem = ($campanha->processados > 0) ? number_format(($campanha->registros * 100) / $campanha->processados, 1) : 0;
                                            @endphp
                                            <tr>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input input-sn" name="campanhaID[]" id="{{$campanha->id}}" value="{{$campanha->id}}">
                                                        <label class="custom-control-label" for="{{$campanha->id}}"></label>
                                                    </div>
                                                </td>
                                                <td>{{$campanha->id}}</td>
                                                <td>{{$campanha->created_at->format('d-m-Y H:i:s')}}</td>
                                                <td>{{$campanha->nome}}</td>
                                                <td>{{$campanha->banco->nome .' | '.$campanha->produto->nome}}</td>
                                                <td>{{$campanha->registros}}</td>
                                                <td>{{$campanha->processados}}</td>
                                                <td><span class="badge {{$info['class']}}">{{ $info['label'] }}</span></td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <form action="#" method="post">
                                                                <button class="btn text-primary"><span class="fe fe-16 fe-pause-circle"></span></button>
                                                                <button class="btn text-success"><span class="fe fe-16 fe-play-circle"></span></button>
                                                                <button class="btn text-warning"><span class="fe fe-16 fe-stop-circle"></span></button>
                                                            </form>
                                                        </div>

                                                        <div class="col-2">
                                                            <button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <span class="text-muted sr-only">Action</span>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item" href="#">Deletar</a>
                                                                <a class="dropdown-item" href="#">Alterar Banco</a>
                                                                <a class="dropdown-item" href="#">Solicitar Envio</a>
                                                                <a class="dropdown-item" href="#">Download</a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                                </tbody>
                            </table>
                            <nav aria-label="Table Paging" class="mb-0 text-muted">
                                <ul class="pagination justify-content-end mb-0">
                                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@include('layout.footer')
