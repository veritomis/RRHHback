<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateFuncionAPIRequest;
use App\Http\Requests\API\UpdateFuncionAPIRequest;
use App\Models\Funcion;
use App\Repositories\FuncionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class FuncionController
 * @package App\Http\Controllers\API
 */

class FuncionAPIController extends AppBaseController
{
    /** @var  FuncionRepository */
    private $funcionRepository;

    public function __construct(FuncionRepository $funcionRepo)
    {
        $this->funcionRepository = $funcionRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *      path="/funcions",
     *      summary="getFuncionList",
     *      tags={"Funcion"},
     *      description="Get all Funcions",
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
     *                  @OA\Items(ref="#/definitions/Funcion")
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
        $funcions = $this->funcionRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($funcions->toArray(), 'Funcions retrieved successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="/funcions",
     *      summary="createFuncion",
     *      tags={"Funcion"},
     *      description="Create Funcion",
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
     *                  ref="#/definitions/Funcion"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateFuncionAPIRequest $request)
    {
        $input = $request->all();

        $funcion = $this->funcionRepository->create($input);

        return $this->sendResponse($funcion->toArray(), 'Funcion saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/funcions/{id}",
     *      summary="getFuncionItem",
     *      tags={"Funcion"},
     *      description="Get Funcion",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Funcion",
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
     *                  ref="#/definitions/Funcion"
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
        /** @var Funcion $funcion */
        $funcion = $this->funcionRepository->find($id);

        if (empty($funcion)) {
            return $this->sendError('Funcion not found');
        }

        return $this->sendResponse($funcion->toArray(), 'Funcion retrieved successfully');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @OA\Put(
     *      path="/funcions/{id}",
     *      summary="updateFuncion",
     *      tags={"Funcion"},
     *      description="Update Funcion",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Funcion",
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
     *                  ref="#/definitions/Funcion"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateFuncionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Funcion $funcion */
        $funcion = $this->funcionRepository->find($id);

        if (empty($funcion)) {
            return $this->sendError('Funcion not found');
        }

        $funcion = $this->funcionRepository->update($input, $id);

        return $this->sendResponse($funcion->toArray(), 'Funcion updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/funcions/{id}",
     *      summary="deleteFuncion",
     *      tags={"Funcion"},
     *      description="Delete Funcion",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Funcion",
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
        /** @var Funcion $funcion */
        $funcion = $this->funcionRepository->find($id);

        if (empty($funcion)) {
            return $this->sendError('Funcion not found');
        }

        $funcion->delete();

        return $this->sendSuccess('Funcion deleted successfully');
    }
}
