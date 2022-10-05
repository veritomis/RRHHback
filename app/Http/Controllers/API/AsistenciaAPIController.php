<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAsistenciaAPIRequest;
use App\Http\Requests\API\UpdateAsistenciaAPIRequest;
use App\Models\Asistencia;
use App\Repositories\AsistenciaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Traits\VerificationRol;
use Response;

/**
 * Class AsistenciaController
 * @package App\Http\Controllers\API
 */

class AsistenciaAPIController extends AppBaseController
{
    use VerificationRol;

    /** @var  AsistenciaRepository */
    private $asistenciaRepository;

    public function __construct(AsistenciaRepository $asistenciaRepo)
    {
        $this->asistenciaRepository = $asistenciaRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *      path="/api/asistencias",
     *      summary="getAsistenciaList",
     *      tags={"Asistencia"},
     *      description="Get all Asistencias",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          security={ {"sanctum": {} }},
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(ref="#/definitions/Asistencia")
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
        //if (!$this->verifiedPermissions('consultar-asistencias')) {
        //    return $this->sendError('Usuario no autorizado');
        //}

        $asistencias = $this->asistenciaRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($asistencias->toArray(), 'Asistencias retrieved successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="/api/asistencias",
     *      summary="createAsistencia",
     *      tags={"Asistencia"},
     *      description="Create Asistencia",
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
     *                  ref="#/definitions/Asistencia"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateAsistenciaAPIRequest $request)
    {
        //if (!$this->verifiedPermissions('crear-asistencias')) {
        //    return $this->sendError('Usuario no autorizado');
        //}
        $input = $request->all();

        $asistencia = $this->asistenciaRepository->create($input);

        return $this->sendResponse($asistencia->toArray(), 'Asistencia saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/asistencias/{id}",
     *      summary="getAsistenciaItem",
     *      tags={"Asistencia"},
     *      description="Get Asistencia",
     *      security={ {"sanctum": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Asistencia",
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
     *                  ref="#/definitions/Asistencia"
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
        //if (!$this->verifiedPermissions('consultar-asistencias')) {
        //    return $this->sendError('Usuario no autorizado');
        //}
        /** @var Asistencia $asistencia */
        $asistencia = $this->asistenciaRepository->find($id);

        if (empty($asistencia)) {
            return $this->sendError('Asistencia not found');
        }

        return $this->sendResponse($asistencia->toArray(), 'Asistencia retrieved successfully');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @OA\Put(
     *      path="/api/asistencias/{id}",
     *      summary="updateAsistencia",
     *      tags={"Asistencia"},
     *      description="Update Asistencia",
     *      security={ {"sanctum": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Asistencia",
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
     *                  ref="#/definitions/Asistencia"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateAsistenciaAPIRequest $request)
    {
        //if (!$this->verifiedPermissions('editar-asistencias')) {
        //    return $this->sendError('Usuario no autorizado');
        //}

        $input = $request->all();

        /** @var Asistencia $asistencia */
        $asistencia = $this->asistenciaRepository->find($id);

        if (empty($asistencia)) {
            return $this->sendError('Asistencia not found');
        }

        $asistencia = $this->asistenciaRepository->update($input, $id);

        return $this->sendResponse($asistencia->toArray(), 'Asistencia updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/api/asistencias/{id}",
     *      summary="deleteAsistencia",
     *      tags={"Asistencia"},
     *      description="Delete Asistencia",
     *      security={ {"sanctum": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Asistencia",
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
        //if (!$this->verifiedPermissions('borrar-asistencias')) {
        //    return $this->sendError('Usuario no autorizado');
        //}
        /** @var Asistencia $asistencia */
        $asistencia = $this->asistenciaRepository->find($id);

        if (empty($asistencia)) {
            return $this->sendError('Asistencia not found');
        }

        $asistencia->delete();

        return $this->sendSuccess('Asistencia deleted successfully');
    }
}
