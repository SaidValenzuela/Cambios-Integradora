@extends('templates.crud')

@section('title', 'Reservaciones')

@section('body')
    <script src="https://kit.fontawesome.com/bac15b686a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/reservations.css') }}">

    {{-- Todo el crud --}}
    <div class="container">
        <h2 class="title">Reservaciones de viajes</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-container">
            <div class="search-container">
                <div class="dropdown">
                    <button class="btn btn-filter dropdown-toggle" id="filterDropdown">
                        <i class="fa-solid fa-sort"></i> Filtrar
                    </button>
                    <div class="dropdown-menu" id="filterOptions">
                        <a href="#" class="dropdown-item" data-placeholder="nombre">Buscar por nombre</a>
                        <a href="#" class="dropdown-item" data-placeholder="correo">Buscar por correo</a>
                        <a href="#" class="dropdown-item" data-placeholder="viaje">Buscar por viaje</a>
                        <a href="#" class="dropdown-item" id="sortDate">Ordenar por fecha próxima</a>
                    </div>
                </div>
                <input type="text" class="search-input" placeholder="Buscar..." id="searchInput" disabled>
            </div>

            <table id="tripsTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Viaje</th>
                        <th>Adultos</th>
                        <th>Jóvenes</th>
                        <th>Total pasajeros</th>
                        <th>Fecha para pagar</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="tripsTableBody">
                    @foreach ($reservations as $reservation)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $reservation->nombre }}</td>
                            <td>{{ $reservation->email }}</td>
                            <td>{{ $reservation->viaje }}</td>
                            <td>{{ $reservation->pasajeros_adultos }}</td>
                            <td>{{ $reservation->pasajeros_menores }}</td>
                            <td>{{ $reservation->total_pasajeros }}</td>
                            <td>{{ $reservation->fecha_pagar }}</td>
                            <td>
                                <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const filterOptions = document.getElementById('filterOptions');
    const searchInput = document.getElementById('searchInput');
    const sortDate = document.getElementById('sortDate');
    const tableBody = document.getElementById('tripsTableBody');

    let filterType = '';

    // Filtrar por nombre, correo o viaje
    filterOptions.addEventListener('click', function (e) {
        if (e.target.classList.contains('dropdown-item') && !e.target.classList.contains('btn')) {
            e.preventDefault();
            filterType = e.target.getAttribute('data-placeholder');
            searchInput.placeholder = `Buscar por ${filterType}...`;
            searchInput.disabled = false;
            searchInput.value = ''; // Clear the input value
            filterTable();
        }
    });

    // Función para filtrar la tabla
    function filterTable() {
        const filterText = searchInput.value.toLowerCase();
        const rows = tableBody.getElementsByTagName('tr');
        
        for (let row of rows) {
            const cells = row.getElementsByTagName('td');
            let match = false;
            
            switch (filterType) {
                case 'nombre':
                    match = cells[1].textContent.toLowerCase().includes(filterText);
                    break;
                case 'correo':
                    match = cells[2].textContent.toLowerCase().includes(filterText);
                    break;
                case 'viaje':
                    match = cells[3].textContent.toLowerCase().includes(filterText);
                    break;
            }
            
            row.style.display = match ? '' : 'none';
        }
    }

    // Filtrar en tiempo real al escribir
    searchInput.addEventListener('input', filterTable);

    // Ordenar por fecha más cercana a la fecha actual
    sortDate.addEventListener('click', function () {
        let rows = Array.from(tableBody.getElementsByTagName('tr'));
        let today = new Date(); // Fecha actual

        rows.sort(function (a, b) {
            let dateA = new Date(a.cells[7].textContent); // Columna "Fecha para pagar"
            let dateB = new Date(b.cells[7].textContent);
            
            // Calcular la diferencia en días
            let diffA = Math.abs((dateA - today) / (1000 * 60 * 60 * 24));
            let diffB = Math.abs((dateB - today) / (1000 * 60 * 60 * 24));
            
            return diffA - diffB; // Ordenar por diferencia en días
        });

        rows.forEach(row => tableBody.appendChild(row));

        console.log('Ordenar por fecha más cercana a la fecha actual');
    });
});

</script>
@endsection
