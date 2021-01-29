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
                <img class="col-3 ml-auto p-3" id="logo" src="images/logo1.png">
                <h1 class="col-7 mx-auto p-3">PicSite</h1>
            </div>
            <hr class="linea mx-auto">
            <div class="row">
                <h5 class="mx-auto">{{trans('messages.bienvenido')}},  {{Auth::user()->nickname}}</h5>
            </div>
            <div class="row">
                <a href="https://localhost/Reto-Final/prueba/public/spot" class="btn btn-secondary mx-auto">{{trans('messages.nuevospot')}}</a><br>
            </div>
            <br>
            <div class="row">
                <a href="https://localhost/Reto-Final/prueba/public/dashboard" class="btn btn-secondary mx-auto">Volver</a>
            </div>
            <div class="contenidoAside" style="height: 20vh">
                <a><b>{{ trans('messages.idioma') }}</b></a>
                <ul>
                    <li><a href="{{ url('lang', ['en']) }}"><img class="idiomaBandera" src="images/banderaIngles.png"></a></li>
                    <li><a href="{{ url('lang', ['es']) }}"><img class="idiomaBandera" src="images/banderaCastellano.jpg"></a></li>
                    <li><a href="{{ url('lang', ['eus']) }}"><img class="idiomaBandera" src="images/banderaEsukadi.png"></a></li>
                </ul>
            </div>
        </aside>
        <div id="cuerpo">
            <div class="bg-white m-5 p-5" style="height:100vh">
                <h1>{{Auth::user()->nickname}}</h1>
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Perfil</a>
                        <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Spots</a>
                        <a class="nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Configuración</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <h5>{{Auth::user()->name}}</h5>
                        <p>Nombre y apellido: {{Auth::user()->name}} {{Auth::user()->apellido}}</p>
                        <p>Correo: {{Auth::user()->email}}</p>
                        <p>Ciudad: {{Auth::user()->city}}</p>
                        <p>Fecha de nacimiento: {{Auth::user()->fecha}}</p>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="row">
                            @foreach($spots as $spot)
                                <a href="{{route('info', $spot->id)}}" class="redirigir col-3 m-0 p-0 seleccion">
                                <img class="imagenSelec" src="{{asset($spot->url)}}">
                                <div class="contenido">
                                    <h2>{{($spot->name)}}</h2>
                                </div>
                            </a>
                            @endforeach 
                            <a href="{{route('nuevoSpot')}}" class="redirigir col-3 m-0 p-0 seleccion">
                                <img class="imagenSelec" src="images/carretera2.jpg">
                                <div class="contenido">
                                    <h2>Publicar un Spot</h2>
                                </div>
                            </a>         
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <form method="POST" action="/updateU/{{Auth::user()->id}}">
                            @csrf
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
    
                            <p>Nombre:</p>
                            <input type="string" class="form-control" name="name" value="{{Auth::user()->name}}">
                            <br>
                            
                            <p>Apellido</p>
                            <input type="text" class="form-control" name="apellido" value="{{Auth::user()->apellido}}">
                            <br>

                            <p>Ciudad</p>
                            <input type="text" class="form-control" name="city" value="{{Auth::user()->city}}">
                            <br>
                            
                            <p>fecha</p>
                            <input type="date" class="form-control" name="fecha" value="{{Auth::user()->fecha}}">
                            <br>

                            <div class="row">
                                <input class="btn btn-secondary mx-auto col-4" id="crear" type="submit" value="Actualizar cambios"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>