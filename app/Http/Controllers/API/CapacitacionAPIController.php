<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCapacitacionAPIRequest;
use App\Http\Requests\API\UpdateCapacitacionAPIRequest;
use App\Models\Capacitacion;
use App\Repositories\CapacitacionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class CapacitacionController
 * @package App\Http\Controllers\API
 */

class CapacitacionAPIController extends AppBaseController
{
    /** @var  CapacitacionRepository */
    private $capacitacionRepository;

    public function __construct(CapacitacionRepository $capacitacionRepo)
    {
        $this->capacitacionRepository = $capacitacionRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *      path="api/capacitacions",
     *      summary="getCapacitacionList",
     *      tags={"Capacitaciones"},
     *      security={ {"sanctum": {} }},
     *      description="Get all Capacitacions",
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
     *                  @OA\Items(ref="#/definitions/Capacitacion")
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
        $capacitacions = $this->capacitacionRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($capacitacions->toArray(), 'Capacitacions retrieved successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="api/capacitacions",
     *      summary="createCapacitacion",
     *      tags={"Capacitaciones"},
     *      security={ {"sanctum": {} }},
     *      description="Create Capacitacion",
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
     *                  ref="#/definitions/Capacitacion"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateCapacitacionAPIRequest $request)
    {
        $input = $request->all();

        $capacitacion = $this->capacitacionRepository->create($input);

        return $this->sendResponse($capacitacion->toArray(), 'Capacitacion saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="api/capacitacions/{id}",
     *      summary="getCapacitacionItem",
     *      tags={"Capacitaciones"},
     *      security={ {"sanctum": {} }},
     *      description="Get Capacitacion",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Capacitacion",
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
     *                  ref="#/definitions/Capacitacion"
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
        /** @var Capacitacion $capacitacion */
        $capacitacion = $this->capacitacionRepository->find($id);

        if (empty($capacitacion)) {
            return $this->sendError('Capacitacion not found');
        }

        return $this->sendResponse($capacitacion->toArray(), 'Capacitacion retrieved successfully');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @OA\Put(
     *      path="api/capacitacions/{id}",
     *      summary="updateCapacitacion",
     *      tags={"Capacitaciones"},
     *      security={ {"sanctum": {} }},
     *      description="Update Capacitacion",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Capacitacion",
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
     *                  ref="#/definitions/Capacitacion"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateCapacitacionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Capacitacion $capacitacion */
        $capacitacion = $this->capacitacionRepository->find($id);

        if (empty($capacitacion)) {
            return $this->sendError('Capacitacion not found');
        }

        $capacitacion = $this->capacitacionRepository->update($input, $id);

        return $this->sendResponse($capacitacion->toArray(), 'Capacitacion updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="api/capacitacions/{id}",
     *      summary="deleteCapacitacion",
     *      tags={"Capacitaciones"},
     *      security={ {"sanctum": {} }},
     *      description="Delete Capacitacion",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Capacitacion",
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
        /** @var Capacitacion $capacitacion */
        $capacitacion = $this->capacitacionRepository->find($id);

        if (empty($capacitacion)) {
            return $this->sendError('Capacitacion not found');
        }

        $capacitacion->delete();

        return $this->sendSuccess('Capacitacion deleted successfully');
    }
}
