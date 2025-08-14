<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>CV - {{ $postulante->nombre }} {{ $postulante->apellido }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            line-height: 1.6;
            color: #2d3748;
            background: #f8fafc;
        }
        
        .cv-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            overflow: hidden;
        }
        
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px;
            text-align: center;
            position: relative;
        }
        
        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.1);
        }
        
        .header-content {
            position: relative;
            z-index: 2;
        }
        
        .photo-container {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin: 0 auto 20px;
            border: 4px solid rgba(255,255,255,0.3);
            overflow: hidden;
            background: rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .photo-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .photo-placeholder {
            font-size: 48px;
            color: rgba(255,255,255,0.7);
        }
        
        .name {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 8px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .profession {
            font-size: 18px;
            font-weight: 500;
            opacity: 0.9;
            margin-bottom: 20px;
        }
        
        .contact-info {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
            margin-top: 20px;
        }
        
        .contact-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
        }
        
        .main-content {
            padding: 40px;
        }
        
        .section {
            margin-bottom: 35px;
        }
        
        .section-title {
            font-size: 20px;
            font-weight: 600;
            color: #667eea;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 2px solid #e2e8f0;
            position: relative;
        }
        
        .section-title::before {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 50px;
            height: 2px;
            background: #667eea;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .info-item {
            background: #f8fafc;
            padding: 12px 16px;
            border-radius: 8px;
            border-left: 4px solid #667eea;
        }
        
        .info-label {
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
            color: #718096;
            margin-bottom: 4px;
        }
        
        .info-value {
            font-size: 14px;
            color: #2d3748;
        }
        
        .studies-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 12px;
        }
        
        .study-item {
            background: #f0fff4;
            padding: 12px;
            border-radius: 8px;
            border-left: 4px solid #38a169;
            text-align: center;
        }
        
        .study-item.cursando {
            background: #fffbeb;
            border-left-color: #ecc94b;
        }
        
        .study-level {
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 4px;
        }
        
        .study-status {
            font-size: 12px;
            color: #718096;
        }
        
        .carnets-container {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }
        
        .carnet-badge {
            background: #667eea;
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }
        
        .skills-container {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }
        
        .skill-badge {
            background: #e2e8f0;
            color: #2d3748;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }
        
        .skill-badge.highlight {
            background: #48bb78;
            color: white;
        }
        
        .description-text {
            background: #f8fafc;
            padding: 16px;
            border-radius: 8px;
            font-size: 14px;
            line-height: 1.6;
            border-left: 4px solid #667eea;
        }
    </style>
</head>
<body>
    <div class="cv-container">
        <header class="header">
            <div class="header-content">
                <div class="photo-container">
                    @if(isset($postulante->foto) && $postulante->foto)
                        <img src="{{ asset('storage/fotos/' . $postulante->foto) }}" alt="Foto de {{ $postulante->nombre }}">
                    @else
                        <div class="photo-placeholder">👤</div>
                    @endif
                </div>
                <h1 class="name">{{ $postulante->nombre }} {{ $postulante->apellido }}</h1>
                <p class="profession">{{ optional($postulante->rubro)->rubro ?? 'Profesional' }}</p>
                
                <div class="contact-info">
                    <div class="contact-item">
                        <span>📧</span> {{ $postulante->email }}
                    </div>
                    <div class="contact-item">
                        <span>📱</span> {{ $postulante->telefono }}
                    </div>
                    <div class="contact-item">
                        <span>📍</span> {{ $postulante->localidad }}
                    </div>
                    <div class="contact-item">
                        <span>🆔</span> {{ number_format($postulante->dni, 0, ',', '.') }}
                    </div>
                </div>
            </div>
        </header>

        <main class="main-content">
            <!-- Información Personal -->
            <section class="section">
                <h2 class="section-title">Información Personal</h2>
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">Fecha de Nacimiento</div>
                        <div class="info-value">{{ \Carbon\Carbon::parse($postulante->fecha_nacimiento)->format('d/m/Y') }} ({{ \Carbon\Carbon::parse($postulante->fecha_nacimiento)->age }} años)</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Estado Civil</div>
                        <div class="info-value">{{ $postulante->estado_civil ?? 'No especificado' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Domicilio</div>
                        <div class="info-value">{{ $postulante->domicilio }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Sexo</div>
                        <div class="info-value">{{ $postulante->sexo ?? 'No especificado' }}</div>
                    </div>
                </div>
            </section>

            <!-- Formación Académica -->
            <section class="section">
                <h2 class="section-title">Formación Académica</h2>
                <div class="studies-grid">
                    @if($postulante->estudios_primaria || $postulante->cursando_primaria)
                        <div class="study-item {{ $postulante->cursando_primaria ? 'cursando' : '' }}">
                            <div class="study-level">Primaria</div>
                            <div class="study-status">
                                {{ $postulante->cursando_primaria ? 'En curso' : 'Completada' }}
                            </div>
                        </div>
                    @endif
                    @if($postulante->estudios_secundaria || $postulante->cursando_secundaria)
                        <div class="study-item {{ $postulante->cursando_secundaria ? 'cursando' : '' }}">
                            <div class="study-level">Secundaria</div>
                            <div class="study-status">
                                {{ $postulante->cursando_secundaria ? 'En curso' : 'Completada' }}
                            </div>
                        </div>
                    @endif
                    @if($postulante->estudios_terciario || $postulante->cursando_terciario)
                        <div class="study-item {{ $postulante->cursando_terciario ? 'cursando' : '' }}">
                            <div class="study-level">Terciario</div>
                            <div class="study-status">
                                {{ $postulante->cursando_terciario ? 'En curso' : 'Completado' }}
                            </div>
                        </div>
                    @endif
                    @if($postulante->estudios_universidad || $postulante->cursando_universidad)
                        <div class="study-item {{ $postulante->cursando_universidad ? 'cursando' : '' }}">
                            <div class="study-level">Universidad</div>
                            <div class="study-status">
                                {{ $postulante->cursando_universidad ? 'En curso' : 'Completada' }}
                            </div>
                        </div>
                    @endif
                </div>
                
                @if($postulante->estudios_cursados)
                    <div class="description-text">
                        {{ $postulante->estudios_cursados }}
                    </div>
                @endif
            </section>

            <!-- Experiencia Laboral -->
            @if($postulante->experiencia_laboral)
                <section class="section">
                    <h2 class="section-title">Experiencia Laboral</h2>
                    <div class="description-text">
                        {{ $postulante->experiencia_laboral }}
                    </div>
                </section>
            @endif

            <!-- Carnets y Licencias -->
            @if($postulante->carnets && $postulante->carnets->count() > 0)
                <section class="section">
                    <h2 class="section-title">Carnets y Licencias</h2>
                    <div class="carnets-container">
                        @foreach($postulante->carnets as $carnet)
                            <span class="carnet-badge">{{ $carnet->tipo_carnet }} - {{ $carnet->descripcion }}</span>
                        @endforeach
                    </div>
                </section>
            @endif

            <!-- Competencias -->
            <section class="section">
                <h2 class="section-title">Competencias y Certificaciones</h2>
                <div class="skills-container">
                    @if($postulante->certificado_check)
                        <span class="skill-badge highlight">Certificado Manipulación de Alimentos</span>
                    @endif
                    @if($postulante->movilidad_propia)
                        <span class="skill-badge highlight">Movilidad Propia</span>
                    @endif
                    @if($postulante->rubro)
                        <span class="skill-badge">{{ $postulante->rubro->rubro }}</span>
                    @endif
                    @if($postulante->rubros && $postulante->rubros->count() > 1)
                        @foreach($postulante->rubros as $rubro)
                            @if($rubro->id != $postulante->rubro_id)
                                <span class="skill-badge">{{ $rubro->rubro }}</span>
                            @endif
                        @endforeach
                    @endif
                </div>
            </section>
        </main>
    </div>
</body>
</html>