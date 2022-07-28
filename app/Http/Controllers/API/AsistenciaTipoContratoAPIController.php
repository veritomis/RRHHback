<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAsistenciaTipoContratoAPIRequest;
use App\Http\Requests\API\UpdateAsistenciaTipoContratoAPIRequest;
use App\Models\AsistenciaTipoContrato;
use App\Repositories\AsistenciaTipoContratoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class AsistenciaTipoContratoController
 * @package App\Http\Controllers\API
 */

class AsistenciaTipoContratoAPIController extends AppBaseController
{
    /** @var  AsistenciaTipoContratoRepository */
    private $asistenciaTipoContratoRepository;

    public function __construct(AsistenciaTipoContratoRepository $asistenciaTipoContratoRepo)
    {
        $this->asistenciaTipoContratoRepository = $asistenciaTipoContratoRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *      path="/api/asistencia-tipo-contratos",
     *      summary="getAsistenciaTipoContratoList",
     *      tags={"Asistencia Tipo Contrato"},
     *      description="Get all AsistenciaTipoContratos",
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
     *                  @OA\Items(ref="#/definitions/AsistenciaTipoContrato")
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
        $asistenciaTipoContratos = $this->asistenciaTipoContratoRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($asistenciaTipoContratos->toArray(), 'Asistencia Tipo Contratos retrieved successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="/api/asistencia-tipo-contratos",
     *      summary="createAsistenciaTipoContrato",
     *      tags={"Asistencia Tipo Contrato"},
     *      description="Create AsistenciaTipoContrato",
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
     *                  ref="#/definitions/AsistenciaTipoContrato"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateAsistenciaTipoContratoAPIRequest $request)
    {
        $input = $request->all();

        $asistenciaTipoContrato = $this->asistenciaTipoContratoRepository->create($input);

        return $this->sendResponse($asistenciaTipoContrato->toArray(), 'Asistencia Tipo Contrato saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/api/asistencia-tipo-contratos/{id}",
     *      summary="getAsistenciaTipoContratoItem",
     *      tags={"Asistencia Tipo Contrato"},
     *      description="Get AsistenciaTipoContrato",
     *      security={ {"sanctum": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="id of AsistenciaTipoContrato",
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
     *                  ref="#/definitions/AsistenciaTipoContrato"
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
        /** @var AsistenciaTipoContrato $asistenciaTipoContrato */
        $asistenciaTipoContrato = $this->asistenciaTipoContratoRepository->find($id);

        if (empty($asistenciaTipoContrato)) {
            return $this->sendError('Asistencia Tipo Contrato not found');
        }

        return $this->sendResponse($asistenciaTipoContrato->toArray(), 'Asistencia Tipo Contrato retrieved successfully');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @OA\Put(
     *      path="/api/asistencia-tipo-contratos/{id}",
     *      summary="updateAsistenciaTipoContrato",
     *      tags={"Asistencia Tipo Contrato"},
     *      description="Update AsistenciaTipoContrato",
     *      security={ {"sanctum": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="id of AsistenciaTipoContrato",
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
     *                  ref="#/definitions/AsistenciaTipoContrato"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateAsistenciaTipoContratoAPIRequest $request)
    {
        $input = $request->all();

        /** @var AsistenciaTipoContrato $asistenciaTipoContrato */
        $asistenciaTipoContrato = $this->asistenciaTipoContratoRepository->find($id);

        if (empty($asistenciaTipoContrato)) {
            return $this->sendError('Asistencia Tipo Contrato not found');
        }

        $asistenciaTipoContrato = $this->asistenciaTipoContratoRepository->update($input, $id);

        return $this->sendResponse($asistenciaTipoContrato->toArray(), 'AsistenciaTipoContrato updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/api/asistencia-tipo-contratos/{id}",
     *      summary="deleteAsistenciaTipoContrato",
     *      tags={"Asistencia Tipo Contrato"},
     *      description="Delete AsistenciaTipoContrato",
     *      security={ {"sanctum": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="id of AsistenciaTipoContrato",
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
        /** @var AsistenciaTipoContrato $asistenciaTipoContrato */
        $asistenciaTipoContrato = $this->asistenciaTipoContratoRepository->find($id);

        if (empty($asistenciaTipoContrato)) {
            return $this->sendError('Asistencia Tipo Contrato not found');
        }

        $asistenciaTipoContrato->delete();

        return $this->sendSuccess('Asistencia Tipo Contrato deleted successfully');
    }
}
