<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAsistenciaMedicaAPIRequest;
use App\Http\Requests\API\UpdateAsistenciaMedicaAPIRequest;
use App\Models\AsistenciaMedica;
use App\Repositories\AsistenciaMedicaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class AsistenciaMedicaController
 * @package App\Http\Controllers\API
 */

class AsistenciaMedicaAPIController extends AppBaseController
{
    /** @var  AsistenciaMedicaRepository */
    private $asistenciaMedicaRepository;

    public function __construct(AsistenciaMedicaRepository $asistenciaMedicaRepo)
    {
        $this->asistenciaMedicaRepository = $asistenciaMedicaRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *      path="/api/asistencia-medicas",
     *      summary="getAsistenciaMedicaList",
     *      tags={"AsistenciaMedica"},
     *      description="Get all AsistenciaMedicas",
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
     *                  @OA\Items(ref="#/definitions/AsistenciaMedica")
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
        $asistenciaMedicas = $this->asistenciaMedicaRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($asistenciaMedicas->toArray(), 'Asistencia Medicas retrieved successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="/api/asistencia-medicas",
     *      summary="createAsistenciaMedica",
     *      tags={"AsistenciaMedica"},
     *      description="Create AsistenciaMedica",
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
     *                  ref="#/definitions/AsistenciaMedica"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateAsistenciaMedicaAPIRequest $request)
    {
        $input = $request->all();

        $asistenciaMedica = $this->asistenciaMedicaRepository->create($input);

        return $this->sendResponse($asistenciaMedica->toArray(), 'Asistencia Medica saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/api/asistencia-medicas/{id}",
     *      summary="getAsistenciaMedicaItem",
     *      tags={"AsistenciaMedica"},
     *      description="Get AsistenciaMedica",
     *      security={ {"sanctum": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="id of AsistenciaMedica",
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
     *                  ref="#/definitions/AsistenciaMedica"
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
        /** @var AsistenciaMedica $asistenciaMedica */
        $asistenciaMedica = $this->asistenciaMedicaRepository->find($id);

        if (empty($asistenciaMedica)) {
            return $this->sendError('Asistencia Medica not found');
        }

        return $this->sendResponse($asistenciaMedica->toArray(), 'Asistencia Medica retrieved successfully');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @OA\Put(
     *      path="/api/asistencia-medicas/{id}",
     *      summary="updateAsistenciaMedica",
     *      tags={"AsistenciaMedica"},
     *      description="Update AsistenciaMedica",
     *      security={ {"sanctum": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="id of AsistenciaMedica",
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
     *                  ref="#/definitions/AsistenciaMedica"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateAsistenciaMedicaAPIRequest $request)
    {
        $input = $request->all();

        /** @var AsistenciaMedica $asistenciaMedica */
        $asistenciaMedica = $this->asistenciaMedicaRepository->find($id);

        if (empty($asistenciaMedica)) {
            return $this->sendError('Asistencia Medica not found');
        }

        $asistenciaMedica = $this->asistenciaMedicaRepository->update($input, $id);

        return $this->sendResponse($asistenciaMedica->toArray(), 'AsistenciaMedica updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/api/asistencia-medicas{id}",
     *      summary="deleteAsistenciaMedica",
     *      tags={"AsistenciaMedica"},
     *      description="Delete AsistenciaMedica",
     *      security={ {"sanctum": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="id of AsistenciaMedica",
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
        /** @var AsistenciaMedica $asistenciaMedica */
        $asistenciaMedica = $this->asistenciaMedicaRepository->find($id);

        if (empty($asistenciaMedica)) {
            return $this->sendError('Asistencia Medica not found');
        }

        $asistenciaMedica->delete();

        return $this->sendSuccess('Asistencia Medica deleted successfully');
    }
}
