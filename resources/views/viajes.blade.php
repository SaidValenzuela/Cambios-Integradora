<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Viajes Locales | Turismo Los Angeles</title>

    <!-- link font awesome -->
    <script src="https://kit.fontawesome.com/bac15b686a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <!-- link css -->
    <link rel="stylesheet" href="{{ asset('css/viajes.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('imagenesInicio/favicon.ico') }}">

</head>
<body>

    <!-- sección encabezado inicio -->
    <header class="header">
        <a href="/inicio" class="logo"> <i class="fas fa-angel"></i> Turismo Los Ángeles </a>
        <nav class="navbar">
            <div id="nav-close" class="fas fa-times"></div>
            <a href="/inicio">Inicio</a>
            <a href="/servicios">Nuestros servicios</a>
            <a href="/viajes">Viajes</a>
            <a href="/citasPrincipal">Citas</a>
            <div class="user-menu">
                @guest
                    <a href="/iniciar-sesion" class="dropdown-toggle">Iniciar sesión</a>
                @else
                    <a href="/mis-citas">Mis citas</a>
                    <a href="" class="dropdown-toggle">Bienvenido, {{ Auth::user()->name }} </a>
                    <div class="dropdown-menu">
                        <a href="/inicio" onclick="confirmLogout(event)">Cerrar sesión</a>
                    </div>
                @endguest
            </div>
        </nav> 
        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <div id="search-btn" class="fas fa-search" style="display: none;"></div>
        </div>
    </header> <br><br><br>

    <!-- sección encabezado final -->

    <!-- search form -->
    <div class="search-form">
        <div id="close-search" class="fas fa-times"></div>
    </div>

    <!-- sección viajes locales coahuila inicio -->
    <section class="blogs" id="blogs">
        <h1 class="heading"> Viajes Locales </h1>
        <div class="swiper blogs-slider">
            <div class="swiper-wrapper">
                @foreach ($trips as $trip)
                    @if ($trip->tipo === 'Local')
                        <div class="swiper-slide slide">
                            <img src="{{ $trip->portada }}" alt="Portada del viaje">
                            <div class="icons">
                                <a href="#"> <i class="fa-solid fa-calendar-day"></i> Fecha de salida: {{ $trip->fecha_salida }}</a>
                            </div>
                            <h3>{{ $trip->titulo }}</h3>
                            <p>{{ $trip->descripcion }}</p>
                            <a href="#" class="btn" onclick="openModal('{{ $trip->titulo }}')">Realizar reserva</a>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>
    <!-- sección viajes locales coahuila final -->

    <!-- sección viajes vacacionales inicio -->
    <section class="blogs second" id="blogs-a">
        <h1 class="heading"> Viajes Vacacionales </h1>
        <div class="swiper blogs-slider">
            <div class="swiper-wrapper">
                @foreach ($trips as $trip)
                    @if ($trip->tipo === 'Vacacional')
                        <div class="swiper-slide slide">
                            <img src="{{ $trip->portada }}" alt="Portada del viaje">
                            <div class="icons">
                                <a href="#"> <i class="fa-solid fa-calendar-day"></i> Fecha de salida: {{ $trip->fecha_salida }}</a>
                            </div>
                            <h3>{{ $trip->titulo }}</h3>
                            <p>{{ $trip->descripcion }}</p>
                            <a href="#" class="btn" onclick="openModal('{{ $trip->titulo }}')">Realizar reserva</a>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>
    <!-- sección viajes vacacionales final -->

    <!-- sección viajes Estados Unidos inicio -->
    <section class="blogs" id="blogs">
        <h1 class="heading"> Viajes Estados Unidos </h1>
        <div class="swiper blogs-slider">
            <div class="swiper-wrapper">
                @foreach ($trips as $trip)
                    @if ($trip->tipo === 'USA')
                        <div class="swiper-slide slide">
                            <img src="{{ $trip->portada }}" alt="Portada del viaje">
                            <div class="icons">
                                <a href="#"> <i class="fa-solid fa-calendar-day"></i> Fecha de salida: {{ $trip->fecha_salida }}</a>
                            </div>
                            <h3>{{ $trip->titulo }}</h3>
                            <p>{{ $trip->descripcion }}</p>
                            <a href="#" class="btn" onclick="openModal('{{ $trip->titulo }}')">Realizar reserva</a>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>
    <!-- sección viajes Estados Unidos final -->

    <!-- sección píe de página inicio -->

    <section class="footer">

        <div class="box-container">

            <div class="box">
                <h3>Enlaces directos</h3>
                <a href="/inicio">Inicio</a>
                <a href="/servicios">Nuestros servicios</a>
                <a href="/viajes">Viajes</a>
                <a href="/citasPrincipal">Citas</a>
            </div>

            <div class="box">
                <h3>Enlaces adicionales</h3>
                <a href="/visa">Visas</a>
                <a href="/pasaporte">Pasaporte</a>
                <a href="/unidades">Unidades</a>
            </div>

            <div class="box">
                <h3>Contacto</h3>
                <a href="https://wa.me/8714010593" target="_blank"> <i class="fas fa-phone"></i> Visas (871) 401 0593 </a>
                <a href="https://wa.me/8712174806" target="_blank"> <i class="fas fa-phone"></i> Viajes (871) 217 4806 </a>
                <a href="https://wa.me/8714572300" target="_blank"> <i class="fas fa-phone"></i> Unidades (871) 457 2300 </a>
                <a href="mailto:turismolosangelespro@gmail.com" target="_blank" style="text-transform: none;"> <i class="fas fa-envelope"></i> turismolosangelespro@gmail.com </a>
                <a href="https://www.google.com/maps/search/?api=1&query=25.539489240121423,-103.45462295777837" target="_blank"> <i class="fas fa-map"></i>  Av morelos 482, primero de cobián centro, 27000 Torreón, Coah. </a> 
            </div>

            <div class="box">
                <h3>Siguenos</h3>
                <a href="https://www.facebook.com/TurismoLosAngeless/?locale=es_LA" target="_blank"> <i class="fab fa-facebook"></i> Facebook </a>
                <a href="https://wa.me/8712174806" target="_blank"> <i class="fab fa-whatsapp"></i> WhatsApp</a>
                <a href="https://www.instagram.com/turismolosangeles1/?hl=es-la" target="_blank"> <i class="fab fa-instagram"></i> Instagram </a>
            </div>

        </div>

        <div class="credit">Copyright © 2024 <span>Turismo Los Ángeles</span> | Todos los derechos reservados.</div>

    </section>

    <!-- sección modal inicio -->
    <div id="modalForm" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Reserva </h2>
    
            <!-- Asegúrate de que el atributo action apunte a la ruta correcta en tu aplicación -->
            <form id="reservationForm" action="{{ route('reservations.store') }}" method="POST">
                @csrf
                <label for="nombre" class="label-text">Nombre</label>
                <input type="text" id="nombre" name="nombre" placeholder="Ingresa tu nombre..." required>
    
                <label for="correo" class="label-text">Correo electrónico</label>
                <input type="email" id="correo" name="correo" placeholder="Ingresa tu correo..." required>
    
                <label for="viaje" class="label-text">Viaje</label>
                <input type="text" id="viaje" name="viaje" placeholder="Viaje seleccionado..." required readonly>
    
                <label for="pasajeros_adultos" class="label-text">Pasajeros adultos ( +18 años )</label>
                <input type="number" id="pasajeros_adultos" name="pasajeros_adultos" placeholder="Ingresa los pasajeros adultos... (incluyéndote)" required>
    
                <label for="pasajeros_menores" class="label-text">Pasajeros menores ( -18 años )</label>
                <input type="number" id="pasajeros_menores" name="pasajeros_menores" placeholder="Ingresa los pasajeros menores... (opcional)">
    
                <label for="fecha_pagar" class="label-text">Fecha y hora para pagar</label>
                <div class="tooltip">
                    <input type="datetime-local" id="fecha_pagar" name="fecha_pagar" placeholder="Selecciona la fecha y hora para pagar..." required>
                    <div class="tooltiptext">Para confirmar tu reserva debes de acudir a nuestras oficinas para realizar el pago, puedes iniciar con un anticipo de $500 e ir pagando en abonos antes del día de salida.</div>
                </div><br>
    
                <input type="submit" class="button" value="Enviar">
            </form>
        </div>
    </div>
    
    
    <!-- sección modal final -->

    <!-- Sección de scripts -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/viajes.js') }}"></script>
</body>
</html>
