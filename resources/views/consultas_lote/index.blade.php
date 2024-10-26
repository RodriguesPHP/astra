@include('layout.header')
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row align-items-center mb-2">
                    <div class="col">
                        <h2 class="h5 page-title">Consulta em Lote | Banco Lotus - Saldo FGTS</h2>
                    </div>
                </div>
                <div class="mb-2 align-items-center">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="card">
                                <div class="card-header">
                                    <strong class="card-title text-danger">Avisos</strong>
                                </div>
                                <div class="card-body">
                                    <p><h4>Para consulta em lote FGTS</h4>O arquivo precisa conter os seguintes campos Nome, CPF e Data de Nascimento.</p>
                                </div>
                            </div>

                            <div class="mt-3">
                                <div class="col-md-12 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <form action="#" method="POST" enctype="multipart/form-data">
                                                @csrf
                                            <div class="form-group mb-3">
                                                <div class="form-group mb-3">
                                                    <label for="example-fileinput">Nome da campanha</label>
                                                    <input type="text" class="form-control" name="nome">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="customFile">Arquivo</label>
                                                    <div class="custom-file">
                                                        <input type="file" class="form-control-file" id="file" name="file">
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-center align-content-center">
                                                    <button class="btn btn-primary">Carregar Arquivo</button>
                                                </div>
                                            </div>
                                            </form>
                                        </div> <!-- /.card-body -->
                                    </div> <!-- /.card -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</main>
@include('layout.footer')
