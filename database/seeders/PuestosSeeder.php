<?php

namespace Database\Seeders;

use App\Models\PuestoFamilia;
use App\Models\PuestoGrupo;
use App\Models\PuestoNomenclatura;
use App\Models\PuestoSubfamilia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PuestosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $grupos = [
            //id=1
            ['nombre' => 'Científico'],
            //id=2
            ['nombre' => 'Gestión Gubernamental'],
            //id=3
            ['nombre' => 'Producción'],
            //id=4
            ['nombre' => 'Servicios'],
            //id=5
            ['nombre' => 'Transversal'],
        ];

        foreach ($grupos as $grupo) {
            PuestoGrupo::create($grupo);
        }

        $familias = [
            //Científico
            ['nombre' => 'Aplicación Científica', 'puesto_grupo_id' => 1],
            ['nombre' => 'Investigación y Desarrollo', 'puesto_grupo_id' => 1],

            //Gestión Gubernamental
            ['nombre' => 'Autorización y Registro', 'puesto_grupo_id' => 2],
            ['nombre' => 'Control', 'puesto_grupo_id' => 2],
            ['nombre' => 'Planificación e Implementación de Políticas Públicas', 'puesto_grupo_id' => 2],
            ['nombre' => 'Regulación', 'puesto_grupo_id' => 2],
            
            //Servicios
            ['nombre' => 'Arte, Conservación Patrimonial y Cultural', 'puesto_grupo_id' => 4],
            ['nombre' => 'Asistencia Jurídica a la Ciudadanía', 'puesto_grupo_id' => 4],
            ['nombre' => 'Salud', 'puesto_grupo_id' => 4],

            //Transversal
            ['nombre' => 'Administración Presupuestaria', 'puesto_grupo_id' => 5],
            ['nombre' => 'Asuntos Jurídicos', 'puesto_grupo_id' => 5],
            ['nombre' => 'Comunicación y Relaciones Institucionales', 'puesto_grupo_id' => 5],
            ['nombre' => 'Control Interno y Gestión de Proyectos', 'puesto_grupo_id' => 5],
            ['nombre' => 'Mantenimiento y Servicios Generales', 'puesto_grupo_id' => 5],
            ['nombre' => 'Recursos Humanos', 'puesto_grupo_id' => 5],
            ['nombre' => 'Servicios Administrativos', 'puesto_grupo_id' => 5],
            ['nombre' => 'Tecnologías de la Información y las Comunicaciones (TIC)', 'puesto_grupo_id' => 5]
        ];

        foreach ($familias as $familia) {
            PuestoFamilia::create($familia);
        }

        $subfamilias = [
            //Servicios => Arte, Conservación Patrimonial y Cultural
            ['nombre' => 'Conservación Patrimonial y Cultural', 'puesto_grupo_id' => 4, 'puesto_familia_id' => 7 ],
            ['nombre' => 'Diseño y Soporte Artístico', 'puesto_grupo_id' => 4, 'puesto_familia_id' => 7 ],
            ['nombre' => 'Ejecución Artística', 'puesto_grupo_id' => 4, 'puesto_familia_id' => 7 ],
            
            //Transversal => Administración Presupuestaria
            ['nombre' => 'Compras y Contrataciones', 'puesto_grupo_id' => 5, 'puesto_familia_id' => 10 ],
            ['nombre' => 'Contabilidad', 'puesto_grupo_id' => 5, 'puesto_familia_id' => 10 ],
            ['nombre' => 'Presupuesto y Finanzas', 'puesto_grupo_id' => 5, 'puesto_familia_id' => 10 ],
            ['nombre' => 'Tesorería', 'puesto_grupo_id' => 5, 'puesto_familia_id' => 10 ],

            //Transversal => Asuntos Jurídicos
            ['nombre' => 'Asuntos Legales', 'puesto_grupo_id' => 5, 'puesto_familia_id' => 11 ],
            ['nombre' => 'Cuerpo de Abogados del Estado (C.A.E.) y Finanzas', 'puesto_grupo_id' => 5, 'puesto_familia_id' => 11 ],

            //Transversal => Comunicación y Relaciones Institucionales
            ['nombre' => 'Ceremonial y Protocolo', 'puesto_grupo_id' => 5, 'puesto_familia_id' => 12 ],
            ['nombre' => 'Comunicación y Contenido Institucional', 'puesto_grupo_id' => 5, 'puesto_familia_id' => 12 ],

            //Transversal => Control Interno y Gestión de Proyectos
            ['nombre' => 'Auditoría', 'puesto_grupo_id' => 5, 'puesto_familia_id' => 13 ],
            ['nombre' => 'Gestión de Proyectos', 'puesto_grupo_id' => 5, 'puesto_familia_id' => 13 ],

            //Transversal => Mantenimiento y Servicios Generales
            ['nombre' => 'Mantenimiento', 'puesto_grupo_id' => 5, 'puesto_familia_id' => 14 ],
            ['nombre' => 'Servicios Generales', 'puesto_grupo_id' => 5, 'puesto_familia_id' => 14 ],

            //Transversal => Recursos Humanos
            ['nombre' => 'Administración y Gestión de Personal', 'puesto_grupo_id' => 5, 'puesto_familia_id' => 15 ],
            ['nombre' => 'Carrera', 'puesto_grupo_id' => 5, 'puesto_familia_id' => 15 ],
            ['nombre' => 'Salud y Seguridad Ocupacional', 'puesto_grupo_id' => 5, 'puesto_familia_id' => 15 ],

            //Transversal => Servicios Administrativos
            ['nombre' => 'Atención al Ciudadano', 'puesto_grupo_id' => 5, 'puesto_familia_id' => 16 ],
            ['nombre' => 'Soporte Administrativo', 'puesto_grupo_id' => 5, 'puesto_familia_id' => 16 ],

            //Transversal => Tecnologías de la Información y las Comunicaciones (TIC)
            ['nombre' => 'Arquitectura de Servicios', 'puesto_grupo_id' => 5, 'puesto_familia_id' => 17 ],
            ['nombre' => 'Datos', 'puesto_grupo_id' => 5, 'puesto_familia_id' => 17 ],
            ['nombre' => 'Desarrollo', 'puesto_grupo_id' => 5, 'puesto_familia_id' => 17 ],
            ['nombre' => 'Gestión de Aplicaciones', 'puesto_grupo_id' => 5, 'puesto_familia_id' => 17 ],
            ['nombre' => 'Gestión de Infraestructura', 'puesto_grupo_id' => 5, 'puesto_familia_id' => 17 ],
            ['nombre' => 'Gestión de Operaciones', 'puesto_grupo_id' => 5, 'puesto_familia_id' => 17 ],
            ['nombre' => 'Implementación de Soluciones y Soporte', 'puesto_grupo_id' => 5, 'puesto_familia_id' => 17 ],
            ['nombre' => 'Seguridad Informática y Ciberseguridad', 'puesto_grupo_id' => 5, 'puesto_familia_id' => 17 ],

        ];

        foreach ($subfamilias as $subfamilia) {
            PuestoSubfamilia::create($subfamilia);
        }

        $puestos_nomenclaturas = [
            //Científico
            ['nombre' => 'Analista de Aplicación Científica C-AC-ANAC',         'puesto_grupo_id' => 1, 'puesto_familia_id' => 1, 'puesto_subfamilia_id' => null],
            ['nombre' => 'Asistente de Aplicación Científica C-AC-ASAC',        'puesto_grupo_id' => 1, 'puesto_familia_id' => 1, 'puesto_subfamilia_id' => null],
            ['nombre' => 'Especialista de Aplicación Científica C-AC-ESPAC',    'puesto_grupo_id' => 1, 'puesto_familia_id' => 1, 'puesto_subfamilia_id' => null],
            ['nombre' => 'Investigador de Aplicación Científica C-AC-INVAC',    'puesto_grupo_id' => 1, 'puesto_familia_id' => 1, 'puesto_subfamilia_id' => null],
            ['nombre' => 'Asistente de Investigación y Desarrollo C-IYD-ASINV', 'puesto_grupo_id' => 1, 'puesto_familia_id' => 2, 'puesto_subfamilia_id' => null],
            ['nombre' => 'Investigador C-IYD-INV',                              'puesto_grupo_id' => 1, 'puesto_familia_id' => 2, 'puesto_subfamilia_id' => null],

            //Gestión Gubernamental
            ['nombre' => 'Analista de Autorización y Registro GG-AYR-ANAYR',                                     'puesto_grupo_id' => 2, 'puesto_familia_id' => 3, 'puesto_subfamilia_id' => null],
            ['nombre' => 'Asistente de Autorización y Registro GG-AYR-ASAYR',                                    'puesto_grupo_id' => 2, 'puesto_familia_id' => 3, 'puesto_subfamilia_id' => null],
            ['nombre' => 'Especialista de Autorización y Registro GG-AYR-ESPAYR',                                'puesto_grupo_id' => 2, 'puesto_familia_id' => 3, 'puesto_subfamilia_id' => null],
            ['nombre' => 'Analista de Control GG-CTRL-ANCTRL',                                                   'puesto_grupo_id' => 2, 'puesto_familia_id' => 4, 'puesto_subfamilia_id' => null],
            ['nombre' => 'Asistente de Control GG-CTRL-ASCTRL',                                                  'puesto_grupo_id' => 2, 'puesto_familia_id' => 4, 'puesto_subfamilia_id' => null],
            ['nombre' => 'Especialista de Control GG-CTRL-ESPCTRL',                                              'puesto_grupo_id' => 2, 'puesto_familia_id' => 4, 'puesto_subfamilia_id' => null],
            ['nombre' => 'Técnico de Control / Inspector / Verificador GG-CTRL-TECCTRL',                         'puesto_grupo_id' => 2, 'puesto_familia_id' => 4, 'puesto_subfamilia_id' => null],
            ['nombre' => 'Analista de Planificación e Implementación de Políticas Públicas GG-PIPP-APIPP',       'puesto_grupo_id' => 2, 'puesto_familia_id' => 5, 'puesto_subfamilia_id' => null],
            ['nombre' => 'Asistente de Planificación e Implementación de Políticas Públicas GG-PIPP-ASPIPP',     'puesto_grupo_id' => 2, 'puesto_familia_id' => 5, 'puesto_subfamilia_id' => null],
            ['nombre' => 'Especialista de Planificación e Implementación de Políticas Públicas GG-PIPP-ESPPIPP', 'puesto_grupo_id' => 2, 'puesto_familia_id' => 5, 'puesto_subfamilia_id' => null],
            ['nombre' => 'Analista de Regulación GG-REG-ANREG',                                                  'puesto_grupo_id' => 2, 'puesto_familia_id' => 6, 'puesto_subfamilia_id' => null],
            ['nombre' => 'Asistente de Regulación GG-REG-ASREG',                                                 'puesto_grupo_id' => 2, 'puesto_familia_id' => 6, 'puesto_subfamilia_id' => null],
            ['nombre' => 'Especialista de Regulación GG-REG-ESPREG',                                             'puesto_grupo_id' => 2, 'puesto_familia_id' => 6, 'puesto_subfamilia_id' => null],

            //Producción
            ['nombre' => 'Asistente de Producción P-ASPRO',  'puesto_grupo_id' => 3, 'puesto_familia_id' => null, 'puesto_subfamilia_id' => null],
            ['nombre' => 'Operario P-OPER',                  'puesto_grupo_id' => 3, 'puesto_familia_id' => null, 'puesto_subfamilia_id' => null],
            ['nombre' => 'Supervisor de Producción P-SUPRO', 'puesto_grupo_id' => 3, 'puesto_familia_id' => null, 'puesto_subfamilia_id' => null],

            //Servicios
            ['nombre' => 'Asistente de Conservación Patrimonial y Cultural S-ACPC-CPC-ASCPC', 'puesto_grupo_id' => 4, 'puesto_familia_id' => 7, 'puesto_subfamilia_id' => 1],
            ['nombre' => 'Conservador / Restaurador S-ACPC-CPC-CON',                          'puesto_grupo_id' => 4, 'puesto_familia_id' => 7, 'puesto_subfamilia_id' => 1],
            ['nombre' => 'Gestor de Colecciones S-ACPC-CPC-GCOL',                             'puesto_grupo_id' => 4, 'puesto_familia_id' => 7, 'puesto_subfamilia_id' => 1],
            ['nombre' => 'Asistente de Escenotecnia y Servicios Auxiliares S-ACPC-DYSA-ASE',  'puesto_grupo_id' => 4, 'puesto_familia_id' => 7, 'puesto_subfamilia_id' => 2],
            ['nombre' => 'Curador / Diseñador de Galerías y/o Exposiciones S-ACPC-DYSA-CUR',  'puesto_grupo_id' => 4, 'puesto_familia_id' => 7, 'puesto_subfamilia_id' => 2],
            ['nombre' => 'Diseñador Escenotécnico S-ACPC-DYSA-DE',                            'puesto_grupo_id' => 4, 'puesto_familia_id' => 7, 'puesto_subfamilia_id' => 2],
            ['nombre' => 'Técnico de Escenotecnia y Servicios Auxiliares S-ACPC-DYSA-TECE',   'puesto_grupo_id' => 4, 'puesto_familia_id' => 7, 'puesto_subfamilia_id' => 2],
            ['nombre' => 'Artista S-ACPC-EJA-ART',                                            'puesto_grupo_id' => 4, 'puesto_familia_id' => 7, 'puesto_subfamilia_id' => 3],
            ['nombre' => 'Analista de Asistencia Jurídica a la Ciudadanía S-AJC-ANAJC',  'puesto_grupo_id' => 4, 'puesto_familia_id' => 8, 'puesto_subfamilia_id' => null],
            ['nombre' => 'Asistente de Asistencia Jurídica a la Ciudadanía S-AJC-ASAJC', 'puesto_grupo_id' => 4, 'puesto_familia_id' => 8, 'puesto_subfamilia_id' => null],
            ['nombre' => 'Asistente de Salud S-SLD-ASSLD',     'puesto_grupo_id' => 4, 'puesto_familia_id' => 9, 'puesto_subfamilia_id' => null],
            ['nombre' => 'Profesional de Salud S-SLD-PROFSLD', 'puesto_grupo_id' => 4, 'puesto_familia_id' => 9, 'puesto_subfamilia_id' => null],
            ['nombre' => 'Técnico de Salud S-SLD-TECSLD',      'puesto_grupo_id' => 4, 'puesto_familia_id' => 9, 'puesto_subfamilia_id' => null],

            //Transversal
            ['nombre' => 'Analista de Compras y Contrataciones T-AP-CCO-ANCCO',   'puesto_grupo_id' => 5, 'puesto_familia_id' => 10, 'puesto_subfamilia_id' => 4],
            ['nombre' => 'Asistente de Compras y Contrataciones T-AP-CCO-ASCCO',  'puesto_grupo_id' => 5, 'puesto_familia_id' => 10, 'puesto_subfamilia_id' => 4],
            ['nombre' => 'Referente de Compras y Contrataciones T-AP-CCO-REFCCO', 'puesto_grupo_id' => 5, 'puesto_familia_id' => 10, 'puesto_subfamilia_id' => 4],
            ['nombre' => 'Analista de Contabilidad T-AP-CTB-ANCTB',               'puesto_grupo_id' => 5, 'puesto_familia_id' => 10, 'puesto_subfamilia_id' => 5],
            ['nombre' => 'Asistente de Contabilidad T-AP-CTB-ASCTB',              'puesto_grupo_id' => 5, 'puesto_familia_id' => 10, 'puesto_subfamilia_id' => 5],
            ['nombre' => 'Referente de Contabilidad T-AP-CTB-REFCTB',             'puesto_grupo_id' => 5, 'puesto_familia_id' => 10, 'puesto_subfamilia_id' => 5],
            ['nombre' => 'Analista de Presupuesto y Finanzas T-AP-PYF-ANPYF',     'puesto_grupo_id' => 5, 'puesto_familia_id' => 10, 'puesto_subfamilia_id' => 6],
            ['nombre' => 'Asistente de Presupuesto y Finanzas T-AP-PYF-ASPYF',    'puesto_grupo_id' => 5, 'puesto_familia_id' => 10, 'puesto_subfamilia_id' => 6],
            ['nombre' => 'Referente de Presupuesto y Finanzas T-AP-PYF-REFPYF',   'puesto_grupo_id' => 5, 'puesto_familia_id' => 10, 'puesto_subfamilia_id' => 6],
            ['nombre' => 'Analista de Tesorería T-AP-TES-ANTES',                  'puesto_grupo_id' => 5, 'puesto_familia_id' => 10, 'puesto_subfamilia_id' => 7],
            ['nombre' => 'Asistente de Tesorería T-AP-TES-ASTES',                 'puesto_grupo_id' => 5, 'puesto_familia_id' => 10, 'puesto_subfamilia_id' => 7],
            ['nombre' => 'Referente de Tesorería T-AP-TES-REFTES',                'puesto_grupo_id' => 5, 'puesto_familia_id' => 10, 'puesto_subfamilia_id' => 7],

            ['nombre' => 'Asesor Legal T-AJN-AL-ALEG',                            'puesto_grupo_id' => 5, 'puesto_familia_id' => 11, 'puesto_subfamilia_id' => 8],
            ['nombre' => 'Asistente de Asuntos Legales y Despacho T-AJN-AL-ASYD', 'puesto_grupo_id' => 5, 'puesto_familia_id' => 11, 'puesto_subfamilia_id' => 8],
            ['nombre' => 'Abogado Dictaminante T-AJN-CAE-ABDIC',                  'puesto_grupo_id' => 5, 'puesto_familia_id' => 11, 'puesto_subfamilia_id' => 9],
            ['nombre' => 'Abogado Litigante T-AJN-CAE-ABLIT',                     'puesto_grupo_id' => 5, 'puesto_familia_id' => 11, 'puesto_subfamilia_id' => 9],
            ['nombre' => 'Abogado Sumariante T-AJN-CAE-ABSUM',                    'puesto_grupo_id' => 5, 'puesto_familia_id' => 11, 'puesto_subfamilia_id' => 9],

            ['nombre' => 'Analista de Ceremonial y Protocolo T-COM-CYP-ANCYP',                   'puesto_grupo_id' => 5, 'puesto_familia_id' => 12, 'puesto_subfamilia_id' => 10],
            ['nombre' => 'Asistente de Ceremonial y Protocolo T-COM-CYP-ASCYP',                  'puesto_grupo_id' => 5, 'puesto_familia_id' => 12, 'puesto_subfamilia_id' => 10],
            ['nombre' => 'Locutor T-COM-CYP-LOC',                                                'puesto_grupo_id' => 5, 'puesto_familia_id' => 12, 'puesto_subfamilia_id' => 10],
            ['nombre' => 'Referente de Ceremonial y Protocolo T-COM-CYP-REFCYP',                 'puesto_grupo_id' => 5, 'puesto_familia_id' => 12, 'puesto_subfamilia_id' => 10],
            ['nombre' => 'Analista de Comunicación y Contenido Institucional T-COM-CCI-ANCOM',   'puesto_grupo_id' => 5, 'puesto_familia_id' => 12, 'puesto_subfamilia_id' => 11],
            ['nombre' => 'Asistente de Comunicación y Contenido Institucional T-COM-CCI-ASCOM',  'puesto_grupo_id' => 5, 'puesto_familia_id' => 12, 'puesto_subfamilia_id' => 11],
            ['nombre' => 'Diseñador de Comunicación y Contenido Institucional T-COM-CCI-DISCOM', 'puesto_grupo_id' => 5, 'puesto_familia_id' => 12, 'puesto_subfamilia_id' => 11],
            ['nombre' => 'Fotógrafo / Audiovisual T-COM-CCI-FOT',                                'puesto_grupo_id' => 5, 'puesto_familia_id' => 12, 'puesto_subfamilia_id' => 11],
            ['nombre' => 'Referente de Comunicación y Contenido Institucional T-COM-CCI-REFCOM', 'puesto_grupo_id' => 5, 'puesto_familia_id' => 12, 'puesto_subfamilia_id' => 11],

            ['nombre' => 'Analista de Control Interno T-CIN-AU-ANCI',       'puesto_grupo_id' => 5, 'puesto_familia_id' => 13, 'puesto_subfamilia_id' => 12],
            ['nombre' => 'Asistente de Control Interno T-CIN-AU-ASCI',      'puesto_grupo_id' => 5, 'puesto_familia_id' => 13, 'puesto_subfamilia_id' => 12],
            ['nombre' => 'Referente de Control Interno T-CIN-AU-REFCI',     'puesto_grupo_id' => 5, 'puesto_familia_id' => 13, 'puesto_subfamilia_id' => 12],
            ['nombre' => 'Analista de Gestión de Proyectos T-CIN-GP-ANGP',  'puesto_grupo_id' => 5, 'puesto_familia_id' => 13, 'puesto_subfamilia_id' => 13],
            ['nombre' => 'Asistente de Gestión de Proyectos T-CIN-GP-ASGP', 'puesto_grupo_id' => 5, 'puesto_familia_id' => 13, 'puesto_subfamilia_id' => 13],

            ['nombre' => 'Asistente de Mantenimiento T-MYS-MAN-ASMAN',        'puesto_grupo_id' => 5, 'puesto_familia_id' => 14, 'puesto_subfamilia_id' => 14],
            ['nombre' => 'Referente de Mantenimiento T-MYS-MAN-REFMAN',       'puesto_grupo_id' => 5, 'puesto_familia_id' => 14, 'puesto_subfamilia_id' => 14],
            ['nombre' => 'Asistente de Servicios Generales T-MYS-SER-ASSER',  'puesto_grupo_id' => 5, 'puesto_familia_id' => 14, 'puesto_subfamilia_id' => 15],
            ['nombre' => 'Chofer T-MYS-SER-CHO',                              'puesto_grupo_id' => 5, 'puesto_familia_id' => 14, 'puesto_subfamilia_id' => 15],
            ['nombre' => 'Cocinero T-MYS-SER-COC',                            'puesto_grupo_id' => 5, 'puesto_familia_id' => 14, 'puesto_subfamilia_id' => 15],
            ['nombre' => 'Referente de Servicios Generales T-MYS-SER-REFSER', 'puesto_grupo_id' => 5, 'puesto_familia_id' => 14, 'puesto_subfamilia_id' => 15],
            ['nombre' => 'Mozo / Camarero T-MYS-SER-MOZ',                     'puesto_grupo_id' => 5, 'puesto_familia_id' => 14, 'puesto_subfamilia_id' => 15],
            
            ['nombre' => 'Analista de Administración y Gestión de Personal T-RH-AGP-ANAGP',   'puesto_grupo_id' => 5, 'puesto_familia_id' => 15, 'puesto_subfamilia_id' => 16],
            ['nombre' => 'Asistente de Administración y Gestión de Personal T-RH-AGP-ASAGP',  'puesto_grupo_id' => 5, 'puesto_familia_id' => 15, 'puesto_subfamilia_id' => 16],
            ['nombre' => 'Referente de Administración y Gestión de Personal T-RH-AGP-REFAGP', 'puesto_grupo_id' => 5, 'puesto_familia_id' => 15, 'puesto_subfamilia_id' => 16],
            ['nombre' => 'Analista de Capacitación T-RH-CAR-ANCAP',                           'puesto_grupo_id' => 5, 'puesto_familia_id' => 15, 'puesto_subfamilia_id' => 17],
            ['nombre' => 'Analista de Desarrollo de Carrera T-RH-CAR-ANDES',                  'puesto_grupo_id' => 5, 'puesto_familia_id' => 15, 'puesto_subfamilia_id' => 17],
            ['nombre' => 'Asistente de Capacitación T-RH-CAR-ASCAP',                          'puesto_grupo_id' => 5, 'puesto_familia_id' => 15, 'puesto_subfamilia_id' => 17],
            ['nombre' => 'Asistente de Desarrollo de Carrera T-RH-CAR-ASDES',                 'puesto_grupo_id' => 5, 'puesto_familia_id' => 15, 'puesto_subfamilia_id' => 17],
            ['nombre' => 'Referente de Carrera T-RH-CAR-REFCAR',                              'puesto_grupo_id' => 5, 'puesto_familia_id' => 15, 'puesto_subfamilia_id' => 17],
            ['nombre' => 'Analista de Higiene y Seguridad T-RH-SSO-ANHYS',                    'puesto_grupo_id' => 5, 'puesto_familia_id' => 15, 'puesto_subfamilia_id' => 18],
            ['nombre' => 'Asistente de Higiene y Seguridad T-RH-SSO-ASHYS',                   'puesto_grupo_id' => 5, 'puesto_familia_id' => 15, 'puesto_subfamilia_id' => 18],
            ['nombre' => 'Bombero T-RH-SSO-BOMB',                                             'puesto_grupo_id' => 5, 'puesto_familia_id' => 15, 'puesto_subfamilia_id' => 18],
            ['nombre' => 'Cuidador de Primera Infancia T-RH-SSO-CUID',                        'puesto_grupo_id' => 5, 'puesto_familia_id' => 15, 'puesto_subfamilia_id' => 18],
            ['nombre' => 'Enfermero Laboral T-RH-SSO-EL',                                     'puesto_grupo_id' => 5, 'puesto_familia_id' => 15, 'puesto_subfamilia_id' => 18],
            ['nombre' => 'Médico Laboral T-RH-SSO-ML',                                        'puesto_grupo_id' => 5, 'puesto_familia_id' => 15, 'puesto_subfamilia_id' => 18],
            ['nombre' => 'Psicólogo Laboral T-RH-SSO-PL',                                     'puesto_grupo_id' => 5, 'puesto_familia_id' => 15, 'puesto_subfamilia_id' => 18],

            ['nombre' => 'Analista de Atención al Ciudadano T-SA-ATC-ANAT',    'puesto_grupo_id' => 5, 'puesto_familia_id' => 16, 'puesto_subfamilia_id' => 19],
            ['nombre' => 'Asistente de Atención al Ciudadano T-SA-ATC-ASAT',   'puesto_grupo_id' => 5, 'puesto_familia_id' => 16, 'puesto_subfamilia_id' => 19],
            ['nombre' => 'Guía / Guardián de Sala T-SA-ATC-GUI',               'puesto_grupo_id' => 5, 'puesto_familia_id' => 16, 'puesto_subfamilia_id' => 19],
            ['nombre' => 'Referente de Atención al Ciudadano T-SA-ATC-REFAT',  'puesto_grupo_id' => 5, 'puesto_familia_id' => 16, 'puesto_subfamilia_id' => 19],
            ['nombre' => 'Analista de Soporte Administrativo T-SA-SO-ANSOP',   'puesto_grupo_id' => 5, 'puesto_familia_id' => 16, 'puesto_subfamilia_id' => 20],
            ['nombre' => 'Asistente de Soporte Administrativo T-SA-SO-ASSOP',  'puesto_grupo_id' => 5, 'puesto_familia_id' => 16, 'puesto_subfamilia_id' => 20],
            ['nombre' => 'Bibliotecario / Archivista T-SA-SO-BIB',             'puesto_grupo_id' => 5, 'puesto_familia_id' => 16, 'puesto_subfamilia_id' => 20],
            ['nombre' => 'Referente de Soporte Administrativo T-SA-SO-REFSOP', 'puesto_grupo_id' => 5, 'puesto_familia_id' => 16, 'puesto_subfamilia_id' => 20],
            ['nombre' => 'Secretario T-SA-SO-SEC',                             'puesto_grupo_id' => 5, 'puesto_familia_id' => 16, 'puesto_subfamilia_id' => 20],

            ['nombre' => 'Analista Funcional T-TIC-AS-ANFUNC',                           'puesto_grupo_id' => 5, 'puesto_familia_id' => 17, 'puesto_subfamilia_id' => 21],
            ['nombre' => 'Arquitecto de Soluciones TIC T-TIC-AS-ARQSOL',                 'puesto_grupo_id' => 5, 'puesto_familia_id' => 17, 'puesto_subfamilia_id' => 21],
            ['nombre' => 'Analista de Datos T-TIC-DAT-ANDAT',                            'puesto_grupo_id' => 5, 'puesto_familia_id' => 17, 'puesto_subfamilia_id' => 22],
            ['nombre' => 'Especialista de Datos T-TIC-DAT-ESPDAT',                       'puesto_grupo_id' => 5, 'puesto_familia_id' => 17, 'puesto_subfamilia_id' => 22],
            ['nombre' => 'Asegurador de Calidad T-TIC-DES-ACAL',                         'puesto_grupo_id' => 5, 'puesto_familia_id' => 17, 'puesto_subfamilia_id' => 23],
            ['nombre' => 'Desarrollador T-TIC-DES-DES',                                  'puesto_grupo_id' => 5, 'puesto_familia_id' => 17, 'puesto_subfamilia_id' => 23],
            ['nombre' => 'Gestor de Proyectos de Desarrollo Informático T-TIC-DES-GPDI', 'puesto_grupo_id' => 5, 'puesto_familia_id' => 17, 'puesto_subfamilia_id' => 23],
            ['nombre' => 'Gestor de Aplicaciones de Soporte T-TIC-GA-GASOP',             'puesto_grupo_id' => 5, 'puesto_familia_id' => 17, 'puesto_subfamilia_id' => 24],
            ['nombre' => 'Gestor de Aplicaciones Específicas T-TIC-GA-GAESP',            'puesto_grupo_id' => 5, 'puesto_familia_id' => 17, 'puesto_subfamilia_id' => 24],
            ['nombre' => 'Administrador de Infraestructura T-TIC-GI-ADMINF',             'puesto_grupo_id' => 5, 'puesto_familia_id' => 17, 'puesto_subfamilia_id' => 25],
            ['nombre' => 'Administrador de Redes T-TIC-GI-ADMRED',                       'puesto_grupo_id' => 5, 'puesto_familia_id' => 17, 'puesto_subfamilia_id' => 25],
            ['nombre' => 'Administrador de Telecomunicaciones T-TIC-GI-ADMTEL',          'puesto_grupo_id' => 5, 'puesto_familia_id' => 17, 'puesto_subfamilia_id' => 25],
            ['nombre' => 'Referente de Infraestructura T-TIC-GI-REFINF',                 'puesto_grupo_id' => 5, 'puesto_familia_id' => 17, 'puesto_subfamilia_id' => 25],
            ['nombre' => 'Operador de Centro de Datos T-TIC-GO-OPCD',                    'puesto_grupo_id' => 5, 'puesto_familia_id' => 17, 'puesto_subfamilia_id' => 26],
            ['nombre' => 'Operador de Infraestructura T-TIC-GO-OPINF',                   'puesto_grupo_id' => 5, 'puesto_familia_id' => 17, 'puesto_subfamilia_id' => 26],
            ['nombre' => 'Referente de Operaciones T-TIC-GO-REFOP',                      'puesto_grupo_id' => 5, 'puesto_familia_id' => 17, 'puesto_subfamilia_id' => 26],
            ['nombre' => 'Analista de Implementaciones T-TIC-ISS-ANIMPL',                'puesto_grupo_id' => 5, 'puesto_familia_id' => 17, 'puesto_subfamilia_id' => 27],
            ['nombre' => 'Gestor de Proyectos de Implementación T-TIC-ISS-GPIMP',        'puesto_grupo_id' => 5, 'puesto_familia_id' => 17, 'puesto_subfamilia_id' => 27],
            ['nombre' => 'Mesa de Ayuda y Soporte a Usuarios T-TIC-ISS-MESA',            'puesto_grupo_id' => 5, 'puesto_familia_id' => 17, 'puesto_subfamilia_id' => 27],
            ['nombre' => 'Soporte Técnico Informático T-TIC-ISS-SOPTIC',                 'puesto_grupo_id' => 5, 'puesto_familia_id' => 17, 'puesto_subfamilia_id' => 27],
            ['nombre' => 'Analista de Ciberseguridad T-TIC-SEG-ANCIB',                   'puesto_grupo_id' => 5, 'puesto_familia_id' => 17, 'puesto_subfamilia_id' => 28],
            ['nombre' => 'Analista de Procesos y Normativas T-TIC-SEG-ANPYN',            'puesto_grupo_id' => 5, 'puesto_familia_id' => 17, 'puesto_subfamilia_id' => 28]
        ];

        foreach ($puestos_nomenclaturas as $puesto_nomenclatura) {
            PuestoNomenclatura::create($puesto_nomenclatura);
        }
    }
}
