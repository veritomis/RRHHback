<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateEvaluacionAPIRequest;
use App\Http\Requests\API\UpdateEvaluacionAPIRequest;
use App\Models\Evaluacion;
use App\Repositories\EvaluacionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class EvaluacionController
 * @package App\Http\Controllers\API
 */

class EvaluacionAPIController extends AppBaseController
{
    /** @var  EvaluacionRepository */
    private $evaluacionRepository;

    public function __construct(EvaluacionRepository $evaluacionRepo)
    {
        $this->evaluacionRepository = $evaluacionRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *      path="/evaluacions",
     *      summary="getEvaluacionList",
     *      tags={"Evaluacion"},
     *      description="Get all Evaluacions",
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
     *                  @OA\Items(ref="#/definitions/Evaluacion")
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
        $evaluacions = $this->evaluacionRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($evaluacions->toArray(), 'Evaluacions retrieved successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="/evaluacions",
     *      summary="createEvaluacion",
     *      tags={"Evaluacion"},
     *      description="Create Evaluacion",
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
     *                  ref="#/definitions/Evaluacion"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateEvaluacionAPIRequest $request)
    {
        $input = $request->all();

        $evaluacion = $this->evaluacionRepository->create($input);

        return $this->sendResponse($evaluacion->toArray(), 'Evaluacion saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/evaluacions/{id}",
     *      summary="getEvaluacionItem",
     *      tags={"Evaluacion"},
     *      description="Get Evaluacion",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Evaluacion",
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
     *                  ref="#/definitions/Evaluacion"
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
        /** @var Evaluacion $evaluacion */
        $evaluacion = $this->evaluacionRepository->find($id);

        if (empty($evaluacion)) {
            return $this->sendError('Evaluacion not found');
        }

        return $this->sendResponse($evaluacion->toArray(), 'Evaluacion retrieved successfully');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @OA\Put(
     *      path="/evaluacions/{id}",
     *      summary="updateEvaluacion",
     *      tags={"Evaluacion"},
     *      description="Update Evaluacion",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Evaluacion",
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
     *                  ref="#/definitions/Evaluacion"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateEvaluacionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Evaluacion $evaluacion */
        $evaluacion = $this->evaluacionRepository->find($id);

        if (empty($evaluacion)) {
            return $this->sendError('Evaluacion not found');
        }

        $evaluacion = $this->evaluacionRepository->update($input, $id);

        return $this->sendResponse($evaluacion->toArray(), 'Evaluacion updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/evaluacions/{id}",
     *      summary="deleteEvaluacion",
     *      tags={"Evaluacion"},
     *      description="Delete Evaluacion",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Evaluacion",
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
        /** @var Evaluacion $evaluacion */
        $evaluacion = $this->evaluacionRepository->find($id);

        if (empty($evaluacion)) {
            return $this->sendError('Evaluacion not found');
        }

        $evaluacion->delete();

        return $this->sendSuccess('Evaluacion deleted successfully');
    }
}
