@extends('welcome')

@section('content')
    <div style="border-top: 2px solid #ffffff;"  >
        <div class="container" style="margin-top:2%;margin-bottom: 2%">
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
                        <a href="" class="btn btn-outline-light">Iniciar sesión</a>
                        <a href="#" class="btn btn-outline-light ms-2">Registrarse</a>
                    </div>
                    
                </div>
                <!-- Columna derecha (imagen) -->
                <div class="col-md-6">
                    <img src="fondo.jpg"  width="400px" height="290px" class="img-fluid rounded" alt="Imagen de fondo">
                </div>
            </div>
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
                        <img src="Farmacias.png" class="img-fluid rounded-full" width="40px" height="40px" alt="Farmacias">
                        <h3>Farmacias</h3>
                        <p>Encuentra distintas farmacias cerca de tu zona</p>
                    </div>
                    <div class="col-md-3 text-center">
                        <img src="Medicos.png" class="img-fluid rounded-full" width="40px" height="40px" alt="Médicos">
                        <h3>Médicos</h3>
                        <p>Encuentra distintos médicos cerca de tu zona</p>
                    </div>
                    <div class="col-md-3 text-center">
                        <img src="medicamentos.png" class="img-fluid rounded-full" width="40px" height="40px" alt="Medicamentos">
                        <h3>Medicamentos</h3>
                        <p>Busca los medicamentos que necesites</p>
                    </div>
                </div>
                
            </div>
        </div>
        
    </div>
    
    <div style="border-top: 2px solid #ffffff;" >
        <div class="container text-center" style="margin-top:2%;margin-bottom: 2%">
            <h2 class="">D(ia)gnóstico</h2>
            <div>
                <h4 class="text-dark bg-light rounded p-2 mb-3 d-inline-block">Registrate y haz uso de nuestro diagnosticador que funciona con IA!</h4>
                <div class="row justify-content-center">
                    <div class="col-md-2 text-center text-dark bg-light rounded p-2 mr-md-5 mb-3">Añade tus síntomas en un chat con nuestra IA</div>    
                    <div class="col-md-2 text-center text-dark bg-light rounded p-2 mx-md-5 mb-3">Te mostrará posibles diagnósticos según tus síntomas</div>    
                    <div class="col-md-2 text-center text-dark bg-light rounded p-2 ml-md-5 mb-3">Te dirá qué medicamentos tomar y si estos necesitan receta</div>    
                </div>
            </div>
        </div>        
    </div>
@endsection