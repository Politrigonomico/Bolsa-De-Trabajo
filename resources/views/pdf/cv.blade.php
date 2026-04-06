<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>CV - {{ $postulante->nombre }} {{ $postulante->apellido }}</title>
    <style>
        @page { size: A4; margin: 5mm; }
        html, body { margin:0; padding:0; font-family: "DejaVu Sans", "Helvetica", "Arial", sans-serif; color:#17202A; font-size:11pt; }
        .wrap { width:100%; background:#fff; box-sizing:border-box; }

        /* Layout */
        .container {
            display: table;
            width: 100%;
            border: 1px solid #e6eefc;
            box-shadow: none;
        }
        .sidebar {
            display: table-cell;
            width: 85mm;
            vertical-align: top;
            background: #020407; /* oscuro */
            color: #ffffff;
            padding: 18px 14px;
        }
        .main {
            display: table-cell;
            vertical-align: top;
            min-height: 297mm; /* A4 */
            padding: 18px 22px;
        }

        /* Photo */
        .photo {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto 12px auto;
            border: 4px solid rgba(255,255,255,0.15);
            background: rgba(255,255,255,0.03);
        }
        .photo img { width:100%; height:100%; object-fit:cover; display:block; }

        /* Name & title in sidebar */
        .side-name { text-align:center; font-size:16pt; font-weight:700; margin-bottom:4px; letter-spacing:0.6px; }
        .side-role { text-align:center; font-size:10pt; opacity:0.95; margin-bottom:12px; }

        /* Contact list */
        .contact { font-size:9.5pt; line-height:1.45; margin-top:8px; }
        .contact .item { margin-bottom:6px; display:block; }
        .contact .label { font-weight:700; font-size:8.5pt; color: rgba(255,255,255,0.8); display:block; margin-bottom:2px; text-transform:uppercase; letter-spacing:0.6px; }

        /* Sidebar sections */
        .side-section { margin-top:14px; padding-top:10px; border-top:1px solid rgba(255,255,255,0.06); }
        .side-section .title { font-size:9pt; color: rgba(255,255,255,0.9); font-weight:700; margin-bottom:8px; text-transform:uppercase; letter-spacing:0.6px; }

        .badge { display:inline-block; padding:5px 8px; border-radius:12px; font-size:9pt; margin:3px 3px 3px 0; background:#e6f0ff; color:#0f172a; }

        /* Main content */
        .header-main {
            display:flex;
            justify-content:space-between;
            align-items:flex-start;
            margin-bottom:8px;
        }
        .name-main { font-size:18pt; font-weight:800; color:#0b3b8a; letter-spacing:0.4px; }
        .role-main { font-size:11pt; color:#374151; margin-top:4px; }

        .section { margin-top:14px; page-break-inside: avoid; }
        .section-title {
            font-size:10pt;
            color:#0b3b8a;
            font-weight:700;
            margin-bottom:8px;
            border-bottom:2px solid #e6f0ff;
            padding-bottom:6px;
            text-transform:uppercase;
            letter-spacing:0.6px;
        }

        .text-block {
            font-size:10pt;
            color:#22303a;
            line-height:1.5;
        }

        /* Education grid */
        .edu-grid { width:100%; border-collapse:collapse; margin-top:6px; }
        .edu-grid td { vertical-align:top; padding:8px; font-size:10pt; }
        .edu-card { background:#f7fbff; border-left:4px solid #22a0ff; padding:8px; }

        /* Skills as pills */
        .skills { margin-top:6px; }
        .skill { display:inline-block; padding:6px 10px; margin:4px 5px 4px 0; border-radius:14px; font-size:9.5pt; background:#f1f5f9; color:#0b3b8a; }

        /* Small details */
        .muted { color:#6b7280; font-size:9.5pt; }
        .footer {
            position: absolute;
            bottom: 1mm;
            left: 10mm;
            right: 10mm;
            text-align:center;
            font-size:8.5pt;
            color:#6b7280;
        }

        /* Dompdf-friendly: avoid complicated flexin inside table cell - kept simple */
    </style>
</head>
<body>
    <div class="wrap">
        <div class="container">
            <!-- SIDEBAR -->
            <div class="sidebar">
                @php
                    // preparar imagen embebida para DOMPDF (base64). Compatible con jpeg/png/gif.
                    $fotoDataUri = null;
                    if(!empty($postulante->foto)) {
                        $fotoPath = storage_path('app/public/fotos/' . $postulante->foto);
                        if(file_exists($fotoPath)) {
                            $finfo = finfo_open(FILEINFO_MIME_TYPE);
                            $mime = finfo_file($finfo, $fotoPath);
                            finfo_close($finfo);
                            $data = base64_encode(file_get_contents($fotoPath));
                            $fotoDataUri = 'data:' . $mime . ';base64,' . $data;
                        }
                    }
                @endphp

                <div class="photo">
                    @if($fotoDataUri)
                        <img src="{{ $fotoDataUri }}" alt="Foto {{ $postulante->nombre }}">
                    @else
                        <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,0.8);font-size:34px;">👤</div>
                    @endif
                </div>

                <div class="side-name">{{ strtoupper($postulante->nombre) }} {{ strtoupper($postulante->apellido) }}</div>
                <div class="side-role">{{ $postulante->rubro ? $postulante->rubro->rubro : ($postulante->profesion ?? 'Profesional') }}</div>

                <div class="contact">
                    <div class="item">
                        <div class="label">Email</div>
                        <div>{{ $postulante->email ?? '—' }}</div>
                    </div>
                    <div class="item">
                        <div class="label">Teléfono</div>
                        <div>{{ $postulante->telefono ?? '—' }}</div>
                    </div>
                    <div class="item">
                        <div class="label">Domicilio</div>
                        <div>{{ $postulante->domicilio ?? '—' }} @if($postulante->localidad), {{ $postulante->localidad }} @endif</div>
                    </div>
                    <div class="item">
                        <div class="label">DNI</div>
                        <div>{{ $postulante->dni ? number_format($postulante->dni,0,',','.') : '—' }}</div>
                    </div>
                    <div class="item">
                        <div class="label">Fecha Nac.</div>
                        <div>
                            @if($postulante->fecha_nacimiento)
                                {{ \Carbon\Carbon::parse($postulante->fecha_nacimiento)->format('d/m/Y') }}
                                ({{ \Carbon\Carbon::parse($postulante->fecha_nacimiento)->age }} años)
                            @else
                                —
                            @endif
                        </div>
                    </div>
                </div>

                <div class="side-section">
                    <div class="title">Estado</div>
                    <div class="muted">{{ $postulante->estado_civil ?? 'No especificado' }} · {{ $postulante->sexo ?? '—' }}</div>
                </div>

                @if(($postulante->rubros && $postulante->rubros->count()) || $postulante->rubro)
                <div class="side-section">
                    <div class="title">Áreas</div>
                    @if($postulante->rubro)
                        <span class="badge">{{ $postulante->rubro->rubro }} (Principal)</span>
                    @endif
                    @if($postulante->rubros)
                        @foreach($postulante->rubros as $r)
                            @if(!$postulante->rubro || $r->id != $postulante->rubro_id)
                                <span class="badge">{{ $r->rubro }}</span>
                            @endif
                        @endforeach
                    @endif
                </div>
                @endif

                <div class="side-section">
                    <div class="title">Carnets / Certif.</div>
                    @if($postulante->carnets && $postulante->carnets->count() > 0)
                        <div style="display:flex; flex-wrap:wrap; gap:4px;">
                            @foreach($postulante->carnets as $c)
                                <span style="background:rgba(255,255,255,0.12); color:#fff; padding:3px 8px; border-radius:8px; font-size:8.5pt; font-weight:700;">
                                    {{ $c->tipo_carnet ?? $c->carnetTipo }}
                                </span>
                            @endforeach
                        </div>
                    @else
                        <div class="muted">No cargados</div>
                    @endif
                </div>

                <div class="side-section">
                    <div class="title">Competencias</div>
                    <div>
                        @if($postulante->certificado_check) <span class="skill">Manipulación</span> @endif
                        @if($postulante->movilidad_propia) <span class="skill">Movilidad propia</span> @endif
                        @if($postulante->carnet_check) <span class="skill">Conductor</span> @endif
                        @if(empty($postulante->certificado_check) && empty($postulante->movilidad_propia) && empty($postulante->carnet_check))
                            <div class="muted">No especificadas</div>
                        @endif
                    </div>
                </div>

            </div>

            <!-- MAIN -->
            <div class="main">
                <div class="header-main">
                    <div style="text-align:right;">
                        <div class="muted" style="font-size:9pt;">CV generado: {{ date('d/m/Y') }}</div>
                    </div>
                </div>

                {{-- Resumen / Objetivo --}}
                @if($postulante->descripcion || $postulante->perfil)
                <div class="section">
                    <div class="section-title">Perfil profesional</div>
                    <div class="text-block">
                        {{ $postulante->descripcion ?? $postulante->perfil ?? '—' }}
                    </div>
                </div>
                @endif

                {{-- Formación --}}
                <div class="section">
                    <div class="section-title">Formación académica</div>

                    @php
                        $tieneEstudios = $postulante->estudios_primaria || $postulante->cursando_primaria ||
                                         $postulante->estudios_secundaria || $postulante->cursando_secundaria ||
                                         $postulante->estudios_terciario || $postulante->cursando_terciario ||
                                         $postulante->estudios_universidad || $postulante->cursando_universidad;
                    @endphp

                    @if($tieneEstudios)
                        <table class="edu-grid">
                            <tr>
                                @if($postulante->estudios_universidad || $postulante->cursando_universidad)
                                    <td style="width:33%;">
                                        <div class="edu-card">
                                            <strong>Universidad</strong><br>
                                            <span class="muted">{{ $postulante->cursando_universidad ? 'En curso' : 'Completado' }}</span>
                                        </div>
                                    </td>
                                @endif

                                @if($postulante->estudios_terciario || $postulante->cursando_terciario)
                                    <td style="width:33%;">
                                        <div class="edu-card">
                                            <strong>Terciario</strong><br>
                                            <span class="muted">{{ $postulante->cursando_terciario ? 'En curso' : 'Completado' }}</span>
                                        </div>
                                    </td>
                                @endif

                                @if($postulante->estudios_secundaria || $postulante->cursando_secundaria)
                                    <td style="width:33%;">
                                        <div class="edu-card">
                                            <strong>Secundaria</strong><br>
                                            <span class="muted">{{ $postulante->cursando_secundaria ? 'En curso' : 'Completado' }}</span>
                                        </div>
                                    </td>
                                @endif
                            </tr>
                            <tr>
                                @if($postulante->estudios_primaria || $postulante->cursando_primaria)
                                    <td colspan="3" style="padding-top:8px;">
                                        <div class="edu-card">
                                            <strong>Primaria</strong><br>
                                            <span class="muted">{{ $postulante->cursando_primaria ? 'En curso' : 'Completado' }}</span>
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        </table>
                    @else
                        <div class="muted">No especificado</div>
                    @endif

                    @if($postulante->estudios_cursados)
                        <div style="margin-top:8px;" class="text-block">
                            {{ $postulante->estudios_cursados }}
                        </div>
                    @endif
                </div>

                {{-- Experiencia --}}
                <div class="section">
                    <div class="section-title">Experiencia laboral</div>
                    @if($postulante->experiencia_laboral)
                        <div class="text-block">
                            {!! nl2br(e($postulante->experiencia_laboral)) !!}
                        </div>
                    @else
                        <div class="muted">No cargada</div>
                    @endif
                </div>
                </div>

            </div>
        </div>

        <div class="footer">CV generado por Sistema de Gestión de Postulantes - Oficina De Empleo Fighiera | {{ date('d/m/Y') }}</div>
    </div>
</body>
</html>
