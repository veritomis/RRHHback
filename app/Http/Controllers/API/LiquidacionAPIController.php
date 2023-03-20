<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateLiquidacionAPIRequest;
use App\Http\Requests\API\UpdateLiquidacionAPIRequest;
use App\Models\Liquidacion;
use App\Repositories\LiquidacionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Traits\VerificationRol;
use Response;

/**
 * Class LiquidacionController
 * @package App\Http\Controllers\API
 */

class LiquidacionAPIController extends AppBaseController
{
    use VerificationRol;

    /** @var  LiquidacionRepository */
    private $liquidacionRepository;

    public function __construct(LiquidacionRepository $liquidacionRepo)
    {
        $this->liquidacionRepository = $liquidacionRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *      path="/api/liquidaciones",
     *      summary="getLiquidacionList",
     *      tags={"Liquidacion"},
     *      security={ {"sanctum": {} }},
     *      description="Get all Liquidacions",
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
     *                  @OA\Items(ref="#/definitions/Liquidacion")
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

        if (!$this->verifiedPermissions('consultar-liquidaciones')) {
            return $this->sendError('Usuario no autorizado');
        }

        $liquidacions = $this->liquidacionRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($liquidacions->toArray(), 'Listado de liquidaciones exitoso');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="/api/liquidaciones",
     *      summary="createLiquidacion",
     *      tags={"Liquidacion"},
     *      security={ {"sanctum": {} }},
     *      description="Create Liquidacion",
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
     *                  ref="#/definitions/Liquidacion"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateLiquidacionAPIRequest $request)
    {
        if (!$this->verifiedPermissions('crear-liquidaciones')) {
            return $this->sendError('Usuario no autorizado');
        }

        $input = $request->all();

        $liquidacion = $this->liquidacionRepository->create($input);

        return $this->sendResponse($liquidacion->toArray(), 'Liquidación creada con éxito');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/api/liquidaciones/{id}",
     *      summary="getLiquidacionItem",
     *      tags={"Liquidacion"},
     *      security={ {"sanctum": {} }},
     *      description="Get Liquidacion",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Liquidacion",
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
     *                  ref="#/definitions/Liquidacion"
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
        if (!$this->verifiedPermissions('consultar-liquidaciones')) {
            return $this->sendError('Usuario no autorizado');
        }

        /** @var Liquidacion $liquidacion */
        $liquidacion = $this->liquidacionRepository->find($id);

        if (empty($liquidacion)) {
            return $this->sendError('Liquidación no encontrada');
        }

        return $this->sendResponse($liquidacion->toArray(), 'Liquidación recuperada con éxito');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @OA\Put(
     *      path="/api/liquidaciones/{id}",
     *      summary="updateLiquidacion",
     *      tags={"Liquidacion"},
     *      security={ {"sanctum": {} }},
     *      description="Update Liquidacion",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Liquidacion",
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
     *                  ref="#/definitions/Liquidacion"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateLiquidacionAPIRequest $request)
    {
        if (!$this->verifiedPermissions('editar-liquidaciones')) {
            return $this->sendError('Usuario no autorizado');
        }

        $input = $request->all();

        /** @var Liquidacion $liquidacion */
        $liquidacion = $this->liquidacionRepository->find($id);

        if (empty($liquidacion)) {
            return $this->sendError('Liquidación no encontrada');
        }

        $liquidacion = $this->liquidacionRepository->update($input, $id);

        return $this->sendResponse($liquidacion->toArray(), 'Liquidación actualizada con éxito');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/api/liquidaciones/{id}",
     *      summary="deleteLiquidacion",
     *      tags={"Liquidacion"},
     *      security={ {"sanctum": {} }},
     *      description="Delete Liquidacion",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Liquidacion",
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
        if (!$this->verifiedPermissions('borrar-liquidaciones')) {
            return $this->sendError('Usuario no autorizado');
        }

        /** @var Liquidacion $liquidacion */
        $liquidacion = $this->liquidacionRepository->find($id);

        if (empty($liquidacion)) {
            return $this->sendError('Liquidación no encontrada');
        }

        $liquidacion->delete();

        return $this->sendSuccess('Liquidación borrada con éxito');
    }
}
