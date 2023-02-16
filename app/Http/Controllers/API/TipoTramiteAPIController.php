<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTipoTramiteAPIRequest;
use App\Http\Requests\API\UpdateTipoTramiteAPIRequest;
use App\Models\TipoTramite;
use App\Repositories\TipoTramiteRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class TipoTramiteController
 * @package App\Http\Controllers\API
 */

class TipoTramiteAPIController extends AppBaseController
{
    /** @var  TipoTramiteRepository */
    private $tipoTramiteRepository;

    public function __construct(TipoTramiteRepository $tipoTramiteRepo)
    {
        $this->tipoTramiteRepository = $tipoTramiteRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *      path="/tipo-tramites",
     *      summary="getTipoTramiteList",
     *      tags={"Tipo Tramites"},
     *      description="Get all TipoTramites",
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
     *                  @OA\Items(ref="#/definitions/TipoTramite")
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
        if (!$this->verifiedPermissions('consultar-tipo-tramites')) {
            return $this->sendError('Usuario no autorizado');
        }

        $tipoTramites = $this->tipoTramiteRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($tipoTramites->toArray(), 'Tipo Tramites retrieved successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="/tipo-tramites",
     *      summary="createTipoTramite",
     *      tags={"Tipo Tramites"},
     *      description="Create TipoTramite",
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
     *                  ref="#/definitions/TipoTramite"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateTipoTramiteAPIRequest $request)
    {
        if (!$this->verifiedPermissions('crear-tipo-tramites')) {
            return $this->sendError('Usuario no autorizado');
        }

        $input = $request->all();

        $tipoTramite = $this->tipoTramiteRepository->create($input);

        return $this->sendResponse($tipoTramite->toArray(), 'Tipo Tramite saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/tipo-tramites/{id}",
     *      summary="getTipoTramiteItem",
     *      tags={"Tipo Tramites"},
     *      description="Get TipoTramite",
     *      security={ {"sanctum": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="id of TipoTramite",
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
     *                  ref="#/definitions/TipoTramite"
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
        if (!$this->verifiedPermissions('consultar-tipo-tramites')) {
            return $this->sendError('Usuario no autorizado');
        }

        /** @var TipoTramite $tipoTramite */
        $tipoTramite = $this->tipoTramiteRepository->find($id);

        if (empty($tipoTramite)) {
            return $this->sendError('Tipo Tramite not found');
        }

        return $this->sendResponse($tipoTramite->toArray(), 'Tipo Tramite retrieved successfully');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @OA\Put(
     *      path="/tipo-tramites/{id}",
     *      summary="updateTipoTramite",
     *      tags={"Tipo Tramites"},
     *      description="Update TipoTramite",
     *      security={ {"sanctum": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="id of TipoTramite",
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
     *                  ref="#/definitions/TipoTramite"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateTipoTramiteAPIRequest $request)
    {
        if (!$this->verifiedPermissions('editar-tipo-tramites')) {
            return $this->sendError('Usuario no autorizado');
        }

        $input = $request->all();

        /** @var TipoTramite $tipoTramite */
        $tipoTramite = $this->tipoTramiteRepository->find($id);

        if (empty($tipoTramite)) {
            return $this->sendError('Tipo Tramite not found');
        }

        $tipoTramite = $this->tipoTramiteRepository->update($input, $id);

        return $this->sendResponse($tipoTramite->toArray(), 'TipoTramite updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/tipo-tramites/{id}",
     *      summary="deleteTipoTramite",
     *      tags={"Tipo Tramites"},
     *      description="Delete TipoTramite",
     *      security={ {"sanctum": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="id of TipoTramite",
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
        if (!$this->verifiedPermissions('borrar-tipo-tramites')) {
            return $this->sendError('Usuario no autorizado');
        }

        /** @var TipoTramite $tipoTramite */
        $tipoTramite = $this->tipoTramiteRepository->find($id);

        if (empty($tipoTramite)) {
            return $this->sendError('Tipo Tramite not found');
        }

        $tipoTramite->delete();

        return $this->sendSuccess('Tipo Tramite deleted successfully');
    }
}
