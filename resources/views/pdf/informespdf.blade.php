<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Informe de Postulantes</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10pt;
            color: #1a1a1a;
        }
        h1 { font-size: 16pt; color: #c2410c; margin-bottom: 4px; }
        h2 { font-size: 12pt; color: #374151; margin-top: 16px; margin-bottom: 6px; }
        h3 { font-size: 10pt; color: #4b5563; margin-top: 12px; margin-bottom: 4px; }

        .meta { font-size: 9pt; color: #6b7280; margin-bottom: 16px; }

        /* Resumen en cajas */
        .resumen {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 16px;
        }
        .resumen td {
            width: 25%;
            text-align: center;
            border: 1px solid #e5e7eb;
            padding: 10px 6px;
            background: #fff7ed;
        }
        .resumen .numero { font-size: 18pt; font-weight: bold; color: #c2410c; }
        .resumen .label  { font-size: 8pt; color: #6b7280; }

        /* Estadísticas en dos columnas */
        .stats-grid {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 12px;
        }
        .stats-grid td {
            vertical-align: top;
            width: 50%;
            padding: 0 6px 0 0;
        }
        .stats-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9pt;
        }
        .stats-table th {
            background: #f3f4f6;
            border: 1px solid #d1d5db;
            padding: 5px 8px;
            text-align: left;
        }
        .stats-table td {
            border: 1px solid #e5e7eb;
            padding: 4px 8px;
        }
        .stats-table tr:nth-child(even) td { background: #f9fafb; }

        /* Tabla principal */
        .tabla-principal {
            width: 100%;
            border-collapse: collapse;
            font-size: 8.5pt;
            margin-top: 8px;
        }
        .tabla-principal th {
            background: #c2410c;
            color: white;
            padding: 6px 5px;
            text-align: left;
            border: 1px solid #9a3412;
        }
        .tabla-principal td {
            border: 1px solid #e5e7eb;
            padding: 5px;
            vertical-align: top;
        }
        .tabla-principal tr:nth-child(even) td { background: #fff7ed; }

        .badge {
            display: inline-block;
            background: #dcfce7;
            color: #166534;
            padding: 1px 5px;
            border-radius: 8px;
            font-size: 7.5pt;
            margin: 1px;
        }

        .footer {
            margin-top: 20px;
            font-size: 8pt;
            color: #9ca3af;
            text-align: center;
            border-top: 1px solid #e5e7eb;
            padding-top: 8px;
        }
    </style>
</head>
<body>

    <h1>Informe de Postulantes</h1>
    <p class="meta">Generado el {{ date('d/m/Y H:i') }} — Total: {{ $estadisticas['total'] }} postulantes</p>

    {{-- Resumen ejecutivo --}}
    <table class="resumen">
        <tr>
            <td>
                <div class="numero">{{ $estadisticas['total'] }}</div>
                <div class="label">Total</div>
            </td>
            <td>
                <div class="numero">{{ $estadisticas['total_mujeres'] }}</div>
                <div class="label">Mujeres</div>
            </td>
            <td>
                <div class="numero">{{ $estadisticas['total_hombres'] }}</div>
                <div class="label">Hombres</div>
            </td>
            <td>
                <div class="numero">{{ $estadisticas['con_certificado'] }}</div>
                <div class="label">Con certificado</div>
            </td>
        </tr>
    </table>

    {{-- Estadísticas en dos columnas --}}
    <table class="stats-grid">
        <tr>
            {{-- Por rubro --}}
            <td>
                <h3>Por profesión (top 10)</h3>
                <table class="stats-table">
                    <thead>
                        <tr>
                            <th>Profesión</th>
                            <th style="width:50px; text-align:center;">Cant.</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($estadisticas['por_rubro']->take(10) as $rubro => $cantidad)
                            <tr>
                                <td>{{ $rubro ?: 'Sin especificar' }}</td>
                                <td style="text-align:center;">{{ $cantidad }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </td>

            {{-- Por edad y educación --}}
            <td>
                <h3>Por rango de edad</h3>
                <table class="stats-table">
                    <thead>
                        <tr>
                            <th>Rango</th>
                            <th style="width:50px; text-align:center;">Cant.</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($estadisticas['por_edad'] as $rango => $cantidad)
                            <tr>
                                <td>{{ $rango }} años</td>
                                <td style="text-align:center;">{{ $cantidad }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <h3 style="margin-top:10px;">Nivel educativo</h3>
                <table class="stats-table">
                    <tbody>
                        <tr><td>Universidad completa</td><td style="text-align:center;">{{ $estadisticas['educacion']['universidad_completa'] }}</td></tr>
                        <tr><td>Terciario completo</td><td style="text-align:center;">{{ $estadisticas['educacion']['terciario_completo'] }}</td></tr>
                        <tr><td>Secundaria completa</td><td style="text-align:center;">{{ $estadisticas['educacion']['secundaria_completa'] }}</td></tr>
                        <tr><td>Cursando actualmente</td><td style="text-align:center;">{{ $estadisticas['educacion']['cursando'] }}</td></tr>
                    </tbody>
                </table>

                <h3 style="margin-top:10px;">Competencias</h3>
                <table class="stats-table">
                    <tbody>
                        <tr><td>Con certificado manipulación</td><td style="text-align:center;">{{ $estadisticas['con_certificado'] }}</td></tr>
                        <tr><td>Con movilidad propia</td><td style="text-align:center;">{{ $estadisticas['con_movilidad'] }}</td></tr>
                        <tr><td>Con carnet de conducir</td><td style="text-align:center;">{{ $estadisticas['con_carnet'] }}</td></tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>

    {{-- Tabla detalle --}}
    <h2>Detalle de postulantes</h2>
    <table class="tabla-principal">
        <thead>
            <tr>
                <th>Nombre y Apellido</th>
                <th>DNI</th>
                <th style="width:30px;">Edad</th>
                <th style="width:50px;">Sexo</th>
                <th>Profesión</th>
                <th>Localidad</th>
                <th>Competencias</th>
                <th style="width:55px;">Registro</th>
            </tr>
        </thead>
        <tbody>
            @foreach($postulantes as $postulante)
                <tr>
                    <td>{{ $postulante->nombre }} {{ $postulante->apellido }}</td>
                    <td>{{ number_format($postulante->dni, 0, ',', '.') }}</td>
                    <td style="text-align:center;">
                        {{ $postulante->fecha_nacimiento ? \Carbon\Carbon::parse($postulante->fecha_nacimiento)->age : '-' }}
                    </td>
                    <td>{{ $postulante->sexo }}</td>
                    <td>{{ optional($postulante->rubro)->rubro ?? 'Sin rubro' }}</td>
                    <td>{{ $postulante->localidad }}</td>
                    <td>
                        @if($postulante->certificado_check)
                            <span class="badge">Certificado</span>
                        @endif
                        @if($postulante->movilidad_propia)
                            <span class="badge">Movilidad</span>
                        @endif
                        @if($postulante->carnets && $postulante->carnets->count() > 0)
                            <span class="badge">{{ $postulante->carnets->pluck('tipo_carnet')->join(', ') }}</span>
                        @endif
                    </td>
                    <td>{{ $postulante->created_at->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Sistema de Gestión de Postulantes — Municipalidad de Arroyo Seco &bull; {{ date('d/m/Y') }}
    </div>

</body>
</html>