@extends('welcome')

@section('content')
    <div style="border-top: 2px solid #ffffff;" >
        <div class="container">
            <div class="row">
                <!-- Columna izquierda -->
                <div class="col-md-6">
                    <h1>Únete a nuestra aplicación médica!</h1>
                    <p>
                        Descubre una nueva forma de cuidar tu salud con nuestra aplicación médica todo en uno. 
                        Encuentra medicamentos, consulta diagnósticos y localiza servicios médicos cerca de ti. 
                        Simplifica tu vida y toma el control de tu bienestar hoy mismo.
                    </p>
                    <div class="d-flex">
                        <a href="#" class="btn btn-outline-light">Iniciar sesión</a>
                    </div>
                    <div class="d-flex mt-3">
                        <a href="#" class="btn btn-outline-light">Registrarse</a>
                    </div>
                </div>
                <!-- Columna derecha (imagen) -->
                <div class="col-md-6">
                    <img src="fondo.jpg" width="400px" height="290px" class="img-fluid" alt="Imagen de fondo">
                </div>
            </div>
        </div>
    </div>
    <div style="border-top: 2px solid #ffffff;" ></div>
    <div style="border-top: 2px solid #ffffff;" ></div>
@endsection