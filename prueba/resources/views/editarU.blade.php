<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <!--Linkear los estilos de la página-->
         <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
         <link rel="stylesheet" href="{{asset('css/formulariocrearSpot.css')}}">
         <!--Linkear los scripts de bootstrap-->
         <script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
         <script src="{{asset('js/popper.min.js')}}"></script>
         <script src="{{asset('js/bootstrap.min.js')}}"></script>
         <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
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
                <h5 class="mx-auto">{{trans('messages.bienvenido')}},  <span><a href="{{route('usuario')}}">{{Auth::user()->nickname}}</a></span></h5>
            </div>
            <div class="row">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Logout') }}
                    </x-dropdown-link>
                </form>
            </div>
            <div class="row">
                <a href="{{route('nuevoSpot')}}" class="btn btn-secondary mx-auto">{{trans('messages.nuevospot')}}</a><br>
            </div>
            <br>
            <div class="row">
                <a href="{{route('mios')}}" class="btn btn-secondary mx-auto">{{trans('messages.mio')}}</a><br>
            </div>
            <br>
            <div class="row">
                <div class="btn-group mx-auto">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">Ordenar por:</button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Más Antiguos</a>
                        <a class="dropdown-item" href="#">Más Recientes</a>
                        <hr class="dropdown-divider">
                        <a class="dropdown-item" href="#">Montaña</a>
                        <a class="dropdown-item" href="#">Animales</a>
                        <a class="dropdown-item" href="#">Lugares Abandonados</a>
                    </div>
                </div>
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
            <section id="page-content-wrapper">
            <span class="d-block d-sm-block d-md-none" id="boton" onclick="openNav()">&#9776;</span>
                <h2>Usuario Spot:</h2>
                <article class="card px-5 py-5 mx-auto my-auto col-xs-12 col-sm-10 col-md-10 col-lg-8">
                    
                    <form method="POST" action="/updateU/{{$user->id}}">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <p>Nickname:</p>
                        <input type="string" class="form-control" name="name" value="{{$user->nickname}}">
                        <br>

                        <p>Nombre:</p>
                        <input type="string" class="form-control" name="name" value="{{$user->name}}">
                        <br>
                        
                        <p>Apellido</p>
                        <input type="text" class="form-control" name="apellido" value="{{$user->apellido}}">
                        <br>

                        <p>Ciudad</p>
                        <input type="text" class="form-control" name="city" value="{{$user->city}}">
                        <br>
                        
                        <p>fecha</p>
                        <input type="date" class="form-control" name="fecha" value="{{$user->fecha}}">
                        <br>

                        <div class="row">
                            <input class="btn btn-secondary mx-auto col-4" id="crear" type="submit" value="Actualizar cambios"/>
                        </div>
                    </form>
                </article>
            </section>
        </div>
    </body>
</html>