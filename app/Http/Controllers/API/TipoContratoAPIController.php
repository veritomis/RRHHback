<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTipoContratoAPIRequest;
use App\Http\Requests\API\UpdateTipoContratoAPIRequest;
use App\Models\TipoContrato;
use App\Repositories\TipoContratoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Traits\VerificationRol;
use Response;

/**
 * Class TipoContratoController
 * @package App\Http\Controllers\API
 */

class TipoContratoAPIController extends AppBaseController
{
    use VerificationRol;
    
    /** @var  TipoContratoRepository */
    private $tipoContratoRepository;

    public function __construct(TipoContratoRepository $tipoContratoRepo)
    {
        $this->tipoContratoRepository = $tipoContratoRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *      path="/tipo-contratos",
     *      summary="getTipoContratoList",
     *      tags={"Tipo Contrato"},
     *      description="Get all TipoContratos",
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
     *                  @OA\Items(ref="#/definitions/TipoContrato")
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
        if (!$this->verifiedPermissions('consultar-tipo-contratos')) {
            return $this->sendError('Usuario no autorizado');
        }
        
        $tipoContratos = $this->tipoContratoRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($tipoContratos->toArray(), 'Tipo Contratos retrieved successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="/tipo-contratos",
     *      summary="createTipoContrato",
     *      tags={"Tipo Contrato"},
     *      description="Create TipoContrato",
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
     *                  ref="#/definitions/TipoContrato"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateTipoContratoAPIRequest $request)
    {
        if (!$this->verifiedPermissions('crear-tipo-contratos')) {
            return $this->sendError('Usuario no autorizado');
        }

        $input = $request->all();

        $tipoContrato = $this->tipoContratoRepository->create($input);

        return $this->sendResponse($tipoContrato->toArray(), 'Tipo Contrato saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/tipo-contratos/{id}",
     *      summary="getTipoContratoItem",
     *      tags={"Tipo Contrato"},
     *      description="Get TipoContrato",
     *      security={ {"sanctum": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="id of TipoContrato",
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
     *                  ref="#/definitions/TipoContrato"
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
        if (!$this->verifiedPermissions('consultar-tipo-contratos')) {
            return $this->sendError('Usuario no autorizado');
        }

        /** @var TipoContrato $tipoContrato */
        $tipoContrato = $this->tipoContratoRepository->find($id);

        if (empty($tipoContrato)) {
            return $this->sendError('Tipo Contrato not found');
        }

        return $this->sendResponse($tipoContrato->toArray(), 'Tipo Contrato retrieved successfully');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @OA\Put(
     *      path="/tipo-contratos/{id}",
     *      summary="updateTipoContrato",
     *      tags={"Tipo Contrato"},
     *      description="Update TipoContrato",
     *      security={ {"sanctum": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="id of TipoContrato",
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
     *                  ref="#/definitions/TipoContrato"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateTipoContratoAPIRequest $request)
    {
        if (!$this->verifiedPermissions('editar-tipo-contratos')) {
            return $this->sendError('Usuario no autorizado');
        }

        $input = $request->all();

        /** @var TipoContrato $tipoContrato */
        $tipoContrato = $this->tipoContratoRepository->find($id);

        if (empty($tipoContrato)) {
            return $this->sendError('Tipo Contrato not found');
        }

        $tipoContrato = $this->tipoContratoRepository->update($input, $id);

        return $this->sendResponse($tipoContrato->toArray(), 'TipoContrato updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/tipo-contratos/{id}",
     *      summary="deleteTipoContrato",
     *      tags={"Tipo Contrato"},
     *      description="Delete TipoContrato",
     *      security={ {"sanctum": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="id of TipoContrato",
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
        if (!$this->verifiedPermissions('borrar-tipo-contratos')) {
            return $this->sendError('Usuario no autorizado');
        }

        /** @var TipoContrato $tipoContrato */
        $tipoContrato = $this->tipoContratoRepository->find($id);

        if (empty($tipoContrato)) {
            return $this->sendError('Tipo Contrato not found');
        }

        $tipoContrato->delete();

        return $this->sendSuccess('Tipo Contrato deleted successfully');
    }
}
