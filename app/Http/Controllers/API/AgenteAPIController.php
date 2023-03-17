<?php

namespace App\Http\Controllers\API;

use App\Exports\AgentsExport;
use App\Http\Requests\API\CreateAgenteAPIRequest;
use App\Http\Requests\API\UpdateAgenteAPIRequest;
use App\Models\Agente;
use App\Repositories\AgenteRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Imports\AgentsImport;
use App\Models\Contrato;
use App\Models\Profesion;
use App\Models\TipoContrato;
use App\Models\TipoTramite;
use App\Traits\VerificationRol;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PhpParser\Node\Stmt\TryCatch;
use Response;

/**
 * Class AgenteController
 * @package App\Http\Controllers\API
 */

class AgenteAPIController extends AppBaseController
{
    use VerificationRol;

    /** @var  AgenteRepository */
    private $agenteRepository;

    public function __construct(AgenteRepository $agenteRepo)
    {
        $this->agenteRepository = $agenteRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *      path="/api/agentes",
     *      summary="getAgenteList",
     *      tags={"Agente"},
     *      description="Get all Agentes",
     *      security={ {"sanctum": {} }},
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(ref="#/definitions/Agente")
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        if (!$this->verifiedPermissions('consultar-agentes')) {
            return $this->sendError('Usuario no autorizado');
        }

        $agentes = $this->agenteRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($agentes->toArray(), 'Listado de Agentes Exitoso');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="/api/agentes",
     *      summary="createAgente",
     *      tags={"Agente"},
     *      description="Create Agente",
     *      security={ {"sanctum": {} }},
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\MediaType(
     *            mediaType="application/x-www-form-urlencoded",
     *            @OA\Schema(
     *                type="object",
     *                required={""},
     *                @OA\Property(
     *                    property="name",
     *                    description="desc",
     *                    type="string"
     *                )
     *            )
     *        )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/definitions/Agente"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateAgenteAPIRequest $request)
    {
        if (!$this->verifiedPermissions('crear-agentes')) {
            return $this->sendError('Usuario no autorizado');
        }

        $input = $request->all();

        $agente = $this->agenteRepository->create($input);

        return $this->sendResponse($agente->toArray(), 'El agente ha sido creado con éxito.');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/api/agentes/{id}",
     *      summary="getAgenteItem",
     *      tags={"Agente"},
     *      description="Get Agente",
     *      security={ {"sanctum": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Agente",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/definitions/Agente"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        if (!$this->verifiedPermissions('consultar-agentes')) {
            return $this->sendError('Usuario no autorizado');
        }

        /** @var Agente $agente */
        $agente = $this->agenteRepository->find($id);

        if (empty($agente)) {
            return $this->sendError('Agente not found');
        }

        return $this->sendResponse($agente->toArray(), 'Agente recuperado con éxito');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @OA\Put(
     *      path="/api/agentes/{id}",
     *      summary="updateAgente",
     *      tags={"Agente"},
     *      description="Update Agente",
     *      security={ {"sanctum": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Agente",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\MediaType(
     *            mediaType="application/x-www-form-urlencoded",
     *            @OA\Schema(
     *                type="object",
     *                required={""},
     *                @OA\Property(
     *                    property="name",
     *                    description="desc",
     *                    type="string"
     *                )
     *            )
     *        )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/definitions/Agente"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateAgenteAPIRequest $request)
    {
        if (!$this->verifiedPermissions('editar-agentes')) {
            return $this->sendError('Usuario no autorizado');
        }

        $input = $request->all();

        /** @var Agente $agente */
        $agente = $this->agenteRepository->find($id);

        if (empty($agente)) {
            return $this->sendError('Agente not found');
        }

        $agente = $this->agenteRepository->update($input, $id);

        return $this->sendResponse($agente->toArray(), 'Agente actualizado con éxito');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/api/agentes/{id}",
     *      summary="deleteAgente",
     *      tags={"Agente"},
     *      description="Delete Agente",
     *      security={ {"sanctum": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Agente",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        if (!$this->verifiedPermissions('borrar-agentes')) {
            return $this->sendError('Usuario no autorizado');
        }

        /** @var Agente $agente */
        $agente = $this->agenteRepository->find($id);

        if (empty($agente)) {
            return $this->sendError('Agente not found');
        }

        $agente->delete();

        return $this->sendSuccess('Agente borrado con éxito');
    }

    public function export()
    {
        return Excel::download(new AgentsExport, 'agents.xlsx');
    
    }

    public function import(Request $request)
    {
        $file = $request->file('file');
        $arry = Excel::toCollection(new AgentsImport, $file);

        $contrato = [];
        $agente = [];
        $rows = $arry[0]->ToArray();

        foreach($rows as $row){
            if($row['apellidos'] == null && $row['nombres'] == null){
                continue;
            }
            try {
                DB::beginTransaction();
                /** @var Agente $agente */
                $agenteId = Agente::where('cuil','=',$row['cuit'])->first();
                $tipoTramite = TipoTramite::where('nombre','=',ucwords(mb_strtolower($row['tipo_de_tramite'])))->first();

                if (empty($tipoTramite)) {
                    $tipoTramite = TipoTramite::create(['nombre' => ucwords(mb_strtolower($row['tipo_de_tramite']))]);
                }

                if (empty($agenteId)) {
                    $agente['primer_apellido']                     =  ucwords(mb_strtolower($row['apellidos']));
                    $agente['primer_nombre']                       =  ucwords(mb_strtolower($row['nombres']));
                    $agente['cuil']                                =  $row['cuit'];
                    $agente['fecha_nacimiento']                    =  $row['fecha_de_nacimiento'];
                    $agente['fecha_ingreso_ministerio']            =  $row['fecha_firma_reso'];
                    $agente['genero']                              =  mb_strtolower($row['genero']) == 'masculino' ? 'M':'F';
                    $agenteF = $this->agenteRepository->create($agente);
                }

                    $contrato = New Contrato;
                    $contrato->agente_id                           =  $agenteF->id;
                    $contrato->secretaria                          =  ucwords(mb_strtolower($row['secretaria']));
                    $contrato->subsecretaria                       =  ucwords(mb_strtolower($row['subsecretaria']));
                    $contrato->dependencia                         =  ucwords(mb_strtolower($row['dependencia']));
                    $contrato->funcion                             =  ucwords(mb_strtolower($row['funcion']));
                    $contrato->nivel_funcion                       =  $row['nivel'];
                    $contrato->unidades_retributivas_mensuales     =  $row['cantidad_de_ur'];
                    $contrato->fecha_inicio                        =  $row['fecha_de_inicio'];
                    $contrato->fecha_finalizacion                  =  $row['fecha_de_finalizacion'];
                    $contrato->unidades_retributivas_totales       =  $row['cantidad_total_de_ur'];
                    $contrato->partida                             =  $row['part'];
                    $contrato->programa                            =  $row['prog'];
                    $contrato->actividad                           =  $row['act'];
                    $contrato->dedicacion_funcional                =  $row['ded_funcional'];
                    $contrato->resolucion_larga                    =  $row['reso_de_aprobacion_largo'];
                    $contrato->resolucion_corta                    =  $row['reso_de_aprobacion_corto'];
                    $contrato->numero_anexo                        =  $row['anexo_de_aprobacion'];
                    $contrato->numero_expediente_gde               =  $row['expediente_tramitacion'];
                    $contrato->numero_loys                         =  $row['expediente_loys'];
                    $contrato->loys_da_488                         =  $row['loys_da_488'];
                    $contrato->loys_de_986                         =  $row['loys_de_986'];
                    $contrato->ultimo_termino_referencia           =  $row['ultimo_termino_de_referencia'];
                    $contrato->acto_habilitacion_sarha             =  $row['acto_habilitacion_sarha'];
                    $contrato->fecha_firma_recepcion_expediente    =  $row['fecha_ingreso_expediente'];
                    $contrato->fecha_firma_resolucion              =  $row['fecha_firma_reso'];
                    $contrato->tipo_alta                           =  mb_strtolower($row['tipo_de_tramite']);
                    $contrato->tipo_tramite_id                     =  $tipoTramite->id;
                    $contrato->estado                              =  $row['estado'];
                    $contrato->baja_partir_de                      =  $row['si_es_baja_a_partir_de'];
                    $contrato->fecha_inicio_1109                   =  $row['fecha_de_ingreso_al_mdp_como_1109'];
                    $contrato->tipo_contrato_id                    =  2;
                    $contrato->ultimo_titulo                       =  ucwords(mb_strtolower($row['ultimo_titulo_obtenido']));
                    $contrato->save();

                DB::commit();
            } catch (\Exception $th) {
                DB::rollBack();
                throw $th;
            }
        }
        return $this->sendSuccess('Agente Import saved successfully');
    }

    public function manyDelete(Request $request){
        foreach ($request->all() as $key => $value){
            $agente = $this->agenteRepository->find($value);

            if (empty($agente)) {
                continue;
            }
            $agente->delete();
        }
        //$agentes = $this->agenteRepository->all();
        //if (empty($agentes->whereIn('id',$request->all()))) {
            return $this->sendSuccess('Agentes borrados con éxito');
        //}
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="/api/contrato-1109",
     *      summary="Create Agente and Contract 1109",
     *      tags={"Agente"},
     *      description="Create Contrato 1109",
     *      security={ {"sanctum": {} }},
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\MediaType(
     *            mediaType="application/x-www-form-urlencoded",
     *            @OA\Schema(
     *                type="object",
     *                required={""},
     *                @OA\Property(
     *                    property="name",
     *                    description="desc",
     *                    type="string"
     *                )
     *            )
     *        )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/definitions/Agente"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function createContract(Request $request)
    {

        if (!$this->verifiedPermissions('crear-agentes')) {
            return $this->sendError('Usuario no autorizado');
        }

        $input = $request->all();

        $agente = $this->agenteRepository->create1109($input);

        return $this->sendResponse($agente->toArray(), 'Agente con contrato 1109 creado con éxito');
    }

    public function importTamesis(Request $request)
    {
        $file = $request->file('file');
        $arry = Excel::toCollection(new AgentsImport, $file);

        $contrato = [];
        $agente = [];
        $rows = $arry[0]->ToArray();

        foreach($rows as $row){
            try {
                DB::beginTransaction();
                
                $agenteId       = Agente::where('cuil','=',$row['cuil'])->first();
                $profesion      = Profesion::where('nombre','=',$row['profesion'])->first();
                $tipo           = ucwords(mb_strtolower($row['tipocontra'])) == 'Decr. 1184/01' ? 'Ley Marco Articulo 9' : ucwords(mb_strtolower($row['tipocontra']));
                $tipoContrato   = TipoContrato::where('nombre','=',$tipo)->first();

                if (empty($agenteId)) {
                    $agente['primer_apellido']          = ucwords(mb_strtolower($row['apellido']));
                    $agente['primer_nombre']            = ucwords(mb_strtolower($row['nombre']));
                    $agente['email']                    = ucwords(mb_strtolower($row['email1']));
                    $agente['cuil']                     = $row['cuil'];
                    $agente['dni']                      = $row['numdoc'];
                    $agente['fecha_nacimiento']         = $row['fenac'];
                    $agente['estado_civil']             = ucwords(mb_strtolower($row['estadoci']));
                    $agente['domi']                     = ucwords(mb_strtolower($row['domi']));
                    $agente['cpos']                     = ucwords(mb_strtolower($row['cpos']));
                    $agente['loc_id']                   = $row['id_loc'];
                    $agente['loc_descripcion']          = ucwords(mb_strtolower($row['loc_descripcion']));
                    $agente['prov_id']                  = $row['id_prov'];
                    $agente['prv_descripcion']          = ucwords(mb_strtolower($row['prv_descripcion']));
                    $agente['telefono']                 = $row['telefono'];
                    $agenteId = $this->agenteRepository->create($agente);
                }

                if (empty($tipoContrato)) {

                        $tipoContratoRequest = array(
                            'Birf (4212-ar)' => 'Birf (4212-ar)' ,
                            'Birf-otf (22013)' => 'Birf-otf (22013)',
                            'Circular Pnud' => 'Circular Pnud',
                            'Pnud Arg 08/001' => 'Pnud Arg 08/001',
                            'Pnud 08/024' => 'Pnud 08/024',
                            'Bid (1884/oc-ar)' => 'Bid (1884/oc-ar)',
                            'Circular Pnud - 2010' => 'Circular Pnud - 2010'
                        );

                    if (array_key_exists(ucwords(mb_strtolower($row['tipocontra'])), $tipoContratoRequest)) {
                        $tipoContrato = TipoContrato::where('nombre','=','Contratos por convenios con Programas y Proyectos con Financiamiento Internacional: PNUD - BID - BIRF')->first();
                    }elseif(ucwords(mb_strtolower($row['tipocontra'])) === 'Decr. 1184/01'){
                        $tipoContrato = TipoContrato::create(['nombre' => 'Ley Marco Articulo 9']);
                    }elseif(ucwords(mb_strtolower($row['tipocontra'])) === 'Decr. 2345/08'){
                        $tipoContrato = TipoContrato::create(['nombre' => 'Decr. 2345/08']);
                    }else{
                        $tipoContrato = TipoContrato::create(['nombre' => 'Ley 25.164']);
                    }
                }

                if (empty($profesion)) {
                    $profesion = Profesion::create(['nombre' => ucwords(mb_strtolower($row['profesion']))]);
                }

                $contrato = New Contrato;
                $contrato->agente_id                       = $agenteId->id;
                $contrato->secretaria_id                   = $row['idsecretaria'];
                $contrato->secretaria                      = ucwords(mb_strtolower($row['secretaria']));
                $contrato->centralizado                    = $row['centralizado'];
                $contrato->descentralizado                 = $row['descentralizado'];
                $contrato->ente_liquidacion                = $row['ente_liquidacion'];
                $contrato->fevig                           = $row['fevig'];
                $contrato->febaja                          = $row['febaja'];
                $contrato->felimita                        = $row['felimita'];
                $contrato->nivel                           = $row['nivel'];
                $contrato->rango                           = $row['rango'];
                $contrato->actividad                       = $row['actividad'];
                $contrato->programa_id                     = $row['idprograma'];
                $contrato->programa                        = ucwords(mb_strtolower($row['programa']));
                $contrato->inciso                          = $row['inciso'];
                $contrato->ppal                            = $row['ppal'];
                $contrato->parc                            = $row['parc'];
                $contrato->jurisdi                         = $row['jurisdi'];
                $contrato->fuente                          = $row['fuente'];
                $contrato->p_numero                        = $row['p_numero'];
                $contrato->obra                            = $row['obra'];
                $contrato->ubic_geo                        = $row['ubic_geo'];
                $contrato->imbruto                         = $row['imbruto'];
                $contrato->importe_682                     = $row['importe_682'];
                $contrato->decr_1993                       = $row['decr1993'];
                $contrato->impotot_92                      = $row['impotot92'];
                $contrato->partime                         = $row['partime'];
                $contrato->firmante                        = $row['firmante'];
                $contrato->edificio                        = $row['edificio'];
                $contrato->oficina                         = $row['oficina'];
                $contrato->interno                         = $row['interno'];
                $contrato->tipo_contrato_id                = $tipoContrato->id;
                $contrato->saf                             = $row['saf'];
                $contrato->codigo_act                      = $row['codigo_act'];
                $contrato->desc_act                        = ucwords(mb_strtolower($row['desc_act']));
                $contrato->observacion                     = $row['observacion'];
                $contrato->id_padre                        = $row['id_padre'];
                $contrato->primera_fecha_contratacion      = $row['primera_fecha_contratacion'];
                $contrato->primer_fecha_tamesis            = $row['primer_fecha_tamesis'];
                $contrato->primer_modalidad_tamesis        = $row['primer_modalidad_tamesis'];
                $contrato->nivel_educativo                 = ucwords(mb_strtolower($row['niveduc']));
                $contrato->estado_estudio                  = $row['estado_estudio'];
                $contrato->profesion                       = $profesion->id;
                $contrato->act_tipo                        = $row['act_tipo'];
                $contrato->act_numero1                     = $row['act_numero1'];
                $contrato->act_fecha1                      = $row['act_fecha1'];
                $contrato->act_numero2                     = $row['act_numero2'];
                $contrato->act_fecha2                      = $row['act_fecha2'];
                $contrato->funcion                         = ucwords(mb_strtolower($row['funcion']));
                $contrato->tipo_tanda_id                   = $row['id_tipotanda'];
                $contrato->tipo_tanda                      = ucwords(mb_strtolower($row['tipotanda']));
                $contrato->ap_excepcion                    = $row['ap_excepcion'];
                $contrato->ap_cambio_nivel                 = $row['ap_cambio_nivel'];
                $contrato->objetivos1                      = $row['objetivos1'];
                $contrato->objetivos2                      = $row['objetivos2'];
                $contrato->objetivos3                      = $row['objetivos3'];
                $contrato->objetivos4                      = $row['objetivos4'];
                $contrato->objetivos5                      = $row['objetivos5'];
                $contrato->objetivos6                      = $row['objetivos6'];
                $contrato->objetivos7                      = $row['objetivos7'];
                $contrato->objetivos8                      = $row['objetivos8'];
                $contrato->objetivos9                      = $row['objetivos9'];
                $contrato->objetivos10                     = $row['objetivos10'];
                $contrato->codigo_proa                     = $row['codigo_proa'];
                $contrato->compensacion_transitoria        = $row['compensacion_transitoria'];
                $contrato->primer_fecha_ley_marco          = $row['primer_fecha_ley_marco'];
                $contrato->save();

                DB::commit();
            } catch (\Exception $th) {
                DB::rollBack();
                throw $th;
            }
        }
        return $this->sendSuccess('Agente Import Tamesis saved successfully');
    }
}
