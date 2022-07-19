<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTituloAPIRequest;
use App\Http\Requests\API\UpdateTituloAPIRequest;
use App\Models\Titulo;
use App\Repositories\TituloRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class TituloController
 * @package App\Http\Controllers\API
 */

class TituloAPIController extends AppBaseController
{
    /** @var  TituloRepository */
    private $tituloRepository;

    public function __construct(TituloRepository $tituloRepo)
    {
        $this->tituloRepository = $tituloRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *      path="/titulos",
     *      summary="getTituloList",
     *      tags={"Titulo"},
     *      description="Get all Titulos",
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
     *                  @OA\Items(ref="#/definitions/Titulo")
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
        $titulos = $this->tituloRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($titulos->toArray(), 'Titulos retrieved successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="/titulos",
     *      summary="createTitulo",
     *      tags={"Titulo"},
     *      description="Create Titulo",
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
     *                  ref="#/definitions/Titulo"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateTituloAPIRequest $request)
    {
        $input = $request->all();

        $titulo = $this->tituloRepository->create($input);

        return $this->sendResponse($titulo->toArray(), 'Titulo saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/titulos/{id}",
     *      summary="getTituloItem",
     *      tags={"Titulo"},
     *      description="Get Titulo",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Titulo",
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
     *                  ref="#/definitions/Titulo"
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
        /** @var Titulo $titulo */
        $titulo = $this->tituloRepository->find($id);

        if (empty($titulo)) {
            return $this->sendError('Titulo not found');
        }

        return $this->sendResponse($titulo->toArray(), 'Titulo retrieved successfully');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @OA\Put(
     *      path="/titulos/{id}",
     *      summary="updateTitulo",
     *      tags={"Titulo"},
     *      description="Update Titulo",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Titulo",
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
     *                  ref="#/definitions/Titulo"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateTituloAPIRequest $request)
    {
        $input = $request->all();

        /** @var Titulo $titulo */
        $titulo = $this->tituloRepository->find($id);

        if (empty($titulo)) {
            return $this->sendError('Titulo not found');
        }

        $titulo = $this->tituloRepository->update($input, $id);

        return $this->sendResponse($titulo->toArray(), 'Titulo updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/titulos/{id}",
     *      summary="deleteTitulo",
     *      tags={"Titulo"},
     *      description="Delete Titulo",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Titulo",
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
        /** @var Titulo $titulo */
        $titulo = $this->tituloRepository->find($id);

        if (empty($titulo)) {
            return $this->sendError('Titulo not found');
        }

        $titulo->delete();

        return $this->sendSuccess('Titulo deleted successfully');
    }
}
