<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAgenteAPIRequest;
use App\Http\Requests\API\UpdateAgenteAPIRequest;
use App\Models\Agente;
use App\Repositories\AgenteRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Traits\VerificationRol;
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
        $agentes = $this->agenteRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        if (!$this->verifiedPermissions('consultar-agentes')) {
            return $this->sendError('Usuario no autorizado');
        }

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
}