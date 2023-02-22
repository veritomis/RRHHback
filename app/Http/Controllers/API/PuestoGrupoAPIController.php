<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePuestoGrupoAPIRequest;
use App\Http\Requests\API\UpdatePuestoGrupoAPIRequest;
use App\Models\PuestoGrupo;
use App\Repositories\PuestoGrupoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class PuestoGrupoController
 * @package App\Http\Controllers\API
 */

class PuestoGrupoAPIController extends AppBaseController
{
    /** @var  PuestoGrupoRepository */
    private $puestoGrupoRepository;

    public function __construct(PuestoGrupoRepository $puestoGrupoRepo)
    {
        $this->puestoGrupoRepository = $puestoGrupoRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *      path="/api/puesto-grupos",
     *      summary="getPuestoGrupoList",
     *      tags={"Puesto Grupos"},
     *      description="Get all PuestoGrupos",
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
     *                  @OA\Items(ref="#/definitions/PuestoGrupo")
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
        $puestoGrupos = $this->puestoGrupoRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($puestoGrupos->toArray(), 'Puesto Grupos retrieved successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="/api/puesto-grupos",
     *      summary="createPuestoGrupo",
     *      tags={"Puesto Grupos"},
     *      description="Create PuestoGrupo",
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
     *                  ref="#/definitions/PuestoGrupo"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePuestoGrupoAPIRequest $request)
    {
        $input = $request->all();

        $puestoGrupo = $this->puestoGrupoRepository->create($input);

        return $this->sendResponse($puestoGrupo->toArray(), 'Puesto Grupo saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/api/puesto-grupos/{id}",
     *      summary="getPuestoGrupoItem",
     *      tags={"Puesto Grupos"},
     *      description="Get PuestoGrupo",
     *      security={ {"sanctum": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="id of PuestoGrupo",
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
     *                  ref="#/definitions/PuestoGrupo"
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
        /** @var PuestoGrupo $puestoGrupo */
        $puestoGrupo = $this->puestoGrupoRepository->find($id);

        if (empty($puestoGrupo)) {
            return $this->sendError('Puesto Grupo not found');
        }

        return $this->sendResponse($puestoGrupo->toArray(), 'Puesto Grupo retrieved successfully');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @OA\Put(
     *      path="/api/puesto-grupos/{id}",
     *      summary="updatePuestoGrupo",
     *      tags={"Puesto Grupos"},
     *      description="Update PuestoGrupo",
     *      security={ {"sanctum": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="id of PuestoGrupo",
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
     *                  ref="#/definitions/PuestoGrupo"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePuestoGrupoAPIRequest $request)
    {
        $input = $request->all();

        /** @var PuestoGrupo $puestoGrupo */
        $puestoGrupo = $this->puestoGrupoRepository->find($id);

        if (empty($puestoGrupo)) {
            return $this->sendError('Puesto Grupo not found');
        }

        $puestoGrupo = $this->puestoGrupoRepository->update($input, $id);

        return $this->sendResponse($puestoGrupo->toArray(), 'PuestoGrupo updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/api/puesto-grupos/{id}",
     *      summary="deletePuestoGrupo",
     *      tags={"Puesto Grupos"},
     *      description="Delete PuestoGrupo",
     *      security={ {"sanctum": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="id of PuestoGrupo",
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
        /** @var PuestoGrupo $puestoGrupo */
        $puestoGrupo = $this->puestoGrupoRepository->find($id);

        if (empty($puestoGrupo)) {
            return $this->sendError('Puesto Grupo not found');
        }

        $puestoGrupo->delete();

        return $this->sendSuccess('Puesto Grupo deleted successfully');
    }
}
