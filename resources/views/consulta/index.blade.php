@include('layout.header')
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row align-items-center mb-2">
                    <div class="col">
                        <h2 class="h5 page-title">Painel de consulta FGTS</h2>
                    </div>
                </div>
                <div class="mb-2 align-items-center">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form action="#" method="post" id="solicitar">
                                @csrf
                            <div class="row col-12">
                                <div class="form-group mb-3 col-6">
                                    <label for="example-fileinput">CPF Cliente</label>
                                    <input type="text" class="form-control" name="cpf" required>
                                </div>

                                <div class="form-group mb-3 col-2">
                                    <label for="example-fileinput">Parcelas</label>
                                    <select class="form-control" name="parcelas" required>
                                        @for( $i=1; $i<11; $i++)
                                            <option value="{{$i}}" selected>{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="form-group mb-3 col-6">
                                    <div class="form-check">
                                        @foreach($bancos as $banco)
                                            <input class="form-check-input" type="checkbox" value="{{$banco->bancos->id}}" name="bancos[]">
                                            <label class="form-check-label" for="defaultCheck1"> {{$banco->bancos->nome}} </label>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="form-group mb-3 col-2">
                                    <button class="btn btn-primary" type="submit">Consultar</button>
                                </div>

                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title">Consultas Recentes</h5>
                            <p class="card-text">Somentes as ultimas 20 consultas aparece aqui.</p>
                            <table class="table table-bordered table-hover mb-0">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>CPF</th>
                                    <th>Banco</th>
                                    <th>Parcelas</th>
                                    <th>Saldo</th>
                                    <th>Saldo Disp.</th>
                                    <th>Taxa</th>
                                    <th>Detalhes</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($consultas as $consulta)
                                    <tr>
                                        <td>
                                            @switch($consulta->sit)
                                                @case('0')
                                                    <span class="badge badge-pill badge-primary">Pendente</span>
                                                    @break
                                                @case('1')
                                                    <span class="badge badge-pill badge-success">Sucesso</span>
                                                    @break
                                                @case('2')
                                                    <span class="badge badge-pill badge-danger">Pendencia</span>
                                                    @break
                                                @default
                                                    <span class="badge badge-pill badge-secondary">Unknown</span>
                                            @endswitch
                                        </td>
                                        <td>{{$consulta->cpf}}</td>
                                        <td>{{$consulta->bancos->nome}}</td>
                                        <td>{{$consulta->parcelas}}</td>
                                        <td>R$ {{number_format($consulta->saldo, 2, ',', '.')}}</td>
                                        <td>R$ {{number_format($consulta->saldo_lib, 2, ',', '.')}}</td>
                                        <td>R$ {{number_format($consulta->taxa, 2, ',', '.')}}</td>
                                        <td>{{$consulta->log}}</td>
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
</main>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('#solicitar');
        form.addEventListener('submit', function() {
            const submitButton = form.querySelector('button[type="submit"]');
            submitButton.disabled = true;
            submitButton.innerText = 'Solicitando...';
        });
    });
</script>
@include('layout.footer')
