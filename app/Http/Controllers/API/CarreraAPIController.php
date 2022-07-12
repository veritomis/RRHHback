<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCarreraAPIRequest;
use App\Http\Requests\API\UpdateCarreraAPIRequest;
use App\Models\Carrera;
use App\Repositories\CarreraRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class CarreraController
 * @package App\Http\Controllers\API
 */

class CarreraAPIController extends AppBaseController
{
    /** @var  CarreraRepository */
    private $carreraRepository;

    public function __construct(CarreraRepository $carreraRepo)
    {
        $this->carreraRepository = $carreraRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *      path="/carreras",
     *      summary="getCarreraList",
     *      tags={"Carrera"},
     *      description="Get all Carreras",
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
     *                  @OA\Items(ref="#/definitions/Carrera")
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
        $carreras = $this->carreraRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($carreras->toArray(), 'Carreras retrieved successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="/carreras",
     *      summary="createCarrera",
     *      tags={"Carrera"},
     *      description="Create Carrera",
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
     *                  ref="#/definitions/Carrera"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateCarreraAPIRequest $request)
    {
        $input = $request->all();

        $carrera = $this->carreraRepository->create($input);

        return $this->sendResponse($carrera->toArray(), 'Carrera saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/carreras/{id}",
     *      summary="getCarreraItem",
     *      tags={"Carrera"},
     *      description="Get Carrera",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Carrera",
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
     *                  ref="#/definitions/Carrera"
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
        /** @var Carrera $carrera */
        $carrera = $this->carreraRepository->find($id);

        if (empty($carrera)) {
            return $this->sendError('Carrera not found');
        }

        return $this->sendResponse($carrera->toArray(), 'Carrera retrieved successfully');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @OA\Put(
     *      path="/carreras/{id}",
     *      summary="updateCarrera",
     *      tags={"Carrera"},
     *      description="Update Carrera",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Carrera",
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
     *                  ref="#/definitions/Carrera"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateCarreraAPIRequest $request)
    {
        $input = $request->all();

        /** @var Carrera $carrera */
        $carrera = $this->carreraRepository->find($id);

        if (empty($carrera)) {
            return $this->sendError('Carrera not found');
        }

        $carrera = $this->carreraRepository->update($input, $id);

        return $this->sendResponse($carrera->toArray(), 'Carrera updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/carreras/{id}",
     *      summary="deleteCarrera",
     *      tags={"Carrera"},
     *      description="Delete Carrera",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Carrera",
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
        /** @var Carrera $carrera */
        $carrera = $this->carreraRepository->find($id);

        if (empty($carrera)) {
            return $this->sendError('Carrera not found');
        }

        $carrera->delete();

        return $this->sendSuccess('Carrera deleted successfully');
    }
}
