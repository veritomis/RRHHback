<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateLegajoAPIRequest;
use App\Http\Requests\API\UpdateLegajoAPIRequest;
use App\Models\Legajo;
use App\Repositories\LegajoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Traits\VerificationRol;

use Response;

/**
 * Class LegajoController
 * @package App\Http\Controllers\API
 */

class LegajoAPIController extends AppBaseController
{
    use VerificationRol;
    
    /** @var  LegajoRepository */
    private $legajoRepository;

    public function __construct(LegajoRepository $legajoRepo)
    {
        $this->legajoRepository = $legajoRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *      path="/api/legajos",
     *      summary="getLegajoList",
     *      tags={"Legajo"},
     *      security={ {"sanctum": {} }},
     *      description="Get all Legajos",
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
     *                  @OA\Items(ref="#/definitions/Legajo")
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
        if (!$this->verifiedPermissions('consultar-legajos')) {
            return $this->sendError('Usuario no autorizado');
        }

        $legajos = $this->legajoRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($legajos->toArray(), 'Legajos retrieved successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="/api/legajos",
     *      summary="createLegajo",
     *      tags={"Legajo"},
     *      security={ {"sanctum": {} }},
     *      description="Create Legajo",
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
     *                  ref="#/definitions/Legajo"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateLegajoAPIRequest $request)
    {
        if (!$this->verifiedPermissions('crear-legajos')) {
            return $this->sendError('Usuario no autorizado');
        }

        $input = $request->all();

        $legajo = $this->legajoRepository->create($input);

        return $this->sendResponse($legajo->toArray(), 'Legajo saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/api/legajos/{id}",
     *      summary="getLegajoItem",
     *      tags={"Legajo"},
     *      security={ {"sanctum": {} }},
     *      description="Get Legajo",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Legajo",
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
     *                  ref="#/definitions/Legajo"
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
        if (!$this->verifiedPermissions('consultar-legajos')) {
            return $this->sendError('Usuario no autorizado');
        }

        /** @var Legajo $legajo */
        $legajo = $this->legajoRepository->find($id);

        if (empty($legajo)) {
            return $this->sendError('Legajo not found');
        }

        return $this->sendResponse($legajo->toArray(), 'Legajo retrieved successfully');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @OA\Put(
     *      path="/api/legajos/{id}",
     *      summary="updateLegajo",
     *      tags={"Legajo"},
     *      security={ {"sanctum": {} }},
     *      description="Update Legajo",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Legajo",
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
     *                  ref="#/definitions/Legajo"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateLegajoAPIRequest $request)
    {

        if (!$this->verifiedPermissions('editar-legajos')) {
            return $this->sendError('Usuario no autorizado');
        }

        $input = $request->all();

        /** @var Legajo $legajo */
        $legajo = $this->legajoRepository->find($id);

        if (empty($legajo)) {
            return $this->sendError('Legajo not found');
        }

        $legajo = $this->legajoRepository->update($input, $id);

        return $this->sendResponse($legajo->toArray(), 'Legajo updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/api/legajos/{id}",
     *      summary="deleteLegajo",
     *      tags={"Legajo"},
     *      security={ {"sanctum": {} }},
     *      description="Delete Legajo",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Legajo",
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

        if (!$this->verifiedPermissions('borrar-legajos')) {
            return $this->sendError('Usuario no autorizado');
        }

        /** @var Legajo $legajo */
        $legajo = $this->legajoRepository->find($id);

        if (empty($legajo)) {
            return $this->sendError('Legajo not found');
        }

        $legajo->delete();

        return $this->sendSuccess('Legajo deleted successfully');
    }
}
