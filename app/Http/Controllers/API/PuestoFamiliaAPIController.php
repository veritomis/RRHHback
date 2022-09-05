<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePuestoFamiliaAPIRequest;
use App\Http\Requests\API\UpdatePuestoFamiliaAPIRequest;
use App\Models\PuestoFamilia;
use App\Repositories\PuestoFamiliaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class PuestoFamiliaController
 * @package App\Http\Controllers\API
 */

class PuestoFamiliaAPIController extends AppBaseController
{
    /** @var  PuestoFamiliaRepository */
    private $puestoFamiliaRepository;

    public function __construct(PuestoFamiliaRepository $puestoFamiliaRepo)
    {
        $this->puestoFamiliaRepository = $puestoFamiliaRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *      path="/api/puesto-familias",
     *      summary="getPuestoFamiliaList",
     *      tags={"Puesto Familias"},
     *      security={ {"sanctum": {} }},
     *      description="Get all PuestoFamilias",
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
     *                  @OA\Items(ref="#/definitions/PuestoFamilia")
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
        $puestoFamilias = $this->puestoFamiliaRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($puestoFamilias->toArray(), 'Puesto Familias retrieved successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="/api/puesto-familias",
     *      summary="createPuestoFamilia",
     *      tags={"Puesto Familias"},
     *      security={ {"sanctum": {} }},
     *      description="Create PuestoFamilia",
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
     *                  ref="#/definitions/PuestoFamilia"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePuestoFamiliaAPIRequest $request)
    {
        $input = $request->all();

        $puestoFamilia = $this->puestoFamiliaRepository->create($input);

        return $this->sendResponse($puestoFamilia->toArray(), 'Puesto Familia saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/api/puesto-familias/{id}",
     *      summary="getPuestoFamiliaItem",
     *      tags={"Puesto Familias"},
     *      security={ {"sanctum": {} }},
     *      description="Get PuestoFamilia",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of PuestoFamilia",
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
     *                  ref="#/definitions/PuestoFamilia"
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
        /** @var PuestoFamilia $puestoFamilia */
        $puestoFamilia = $this->puestoFamiliaRepository->find($id);

        if (empty($puestoFamilia)) {
            return $this->sendError('Puesto Familia not found');
        }

        return $this->sendResponse($puestoFamilia->toArray(), 'Puesto Familia retrieved successfully');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @OA\Put(
     *      path="/api/puesto-familias/{id}",
     *      summary="updatePuestoFamilia",
     *      tags={"Puesto Familias"},
     *      security={ {"sanctum": {} }},
     *      description="Update PuestoFamilia",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of PuestoFamilia",
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
     *                  ref="#/definitions/PuestoFamilia"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePuestoFamiliaAPIRequest $request)
    {
        $input = $request->all();

        /** @var PuestoFamilia $puestoFamilia */
        $puestoFamilia = $this->puestoFamiliaRepository->find($id);

        if (empty($puestoFamilia)) {
            return $this->sendError('Puesto Familia not found');
        }

        $puestoFamilia = $this->puestoFamiliaRepository->update($input, $id);

        return $this->sendResponse($puestoFamilia->toArray(), 'PuestoFamilia updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/api/puesto-familias/{id}",
     *      summary="deletePuestoFamilia",
     *      tags={"Puesto Familias"},
     *      security={ {"sanctum": {} }},
     *      description="Delete PuestoFamilia",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of PuestoFamilia",
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
        /** @var PuestoFamilia $puestoFamilia */
        $puestoFamilia = $this->puestoFamiliaRepository->find($id);

        if (empty($puestoFamilia)) {
            return $this->sendError('Puesto Familia not found');
        }

        $puestoFamilia->delete();

        return $this->sendSuccess('Puesto Familia deleted successfully');
    }
}
