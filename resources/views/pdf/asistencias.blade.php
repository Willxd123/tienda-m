<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Aula</th>
            <th>Módulo</th>
            <th>Día</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Estado</th>
            <th>Observación</th>
        </tr>
    </thead>
    <tbody>
        {{ $contador = 1 }}
        @foreach ($data as $asistencia)
            <tr>
                <td>{{ $contador }}</td>
                <td>{{  $asistencia['aula'] }}</td>
                <td>{{  $asistencia['modulo'] }}</td>
                <td>{{  $asistencia['dia'] }}</td>
                <td>{{  $asistencia['fecha'] }}</td>
                <td>{{  $asistencia['hora'] }}</td>
                <td>{{  $asistencia['estado'] }}</td>
                <td>{{  $asistencia['observacion'] }}</td>
                {{ $contador = $contador + 1 }}
            </tr>
        @endforeach
    </tbody>
</table>
