@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                        @csrf
            
                        <!-- Nombre -->
                        <div  class="mt-4">
                            {{ trans('messages.nombre') }}
                            <div>
                                <input id="name" placeholder="{{ trans('messages.placenombre') }}" type="text" class="block mt-1 w-full form-control" @error('name') is-invalid @enderror name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
            
                        <!-- Apellido -->
                        {{ trans('messages.apellido') }}
                            <div>
                                <input id="apellido" name="apellido" placeholder="{{ trans('messages.apellido') }}" type="text" class="block mt-1 w-full form-control" @error('apellido') is-invalid @enderror name="apellido" value="{{ old('apellido') }}" required autocomplete="apellido" >

                                @error('apellido')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                        <!-- fecha -->
                        <div  class="mt-4">
                            {{ trans('messages.fecha') }}
                            <div>
                                <input id="fecha" name="fecha" placeholder="{{ trans('messages.fecha') }}" type="date" class="block mt-1 w-full form-control" name="apellido" value="{{ old('fecha') }}" required autocomplete="fecha">
                            </div>
                        </div>

                        <!-- Ciudad -->
                        <div  class="mt-4">
                            {{ trans('messages.ciudad') }}
                            <div>
                                <input id="ciudad" name="city" placeholder="{{ trans('messages.ciudad') }}" type="text" class="block mt-1 w-full form-control" name="ciudad" value="{{ old('ciudad') }}" required autocomplete="ciudad">
                            </div>
                        </div>

                        <!-- Email Address -->
                        <div  class="mt-4">
                            {{ trans('messages.email') }}
                            <div>
                                <input id="email" placeholder="{{ trans('messages.email') }}" type="email" class="block mt-1 w-full form-control" name="email" value="{{ old('email') }}" required autocomplete="email">
                            </div>
                        </div>

                        <!-- Nickname -->
                        <div  class="mt-4">
                            {{ trans('Nickname') }}
                            <div>
                                <input id="nickname" name="nickname" placeholder="{{ trans('messages.nickname') }}" type="text" class="block mt-1 w-full form-control" name="nickname" value="{{ old('nickname') }}" required autocomplete="nickname">
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            {{ trans('messages.contrasena') }}
                            <input id="password" placeholder="{{ trans('messages.placecontra') }}" class="block mt-1 w-full form-control"
                                            type="password"
                                            name="password"
                                            required autocomplete="new-password" />
                        </div>
            
                        <!-- Confirm Password -->
                        <div class="mt-4">
                            {{ trans('messages.contrasena2') }}
                            <input id="password_confirmation" placeholder="{{ trans('messages.placerepcontra') }}" class="block mt-1 w-full form-control"
                                            type="password"
                                            name="password_confirmation" required />
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <a class="underline text-sm" data-dismiss="modal" data-toggle="modal" data-target="#modalSesion"  href="#">
                                {{ __('Already registered?') }}
                            </a>
                            <button type="submit" class="btn ml-4 btn-primary">
                                {{ trans('messages.botonregistro') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
