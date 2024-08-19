@extends('templates.crud')

@section('title', 'Viajes')

@section('body')
    <link rel="stylesheet" href="{{ asset('css/trips.css') }}">

    <div class="container">
        <h2 class="title">Lista de viajes</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-container">
            <div class="btn-container">
                <button id="openModal" class="btn">AGREGAR</button>
            </div>

            <table id="tripsTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Portada</th>
                        <th>Título</th>
                        <th>Tipo</th>
                        <th>Descripción</th>
                        <th>Fecha de salida</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($trips as $trip)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><img src="{{ $trip->portada }}" alt="Portada" class="profile-pic"></td>
                            <td>{{ $trip->titulo }}</td>
                            <td>{{ $trip->tipo }}</td>
                            <td>
                                <textarea rows="1" readonly class="expandable-textarea">{{ $trip->descripcion }}</textarea>
                              </td>
                            {{-- <td>
                                <textarea rows="1" class="expandable-textarea">{{ $trip->descripcion }}</textarea>
                            </td> --}}
                            {{-- <td>{{ $trip->descripcion }}</td>  --}}
                            <td>{{ $trip->fecha_salida }}</td>
                            <td>
                                <button class="btn btn-edit" data-id="{{ $trip->id }}" data-titulo="{{ $trip->titulo }}" data-tipo="{{ $trip->tipo }}" data-descripcion="{{ $trip->descripcion }}" data-fecha_salida="{{ $trip->fecha_salida }}" data-portada="{{ $trip->portada }}">Editar</button>
                                <form action="{{ route('trips.destroy', $trip->id) }}" method="POST" style="display:inline;">
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

        <!-- Modal -->
        <div id="modalForm" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Datos del Viaje</h2>

                <form id="tripForm" action="{{ route('trips.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="tripId" name="tripId" value="">
                    <label for="portada">Portada</label>
                    <input type="file" id="portada" name="portada" accept="image/*">
                    
                    <label for="titulo">Título</label>
                    <input type="text" id="titulo" name="titulo" placeholder="Ingrese el título del viaje" required>
                    
                    <label for="tipo">Tipo</label>
                    <select id="tipo" name="tipo" required>
                        <option value="" disabled selected>Selecciona el tipo del viaje</option>
                        <option value="Vacacional">Vacacional</option>
                        <option value="Local">Local</option>
                        <option value="USA">USA</option>
                    </select>
                    
                    <label for="descripcion">Descripción</label>
                    <textarea id="descripcion" name="descripcion" placeholder="Ingrese una descripción" required></textarea>
                    
                    <label for="fecha_salida">Fecha de salida</label>
                    <input type="date" id="fecha_salida" name="fecha_salida" required>
                    
                    <button type="submit" class="btn">Guardar</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')

<script>
    document.querySelectorAll('.expandable-textarea').forEach(function (element) {
  element.addEventListener('click', function () {
    if (this.classList.contains('expanded')) {
      this.classList.remove('expanded');
      this.style.height = '35px'; 
    } else {
      this.classList.add('expanded');
      this.style.height = this.scrollHeight + 'px';
    }
  });
    });






    document.addEventListener('DOMContentLoaded', function() {
        var today = new Date().toISOString().split('T')[0];
        document.getElementById('fecha_salida').setAttribute('min', today);
    });
    
    document.addEventListener("DOMContentLoaded", function() {
        var modal = document.getElementById("modalForm");
        var btn = document.getElementById("openModal");
        var span = document.getElementsByClassName("close")[0];
        var form = document.getElementById("tripForm");
        
        // Abrir el modal cuando se haga clic en el botón
        btn.onclick = function() {
            modal.style.display = "block";
            form.reset(); // Resetear el formulario
            document.getElementById('tripId').value = ''; // Limpiar el ID del viaje
            form.action = "{{ route('trips.store') }}"; // Establecer la acción del formulario para agregar
        }

        // Cerrar el modal cuando se haga clic en la "X"
        span.onclick = function() {
            modal.style.display = "none";
        }

        // Cerrar el modal cuando se haga clic fuera de él
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
        
        // Manejar el clic en el botón de editar
        document.querySelectorAll('.btn-edit').forEach(function(button) {
            button.addEventListener('click', function() {
                var id = this.getAttribute('data-id');
                var titulo = this.getAttribute('data-titulo');
                var tipo = this.getAttribute('data-tipo');
                var descripcion = this.getAttribute('data-descripcion');
                var fecha_salida = this.getAttribute('data-fecha_salida');
                var portada = this.getAttribute('data-portada');

                // Prellenar el formulario del modal
                document.getElementById('tripId').value = id;
                document.getElementById('portada').value = ''; // Para archivos, necesitarás un manejo especial
                document.getElementById('titulo').value = titulo;
                document.getElementById('tipo').value = tipo;
                document.getElementById('descripcion').value = descripcion;
                document.getElementById('fecha_salida').value = fecha_salida;

                // Cambiar la acción del formulario para la edición
                form.action = "{{ route('trips.update', '') }}/" + id;
                form.method = 'POST';

                // Mostrar el modal
                modal.style.display = "block";
            });
        });
    });
</script>
@endsection