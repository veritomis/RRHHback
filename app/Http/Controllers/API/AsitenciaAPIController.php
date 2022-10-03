<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAsitenciaAPIRequest;
use App\Http\Requests\API\UpdateAsitenciaAPIRequest;
use App\Models\Asitencia;
use App\Repositories\AsitenciaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class AsitenciaController
 * @package App\Http\Controllers\API
 */

class AsitenciaAPIController extends AppBaseController
{
    /** @var  AsitenciaRepository */
    private $asitenciaRepository;

    public function __construct(AsitenciaRepository $asitenciaRepo)
    {
        $this->asitenciaRepository = $asitenciaRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *      path="/asitencias",
     *      summary="getAsitenciaList",
     *      tags={"Asitencia"},
     *      description="Get all Asitencias",
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
     *                  @OA\Items(ref="#/definitions/Asitencia")
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
        $asitencias = $this->asitenciaRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($asitencias->toArray(), 'Asitencias retrieved successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="/asitencias",
     *      summary="createAsitencia",
     *      tags={"Asitencia"},
     *      description="Create Asitencia",
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
     *                  ref="#/definitions/Asitencia"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateAsitenciaAPIRequest $request)
    {
        $input = $request->all();

        $asitencia = $this->asitenciaRepository->create($input);

        return $this->sendResponse($asitencia->toArray(), 'Asitencia saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/asitencias/{id}",
     *      summary="getAsitenciaItem",
     *      tags={"Asitencia"},
     *      description="Get Asitencia",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Asitencia",
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
     *                  ref="#/definitions/Asitencia"
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
        /** @var Asitencia $asitencia */
        $asitencia = $this->asitenciaRepository->find($id);

        if (empty($asitencia)) {
            return $this->sendError('Asitencia not found');
        }

        return $this->sendResponse($asitencia->toArray(), 'Asitencia retrieved successfully');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @OA\Put(
     *      path="/asitencias/{id}",
     *      summary="updateAsitencia",
     *      tags={"Asitencia"},
     *      description="Update Asitencia",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Asitencia",
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
     *                  ref="#/definitions/Asitencia"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateAsitenciaAPIRequest $request)
    {
        $input = $request->all();

        /** @var Asitencia $asitencia */
        $asitencia = $this->asitenciaRepository->find($id);

        if (empty($asitencia)) {
            return $this->sendError('Asitencia not found');
        }

        $asitencia = $this->asitenciaRepository->update($input, $id);

        return $this->sendResponse($asitencia->toArray(), 'Asitencia updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/asitencias/{id}",
     *      summary="deleteAsitencia",
     *      tags={"Asitencia"},
     *      description="Delete Asitencia",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Asitencia",
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
        /** @var Asitencia $asitencia */
        $asitencia = $this->asitenciaRepository->find($id);

        if (empty($asitencia)) {
            return $this->sendError('Asitencia not found');
        }

        $asitencia->delete();

        return $this->sendSuccess('Asitencia deleted successfully');
    }
}
