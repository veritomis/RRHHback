<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePuestoNomenclaturaAPIRequest;
use App\Http\Requests\API\UpdatePuestoNomenclaturaAPIRequest;
use App\Models\PuestoNomenclatura;
use App\Repositories\PuestoNomenclaturaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class PuestoNomenclaturaController
 * @package App\Http\Controllers\API
 */

class PuestoNomenclaturaAPIController extends AppBaseController
{
    /** @var  PuestoNomenclaturaRepository */
    private $puestoNomenclaturaRepository;

    public function __construct(PuestoNomenclaturaRepository $puestoNomenclaturaRepo)
    {
        $this->puestoNomenclaturaRepository = $puestoNomenclaturaRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *      path="/api/puesto-nomenclaturas",
     *      summary="getPuestoNomenclaturaList",
     *      tags={"Puesto Nomenclaturas"},
     *      description="Get all PuestoNomenclaturas",
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
     *                  @OA\Items(ref="#/definitions/PuestoNomenclatura")
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
        $puestoNomenclaturas = $this->puestoNomenclaturaRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($puestoNomenclaturas->toArray(), 'Puesto Nomenclaturas retrieved successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="/api/puesto-nomenclaturas",
     *      summary="createPuestoNomenclatura",
     *      tags={"Puesto Nomenclaturas"},
     *      description="Create PuestoNomenclatura",
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
     *                  ref="#/definitions/PuestoNomenclatura"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePuestoNomenclaturaAPIRequest $request)
    {
        $input = $request->all();

        $puestoNomenclatura = $this->puestoNomenclaturaRepository->create($input);

        return $this->sendResponse($puestoNomenclatura->toArray(), 'Puesto Nomenclatura saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/api/puesto-nomenclaturas/{id}",
     *      summary="getPuestoNomenclaturaItem",
     *      tags={"Puesto Nomenclaturas"},
     *      description="Get PuestoNomenclatura",
     *      security={ {"sanctum": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="id of PuestoNomenclatura",
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
     *                  ref="#/definitions/PuestoNomenclatura"
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
        /** @var PuestoNomenclatura $puestoNomenclatura */
        $puestoNomenclatura = $this->puestoNomenclaturaRepository->find($id);

        if (empty($puestoNomenclatura)) {
            return $this->sendError('Puesto Nomenclatura not found');
        }

        return $this->sendResponse($puestoNomenclatura->toArray(), 'Puesto Nomenclatura retrieved successfully');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @OA\Put(
     *      path="/api/puesto-nomenclaturas/{id}",
     *      summary="updatePuestoNomenclatura",
     *      tags={"Puesto Nomenclaturas"},
     *      description="Update PuestoNomenclatura",
     *      security={ {"sanctum": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="id of PuestoNomenclatura",
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
     *                  ref="#/definitions/PuestoNomenclatura"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePuestoNomenclaturaAPIRequest $request)
    {
        $input = $request->all();

        /** @var PuestoNomenclatura $puestoNomenclatura */
        $puestoNomenclatura = $this->puestoNomenclaturaRepository->find($id);

        if (empty($puestoNomenclatura)) {
            return $this->sendError('Puesto Nomenclatura not found');
        }

        $puestoNomenclatura = $this->puestoNomenclaturaRepository->update($input, $id);

        return $this->sendResponse($puestoNomenclatura->toArray(), 'PuestoNomenclatura updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/api/puesto-nomenclaturas/{id}",
     *      summary="deletePuestoNomenclatura",
     *      tags={"Puesto Nomenclaturas"},
     *      description="Delete PuestoNomenclatura",
     *      security={ {"sanctum": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="id of PuestoNomenclatura",
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
        /** @var PuestoNomenclatura $puestoNomenclatura */
        $puestoNomenclatura = $this->puestoNomenclaturaRepository->find($id);

        if (empty($puestoNomenclatura)) {
            return $this->sendError('Puesto Nomenclatura not found');
        }

        $puestoNomenclatura->delete();

        return $this->sendSuccess('Puesto Nomenclatura deleted successfully');
    }
}
