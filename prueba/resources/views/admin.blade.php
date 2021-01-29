<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--Linkear los estilos de la página-->
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/perfilusuario.css')}}">
        <!--Linkear los scripts de bootstrap-->
        <script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
        <script src="{{asset('js/popper.min.js')}}"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
        <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
        <!--Enlaces de Leaflet-->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="">
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
        <script>
           window.onload = iniciar;
            let sizze = window.screen.width;

            function iniciar(){
                if(sizze > 576){
                    document.getElementById("mySidenav").style.width = "25%";
                    document.getElementById("main").style.marginLeft = "0";
                }
                else{
                    closeNav;
                }
            }
            function openNav() {
                document.getElementById("mySidenav").style.width = "100%";
                document.getElementById("mySidenav").style.display = "block";
                document.getElementById("page-content-wrapper").style.marginLeft = "25%";
            }
            function closeNav() {
                document.getElementById("mySidenav").style.width = "0";
                document.getElementById("page-content-wrapper").style.marginLeft= "0";
            }
        </script>
        <title>PicSite</title>
    </head>
    <body class="antialiased">
    <aside id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn d-block d-sm-none d-md-none" onclick="closeNav()">&times;</a>
            <div class="row">
                <img class="col-3 ml-auto p-3" id="logo" src="{{asset('images/logo1.png')}}">
                <h1 class="col-7 mx-auto p-3">PicSite</h1>
            </div>
            <hr class="linea mx-auto">
            <div class="row">
                <h5 class="mx-auto">{{trans('messages.bienvenido')}},  {{Auth::user()->nickname}}</h5>
            </div>
            <div class="row">
                <a href="{{route('nuevoSpot')}}" class="btn btn-secondary mx-auto">{{trans('messages.nuevospot')}}</a><br>
            </div>
            <br>
            <div class="row">
                <a href="{{route('dashboard')}}" class="btn btn-secondary mx-auto">Volver</a>
            </div>
            <div class="contenidoAside" style="height: 20vh">
                <a><b>{{ trans('messages.idioma') }}</b></a>
                <ul>
                    <li><a href="{{ url('lang', ['en']) }}"><img class="idiomaBandera" src="{{asset('images/banderaIngles.png')}}"></a></li>
                    <li><a href="{{ url('lang', ['es']) }}"><img class="idiomaBandera" src="{{asset('images/banderaCastellano.jpg')}}"></a></li>
                    <li><a href="{{ url('lang', ['eus']) }}"><img class="idiomaBandera" src="{{asset('images/banderaEsukadi.png')}}"></a></li>
                </ul>
            </div>
        </aside>
        <div id="cuerpo">
            <!--Panel de control -->
            <div class="container">
                <h2>Lista de spots</h2>
                <table class="table table-striped table-dark">
                    <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Titulo del spot</th>
                        <th scope="col">url</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Latitud</th>
                        <th scope="col">Longitud</th>
                        <th scope="col">id del usuario</th>
                        <th scope="col">editar</th>
                        <th scope="col">eliminar</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($spots as $spot)
                            <tr>
                                <th scope="row">{{$spot->id}}</th>
                                <th scope="row">{{$spot->name}}</th>
                                <th scope="row">{{$spot->url}}</th>
                                <th scope="row">{{$spot->descripcion}}</th>
                                <th scope="row">{{$spot->latitud}}</th>
                                <th scope="row">{{$spot->longitud}}</th>
                                <th scope="row">{{$spot->user_id}}</th>
                                <th scope="row">
                                    <a href="{{route('edit', $spot)}}" class="btn tbn-primary">Editar</a>
                                </th>
                                <th scope="row">
                                    <form action="{{route('destroy', $spot)}}" method="POST" class="d-inline" >
                                        @method('DELETE')
                                        @csrf
                                        <button id="boton-eliminar" class="btn btn-danger" type="submit">Eliminar</button>
                                    </form>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <h2>Lista de usuarios</h2>
                <table class="table table-striped table-dark">
                    <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Nickname</th>
                        <th scope="col">{{trans('messages.nombre')}}</th>
                        <th scope="col">{{trans('messages.apellido')}}</th>
                        <th scope="col">{{trans('messages.ciudad')}}</th>
                        <th scope="col">{{trans('messages.fecha')}}</th>
                        <th scope="col">{{trans('messages.correo')}}</th>
                        <th scope="col">Rol</th>
                        <th scope="col">editar</th>
                        <th scope="col">eliminar</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <th scope="row">{{$user->id}}</th>
                                <th scope="row">{{$user->nickname}}</th>
                                <th scope="row">{{$user->name}}</th>
                                <th scope="row">{{$user->apellido}}</th>
                                <th scope="row">{{$user->city}}</th>
                                <th scope="row">{{$user->fecha}}</th>
                                <th scope="row">{{$user->email}}</th>
                                <th scope="row">{{$user->rol}}</th>
                                <th scope="row">
                                    <a href="{{route('editU', $user)}}" class="btn tbn-primary">Editar</a>
                                </th>
                                <th scope="row">
                                    <form action="{{route('destroyU', $user)}}" method="POST" class="d-inline" >
                                        @method('DELETE')
                                        @csrf
                                        <button id="boton-eliminar" class="btn btn-danger" type="submit">Eliminar</button>
                                    </form>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>