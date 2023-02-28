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

        return $this->sendResponse($agentes->toArray(), 'Agentes retrieved successfully');
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

        return $this->sendResponse($agente->toArray(), 'Agente saved successfully');
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

        return $this->sendResponse($agente->toArray(), 'Agente retrieved successfully');
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

        return $this->sendResponse($agente->toArray(), 'Agente updated successfully');
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

        return $this->sendSuccess('Agente deleted successfully');
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
        $arrayAgente = [];
        $values = $arry[0]->ToArray();

        foreach($values as $row){
            if($row['apellidos'] == null && $row['nombres'] == null){
                continue;
            }
            try {
                DB::beginTransaction();
                $agente['primer_apellido']                     =  ucwords(mb_strtolower($row['apellidos']));
                $agente['primer_nombre']                       =  ucwords(mb_strtolower($row['nombres']));
                $agente['cuil']                                =  $row['cuit'];
                $agente['fecha_nacimiento']                    =  $row['fecha_de_nacimiento'];
                $agente['fecha_ingreso_ministerio']            =  $row['fecha_firma_reso'];
                $agente['genero']                              =  mb_strtolower($row['genero']) == 'masculino' ? 'M':'F';

                /** @var Agente $agente */
                $agenteId = Agente::where('cuil','=',$row['cuit'])->first();

                if ($agenteId) {
                    $arrayAgente = $agente;
                    continue;
                }else{
                    $agenteF = $this->agenteRepository->create($agente);

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
                    $contrato->estado                              =  $row['estado'];
                    $contrato->baja_partir_de                      =  $row['si_es_baja_a_partir_de'];
                    $contrato->fecha_inicio_1109                   =  $row['fecha_de_ingreso_al_mdp_como_1109'];
                    $contrato->tipo_contrato_id                    =  2;
                    $contrato->ultimo_titulo                       =  ucwords(mb_strtolower($row['ultimo_titulo_obtenido']));

                    $contrato->save();
                }


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
            return $this->sendSuccess('Agentes deleted successfully');
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

        return $this->sendResponse($agente->toArray(), 'Agente saved successfully');
    }

}
