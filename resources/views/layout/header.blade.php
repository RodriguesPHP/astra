@php
    use App\Models\Bancos_produtos;
    $bancos_header = Bancos_produtos::select('banco_id')->distinct()->with('bancos')->get();
@endphp

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>Astra | </title>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="{{asset('css/simplebar.css')}}">
    <!-- Fonts CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="{{asset('css/feather.css')}}">
    <link rel="stylesheet" href="{{asset('css/select2.css')}}">
    <link rel="stylesheet" href="{{asset('css/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('css/uppy.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery.steps.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery.timepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/quill.snow.css')}}">
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="{{asset('css/daterangepicker.css')}}">
    <!-- App CSS -->
    <link rel="stylesheet" href="{{asset('css/app-light.css')}}" id="lightTheme" disabled>
    <link rel="stylesheet" href="{{asset('css/app-dark.css')}}" id="darkTheme">
</head>
<body class="horizontal dark  ">
<div class="wrapper">
    <nav class="navbar navbar-expand-lg navbar-light bg-white flex-row border-bottom shadow">
        <div class="container-fluid">
            <a class="navbar-brand mx-lg-1 mr-0" href="./index.html">
                <svg version="1.1" id="logo" class="navbar-brand-img brand-sm" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120" xml:space="preserve">
              <g>
                  <polygon class="st0" points="78,105 15,105 24,87 87,87 	" />
                  <polygon class="st0" points="96,69 33,69 42,51 105,51 	" />
                  <polygon class="st0" points="78,33 15,33 24,15 87,15 	" />
              </g>
            </svg>
            </a>
            <button class="navbar-toggler mt-2 mr-auto toggle-sidebar text-muted">
                <i class="fe fe-menu navbar-toggler-icon"></i>
            </button>
            <div class="navbar-slide bg-white ml-lg-4" id="navbarSupportedContent">
                <a href="#" class="btn toggle-sidebar d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
                    <i class="fe fe-x"><span class="sr-only"></span></i>
                </a>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a href="#" id="dashboardDropdown" class="dropdown-toggle nav-link" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="ml-lg-2">Dashboard</span><span class="sr-only">(current)</span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dashboardDropdown">
                            <a class="nav-link pl-lg-2" href="{{route('welcome')}}"><span class="ml-1">Default</span></a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" id="ui-elementsDropdown" class="dropdown-toggle nav-link" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="ml-lg-2">Consultas</span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="ui-elementsDropdown">
                            <a class="nav-link pl-lg-2" href="{{route('consulta')}}"><span class="ml-1">Consultar</span></a>
                            <a class="nav-link pl-lg-2" href="./ui-typograpy.html"><span class="ml-1">Historico</span></a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="widgets.html">
                            <span class="ml-lg-2">Esteira</span>
                            <span class="badge badge-pill badge-primary">1</span>
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="dropdown-toggle nav-link pl-lg-3" href="#" id="appsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Consulta em Lote </a>
                        <ul class="dropdown-menu" aria-labelledby="appsDropdown">
                            @foreach($bancos_header as $banco_produto_header)
                                <li class="nav-item dropdown">
                                    <a class="dropdown-toggle nav-link pl-lg-2" href="#" id="{{$banco_produto_header->bancos->prefix}}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="ml-1">{{$banco_produto_header->bancos->nome}}</span>
                                    </a>
                                    @php
                                    $produtos_header = Bancos_produtos::where('banco_id',$banco_produto_header->banco_id)->with('produto')->get();
                                    @endphp
                                        <ul class="dropdown-menu" aria-labelledby="{{$banco_produto_header->bancos->prefix}}">
                                            @foreach($produtos_header as $produto_header)
                                                <a class="nav-link pl-lg-2" href="{{route('campanhas.new',['banco'=>$banco_produto_header->bancos->prefix,'produto'=>$produto_header->produto->prefix])}}"><span class="ml-1">{{$produto_header->produto->nome}}</span></a>

                                            @endforeach
                                        </ul>
                                </li>
                            @endforeach
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('campanhas.index')}}">
                            <span class="ml-lg-2">Campanhas</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('campanhas.index')}}">
                            <span class="ml-lg-2">Leads</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('apps.index')}}">
                            <span class="ml-lg-2">Apps</span>
                        </a>
                    </li>
                </ul>
            </div>
            <form class="form-inline ml-md-auto d-none d-lg-flex searchform text-muted">
                <input class="form-control mr-sm-2 bg-transparent border-0 pl-4 text-muted" type="search" placeholder="Consulta cliente..." aria-label="Search">
            </form>
            <ul class="navbar-nav d-flex flex-row">
                <li class="nav-item dropdown ml-lg-0">
                    <a class="nav-link dropdown-toggle text-muted" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="avatar avatar-sm mt-2">
                  <img src="./assets/avatars/face-1.jpg" alt="..." class="avatar-img rounded-circle">
                </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <li class="nav-item">
                            <a class="nav-link pl-3" href="#">Configuração</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-3" href="#">Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
            <span class="fe fe-alert-triangle fe-16 mr-2"></span>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
            <span class="fe fe-alert-triangle fe-16 mr-2"></span>
             {{session('error')}}<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
            <span class="fe fe-check-circle fe-16 mr-2"></span>
            {{session('success')}}<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
   @endif
