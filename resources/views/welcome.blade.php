<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Título de tu página</title>
    <!-- Agregar Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Source Sans 3', sans-serif;
            background-color: #00A4D3;
            color: #ffffff; /* Color de texto blanco para mayor contraste */
            margin: 0;
            padding: 0;
        }
        .navbar {
            border-bottom: 2px solid #ffffff; /* Línea horizontal que cubre la barra de navegación */
        }
        .separator {
            border-right: 2px solid #ffffff; /* Barras verticales para separar el contenido central */
            padding-right: 10px; /* Espaciado para separar el contenido */
            padding-left: 10px;
        }
    </style>
</head>
<body>
    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark ">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">D(ia)gnóstico</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item col separator">
                        <a class="nav-link" href="/Farmacias">Farmacias</a>
                    </li>
                    <li class="nav-item col separator">
                        <a class="nav-link" href="/Medicos">Médicos</a>
                    </li>
                    <li class="nav-item col separator">
                        <a class="nav-link" href="/medicamentos">Medicamentos</a>
                    </li>
                    <li class="nav-item col separator">
                        <a class="nav-link" href="/diagnosticoChat">D(ia)gnóstico</a>
                    </li>
                </ul>
            </div>
            <div class="d-flex">
                @if(auth()->check())
                    <div class="dropdown">
                        <button class="btn btn-outline-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ auth()->user()->name }}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item" href="/profile">Perfil</a></li>
                            <li><a class="dropdown-item" href="/logout">Cerrar sesión</a></li>
                        </ul>
                    </div>
                @else
                    <a href="/login" class="btn btn-outline-light">Iniciar sesión</a>
                @endif
            </div>
        </div>
    </nav>

    <!-- Contenido de tu página -->
    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- Pie de página -->
    <footer style="border-top: 2px solid #ffffff;"class="footer mt-auto py-3  text-white">
        <div class="container text-center">
            <div class="row">
                <div class="col">
                    <h5>D(IA)GNÓSTICO</h5>
                    <p>Descripción breve de la página</p>
                </div>
                <div class="col">
                    <h5>Sobre nosotros</h5>
                    <p>Información sobre la empresa o proyecto</p>
                </div>
                <div class="col">
                    <h5>Preguntas frecuentes</h5>
                    <p>Respuestas a las preguntas más comunes</p>
                </div>
                <div class="col">
                    <h5>Contactanos</h5>
                    <p>Formulario de contacto o información de contacto</p>
                </div>
            </div>
            <p>&copy; 2024 Todos los derechos reservados</p>
        </div>
    </footer>

    <!-- Agregar Bootstrap JS (opcional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
