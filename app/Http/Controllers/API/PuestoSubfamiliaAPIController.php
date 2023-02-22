<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePuestoSubfamiliaAPIRequest;
use App\Http\Requests\API\UpdatePuestoSubfamiliaAPIRequest;
use App\Models\PuestoSubfamilia;
use App\Repositories\PuestoSubfamiliaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class PuestoSubfamiliaController
 * @package App\Http\Controllers\API
 */

class PuestoSubfamiliaAPIController extends AppBaseController
{
    /** @var  PuestoSubfamiliaRepository */
    private $puestoSubfamiliaRepository;

    public function __construct(PuestoSubfamiliaRepository $puestoSubfamiliaRepo)
    {
        $this->puestoSubfamiliaRepository = $puestoSubfamiliaRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *      path="/api/puesto-subfamilias",
     *      summary="getPuestoSubfamiliaList",
     *      tags={"Puesto Subfamilias"},
     *      description="Get all PuestoSubfamilias",
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
     *                  @OA\Items(ref="#/definitions/PuestoSubfamilia")
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
        $puestoSubfamilias = $this->puestoSubfamiliaRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($puestoSubfamilias->toArray(), 'Puesto Subfamilias retrieved successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="/api/puesto-subfamilias",
     *      summary="createPuestoSubfamilia",
     *      tags={"Puesto Subfamilias"},
     *      description="Create PuestoSubfamilia",
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
     *                  ref="#/definitions/PuestoSubfamilia"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePuestoSubfamiliaAPIRequest $request)
    {
        $input = $request->all();

        $puestoSubfamilia = $this->puestoSubfamiliaRepository->create($input);

        return $this->sendResponse($puestoSubfamilia->toArray(), 'Puesto Subfamilia saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/api/puesto-subfamilias/{id}",
     *      summary="getPuestoSubfamiliaItem",
     *      tags={"Puesto Subfamilias"},
     *      description="Get PuestoSubfamilia",
     *      security={ {"sanctum": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="id of PuestoSubfamilia",
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
     *                  ref="#/definitions/PuestoSubfamilia"
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
        /** @var PuestoSubfamilia $puestoSubfamilia */
        $puestoSubfamilia = $this->puestoSubfamiliaRepository->find($id);

        if (empty($puestoSubfamilia)) {
            return $this->sendError('Puesto Subfamilia not found');
        }

        return $this->sendResponse($puestoSubfamilia->toArray(), 'Puesto Subfamilia retrieved successfully');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @OA\Put(
     *      path="/api/puesto-subfamilias/{id}",
     *      summary="updatePuestoSubfamilia",
     *      tags={"Puesto Subfamilias"},
     *      description="Update PuestoSubfamilia",
     *      security={ {"sanctum": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="id of PuestoSubfamilia",
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
     *                  ref="#/definitions/PuestoSubfamilia"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePuestoSubfamiliaAPIRequest $request)
    {
        $input = $request->all();

        /** @var PuestoSubfamilia $puestoSubfamilia */
        $puestoSubfamilia = $this->puestoSubfamiliaRepository->find($id);

        if (empty($puestoSubfamilia)) {
            return $this->sendError('Puesto Subfamilia not found');
        }

        $puestoSubfamilia = $this->puestoSubfamiliaRepository->update($input, $id);

        return $this->sendResponse($puestoSubfamilia->toArray(), 'PuestoSubfamilia updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/api/puesto-subfamilias/{id}",
     *      summary="deletePuestoSubfamilia",
     *      tags={"Puesto Subfamilias"},
     *      description="Delete PuestoSubfamilia",
     *      security={ {"sanctum": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="id of PuestoSubfamilia",
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
        /** @var PuestoSubfamilia $puestoSubfamilia */
        $puestoSubfamilia = $this->puestoSubfamiliaRepository->find($id);

        if (empty($puestoSubfamilia)) {
            return $this->sendError('Puesto Subfamilia not found');
        }

        $puestoSubfamilia->delete();

        return $this->sendSuccess('Puesto Subfamilia deleted successfully');
    }
}
