@extends('welcome')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="col-form-label">{{ __('Name') }}</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="col-form-label">{{ __('Email Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="password" class="col-form-label">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="password-confirm" class="col-form-label">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="DNI" class="col-form-label">{{ __('DNI') }}</label>
                                <input id="DNI" type="text" class="form-control @error('DNI') is-invalid @enderror" name="DNI" value="{{ old('DNI') }}" required autocomplete="DNI" autofocus>
                                @error('DNI')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="Apellidos" class="col-form-label">{{ __('Apellidos') }}</label>
                                <input id="Apellidos" type="text" class="form-control @error('Apellidos') is-invalid @enderror" name="Apellidos" value="{{ old('Apellidos') }}" required autocomplete="DNI" autofocus>
                                @error('Apellidos')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="Telefono" class="col-form-label">{{ __('Telefono') }}</label>
                                <input id="Telefono" type="text" class="form-control @error('Telefono') is-invalid @enderror" name="Telefono" value="{{ old('Telefono') }}" required autocomplete="Telefono" autofocus>
                                @error('Telefono')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="Codigo_Postal" class="col-form-label">{{ __('Codigo_Postal') }}</label>
                                <input id="Codigo_Postal" type="text" class="form-control @error('Codigo_Postal') is-invalid @enderror" name="Codigo_Postal" value="{{ old('Codigo_Postal') }}" required autocomplete="Codigo_Postal" autofocus>
                                @error('Codigo_Postal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="Provincia" class="col-form-label">{{ __('Provincia') }}</label>
                                <input id="Provincia" type="text" class="form-control @error('Provincia') is-invalid @enderror" name="Provincia" value="{{ old('Provincia') }}" required autocomplete="Provincia" autofocus>
                                @error('Provincia')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="Ciudad" class="col-form-label">{{ __('Ciudad') }}</label>
                                <input id="Ciudad" type="text" class="form-control @error('Ciudad') is-invalid @enderror" name="Ciudad" value="{{ old('Ciudad') }}" required autocomplete="Ciudad" autofocus>
                                @error('Ciudad')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
