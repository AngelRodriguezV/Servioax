<div class="grid gap-2 overflow-y-scroll">
    @foreach ($solicitudes as $solicitud)
        <div class="bg-white p-3 mr-4 rounded-xl shadow-lg grid lg:grid-cols-2 gap-2">
            <p>
                Fecha: {{ $solicitud->fecha}}
            </p>
            <p>
                Estatus de la solicitud: <x-button-status href="{{ route('proveedor.aprobar', $solicitud) }}" :value="$solicitud->estatus" />
            </p>
            <p>
                Servicio: {{ $solicitud->servicio->nombre }}
            </p>
            <p>
                Cliente: {{ $solicitud->cliente->nombre . ' ' . $solicitud->cliente->apellido_paterno . ' ' . $solicitud->cliente->apellido_materno}}
            </p>
            <p>
                Hora de inicio: {{ $solicitud->hora_inicio }}
            </p>
            <p>
                Hora de termino: {{ $solicitud->hora_termino }}
            </p>
            <p>
                <a href="{{ route('proveedor.aprobar', $solicitud) }}" class="text-blue-400">Mas información</a>
            </p>
        </div>
    @endforeach
</div>
