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
use App\Traits\VerificationRol;
use Maatwebsite\Excel\Facades\Excel;
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

    public function export(){
        return Excel::download(new AgentsExport, 'agents.xlsx');
    
    }

    public function import(){
        return Excel::upload(new AgentsImport, 'agents.xlsx');
    
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
