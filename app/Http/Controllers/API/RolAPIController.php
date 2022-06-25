<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRolAPIRequest;
use App\Http\Requests\API\UpdateRolAPIRequest;
use App\Models\Rol;
use App\Repositories\RolRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class RolController
 * @package App\Http\Controllers\API
 */

class RolAPIController extends AppBaseController
{
    /** @var  RolRepository */
    private $rolRepository;

    public function __construct(RolRepository $rolRepo)
    {
        $this->rolRepository = $rolRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *      path="/rols",
     *      summary="getRolList",
     *      tags={"Rol"},
     *      description="Get all Rols",
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
     *                  @OA\Items(ref="#/definitions/Rol")
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
        $rols = $this->rolRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($rols->toArray(), 'Rols retrieved successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="/rols",
     *      summary="createRol",
     *      tags={"Rol"},
     *      description="Create Rol",
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
     *                  ref="#/definitions/Rol"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateRolAPIRequest $request)
    {
        $input = $request->all();

        $rol = $this->rolRepository->create($input);

        return $this->sendResponse($rol->toArray(), 'Rol saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/rols/{id}",
     *      summary="getRolItem",
     *      tags={"Rol"},
     *      description="Get Rol",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Rol",
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
     *                  ref="#/definitions/Rol"
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
        /** @var Rol $rol */
        $rol = $this->rolRepository->find($id);

        if (empty($rol)) {
            return $this->sendError('Rol not found');
        }

        return $this->sendResponse($rol->toArray(), 'Rol retrieved successfully');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @OA\Put(
     *      path="/rols/{id}",
     *      summary="updateRol",
     *      tags={"Rol"},
     *      description="Update Rol",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Rol",
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
     *                  ref="#/definitions/Rol"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateRolAPIRequest $request)
    {
        $input = $request->all();

        /** @var Rol $rol */
        $rol = $this->rolRepository->find($id);

        if (empty($rol)) {
            return $this->sendError('Rol not found');
        }

        $rol = $this->rolRepository->update($input, $id);

        return $this->sendResponse($rol->toArray(), 'Rol updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/rols/{id}",
     *      summary="deleteRol",
     *      tags={"Rol"},
     *      description="Delete Rol",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Rol",
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
        /** @var Rol $rol */
        $rol = $this->rolRepository->find($id);

        if (empty($rol)) {
            return $this->sendError('Rol not found');
        }

        $rol->delete();

        return $this->sendSuccess('Rol deleted successfully');
    }
}
