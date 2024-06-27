@extends('welcome')

@section('content')
    <div style="border-top: 2px solid #ffffff;"  >
        <div class="container" style="margin-top:2%;margin-bottom: 2%">
            @if (auth()->check())
                <h1 class="d-flex justify-content-center">¡Bienvenido, {{ auth()->user()->name }}!</h1>
                <p class="d-flex justify-content-center">¡Gracias por unirte a nuestra aplicación médica!</p>
                <p class="d-flex justify-content-center">¡Esperamos que disfrutes de nuestro D(ia)gnóstico</p>
                <a class="btn btn-info d-flex justify-content-center" href="/diagnosticoChat">D(ia)gnóstico</a>
            @else
                <div class="row" style="margin-left: 10%">
                    <!-- Columna izquierda -->
                    <div class="col-md-6">
                        <h1>Únete a nuestra aplicación médica!</h1>
                        <p>
                            Descubre una nueva forma de cuidar tu salud con nuestra aplicación médica todo en uno. 
                            Encuentra medicamentos, consulta diagnósticos y localiza servicios médicos cerca de ti. 
                            Simplifica tu vida y toma el control de tu bienestar hoy mismo.
                        </p>
                        <div class="d-flex">
                            <a href="/login" class="btn btn-outline-light">Iniciar sesión</a>
                            <a href="/register" class="btn btn-outline-light ms-2">Registrarse</a>
                        </div>  
                    </div>
                    <!-- Columna derecha (imagen) -->
                    <div class="col-md-6">
                        <img src="fondo.jpg"  width="400px" height="290px" class="img-fluid rounded" alt="Imagen de fondo">
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div style="border-top: 2px solid #ffffff; margin-bottom: 20px;">
        <div style="margin-top:2%;margin-bottom: 2%">
            <div class="container ">
                <h2 class="d-flex justify-content-center">Usa algunas de nuestras herramientas!</h2>
                <p class="d-flex justify-content-center">Te ayudamos a encontrar en salud</p>
            </div>
            <div class="container" style="margin-top: 20px;">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-3 text-center">
                        <a href="/Farmacias" style="color: #ffffff">
                            <img src="Farmacias.png" class="img-fluid rounded-full" width="40px" height="40px" alt="Farmacias">
                            <h3>Farmacias</h3>
                            <p>Encuentra distintas farmacias cerca de tu zona</p>
                        </a>
                    </div>
                    <div class="col-md-3 text-center">
                        <a href="/Medicos" style="color: #ffffff">
                            <img src="Medicos.png" class="img-fluid rounded-full" width="40px" height="40px" alt="Médicos">
                            <h3>Médicos</h3>
                            <p>Encuentra distintos médicos cerca de tu zona</p>
                        </a>
                    </div>
                    <div class="col-md-3 text-center">
                        <a href="/medicamentos" style="color: #ffffff">
                            <img src="medicamentos.png" class="img-fluid rounded-full" width="40px" height="40px" alt="Medicamentos">
                            <h3>Medicamentos</h3>
                            <p>Busca los medicamentos que necesites</p>
                        </a>
                    </div>
                </div>
                
            </div>
        </div>
        
    </div>
    
    <div style="border-top: 2px solid #ffffff;" >
        <div class="container text-center" style="margin-top: 2%; margin-bottom: 2%">
            <h2 class="text-white">D(ia)gnóstico</h2>
            <div>
                <h4 class="text-dark bg-white rounded p-2 mb-3 d-inline-block">Regístrate y haz uso de nuestro diagnosticador que funciona con IA!</h4>
                <div class="row justify-content-center">
                    <div class="col-md-3 text-center text-dark rounded p-2 mr-md-3 mb-3" style="height: 250px">
                        <p class="bg-light rounded p-2">Añade tus síntomas en un chat con nuestra IA</p>
                        
                    </div>
                    <div class="col-md-3 text-center text-dark rounded p-2 mx-md-3 mb-3" style="height: 250px">
                        <p class="bg-light rounded p-2">Te mostrará posibles diagnósticos según dichos síntomas</p>
                        
                    </div>
                    <div class="col-md-3 text-center text-dark rounded p-2 ml-md-3 mb-3" style="height: 250px">
                        <p class="bg-light rounded p-2">Podrá decirte qué medicamentos necesitas y si estos necesitan receta</p>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        body {
            background-color: #00AEEF; /* Ajusta este color al color de fondo que desees */
        }
    
        .col-md-3 {
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid white; /* Para añadir el borde blanco alrededor de cada cuadro */
        }
    
        h2 {
            font-size: 2rem;
            margin-bottom: 1rem;
        }
    
        h4 {
            padding: 0.5rem;
        }
    </style>
@endsection