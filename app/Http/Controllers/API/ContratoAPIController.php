<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateContratoAPIRequest;
use App\Http\Requests\API\UpdateContratoAPIRequest;
use App\Models\Contrato;
use App\Repositories\ContratoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Traits\VerificationRol;
use Response;

/**
 * Class ContratoController
 * @package App\Http\Controllers\API
 */

class ContratoAPIController extends AppBaseController
{
    use VerificationRol;

    /** @var  ContratoRepository */
    private $contratoRepository;

    public function __construct(ContratoRepository $contratoRepo)
    {
        $this->contratoRepository = $contratoRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *      path="/api/contratos",
     *      summary="getContratoList",
     *      tags={"Contrato"},
     *      description="Get all Contratos",
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
     *                  @OA\Items(ref="#/definitions/Contrato")
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
        $contratos = $this->contratoRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        if (!$this->verifiedPermissions('consultar-contratos')) {
            return $this->sendError('Usuario no autorizado');
        }

        return $this->sendResponse($contratos->toArray(), 'Contratos retrieved successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="/api/contratos",
     *      summary="createContrato",
     *      tags={"Contrato"},
     *      description="Create Contrato",
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
     *                  ref="#/definitions/Contrato"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateContratoAPIRequest $request)
    {
        if (!$this->verifiedPermissions('crear-contratos')) {
            return $this->sendError('Usuario no autorizado');
        }

        $input = $request->all();

        $contrato = $this->contratoRepository->create($input);

        return $this->sendResponse($contrato->toArray(), 'Contrato saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/api/contratos/{id}",
     *      summary="getContratoItem",
     *      tags={"Contrato"},
     *      description="Get Contrato",
     *      security={ {"sanctum": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Contrato",
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
     *                  ref="#/definitions/Contrato"
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
        if (!$this->verifiedPermissions('consultar-contratos')) {
            return $this->sendError('Usuario no autorizado');
        }
        
        /** @var Contrato $contrato */
        $contrato = $this->contratoRepository->find($id);

        if (empty($contrato)) {
            return $this->sendError('Contrato not found');
        }

        return $this->sendResponse($contrato->toArray(), 'Contrato retrieved successfully');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @OA\Put(
     *      path="/api/contratos/{id}",
     *      summary="updateContrato",
     *      tags={"Contrato"},
     *      description="Update Contrato",
     *      security={ {"sanctum": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Contrato",
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
     *                  ref="#/definitions/Contrato"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateContratoAPIRequest $request)
    {
        if (!$this->verifiedPermissions('editar-contratos')) {
            return $this->sendError('Usuario no autorizado');
        }

        $input = $request->all();

        /** @var Contrato $contrato */
        $contrato = $this->contratoRepository->find($id);

        if (empty($contrato)) {
            return $this->sendError('Contrato not found');
        }

        $contrato = $this->contratoRepository->update($input, $id);

        return $this->sendResponse($contrato->toArray(), 'Contrato updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/api/contratos/{id}",
     *      summary="deleteContrato",
     *      tags={"Contrato"},
     *      description="Delete Contrato",
     *      security={ {"sanctum": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Contrato",
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
        if (!$this->verifiedPermissions('borrar-contratos')) {
            return $this->sendError('Usuario no autorizado');
        }

        /** @var Contrato $contrato */
        $contrato = $this->contratoRepository->find($id);

        if (empty($contrato)) {
            return $this->sendError('Contrato not found');
        }

        $contrato->delete();

        return $this->sendSuccess('Contrato deleted successfully');
    }
}
