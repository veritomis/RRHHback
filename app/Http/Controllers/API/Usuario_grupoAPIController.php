<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateUsuario_grupoAPIRequest;
use App\Http\Requests\API\UpdateUsuario_grupoAPIRequest;
use App\Models\Usuario_grupo;
use App\Repositories\Usuario_grupoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class Usuario_grupoController
 * @package App\Http\Controllers\API
 */

class Usuario_grupoAPIController extends AppBaseController
{
    /** @var  Usuario_grupoRepository */
    private $usuarioGrupoRepository;

    public function __construct(Usuario_grupoRepository $usuarioGrupoRepo)
    {
        $this->usuarioGrupoRepository = $usuarioGrupoRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *      path="/usuarioGrupos",
     *      summary="getUsuario_grupoList",
     *      tags={"Usuario_grupo"},
     *      description="Get all Usuario_grupos",
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
     *                  @OA\Items(ref="#/definitions/Usuario_grupo")
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
        $usuarioGrupos = $this->usuarioGrupoRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($usuarioGrupos->toArray(), 'Usuario Grupos retrieved successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="/usuarioGrupos",
     *      summary="createUsuario_grupo",
     *      tags={"Usuario_grupo"},
     *      description="Create Usuario_grupo",
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
     *                  ref="#/definitions/Usuario_grupo"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateUsuario_grupoAPIRequest $request)
    {
        $input = $request->all();

        $usuarioGrupo = $this->usuarioGrupoRepository->create($input);

        return $this->sendResponse($usuarioGrupo->toArray(), 'Usuario Grupo saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/usuarioGrupos/{id}",
     *      summary="getUsuario_grupoItem",
     *      tags={"Usuario_grupo"},
     *      description="Get Usuario_grupo",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Usuario_grupo",
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
     *                  ref="#/definitions/Usuario_grupo"
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
        /** @var Usuario_grupo $usuarioGrupo */
        $usuarioGrupo = $this->usuarioGrupoRepository->find($id);

        if (empty($usuarioGrupo)) {
            return $this->sendError('Usuario Grupo not found');
        }

        return $this->sendResponse($usuarioGrupo->toArray(), 'Usuario Grupo retrieved successfully');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @OA\Put(
     *      path="/usuarioGrupos/{id}",
     *      summary="updateUsuario_grupo",
     *      tags={"Usuario_grupo"},
     *      description="Update Usuario_grupo",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Usuario_grupo",
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
     *                  ref="#/definitions/Usuario_grupo"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateUsuario_grupoAPIRequest $request)
    {
        $input = $request->all();

        /** @var Usuario_grupo $usuarioGrupo */
        $usuarioGrupo = $this->usuarioGrupoRepository->find($id);

        if (empty($usuarioGrupo)) {
            return $this->sendError('Usuario Grupo not found');
        }

        $usuarioGrupo = $this->usuarioGrupoRepository->update($input, $id);

        return $this->sendResponse($usuarioGrupo->toArray(), 'Usuario_grupo updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/usuarioGrupos/{id}",
     *      summary="deleteUsuario_grupo",
     *      tags={"Usuario_grupo"},
     *      description="Delete Usuario_grupo",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Usuario_grupo",
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
        /** @var Usuario_grupo $usuarioGrupo */
        $usuarioGrupo = $this->usuarioGrupoRepository->find($id);

        if (empty($usuarioGrupo)) {
            return $this->sendError('Usuario Grupo not found');
        }

        $usuarioGrupo->delete();

        return $this->sendSuccess('Usuario Grupo deleted successfully');
    }
}
