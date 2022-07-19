<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateProfesionAPIRequest;
use App\Http\Requests\API\UpdateProfesionAPIRequest;
use App\Models\Profesion;
use App\Repositories\ProfesionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ProfesionController
 * @package App\Http\Controllers\API
 */

class ProfesionAPIController extends AppBaseController
{
    /** @var  ProfesionRepository */
    private $profesionRepository;

    public function __construct(ProfesionRepository $profesionRepo)
    {
        $this->profesionRepository = $profesionRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *      path="/profesions",
     *      summary="getProfesionList",
     *      tags={"Profesion"},
     *      description="Get all Profesions",
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
     *                  @OA\Items(ref="#/definitions/Profesion")
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
        $profesions = $this->profesionRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($profesions->toArray(), 'Profesions retrieved successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="/profesions",
     *      summary="createProfesion",
     *      tags={"Profesion"},
     *      description="Create Profesion",
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
     *                  ref="#/definitions/Profesion"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateProfesionAPIRequest $request)
    {
        $input = $request->all();

        $profesion = $this->profesionRepository->create($input);

        return $this->sendResponse($profesion->toArray(), 'Profesion saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/profesions/{id}",
     *      summary="getProfesionItem",
     *      tags={"Profesion"},
     *      description="Get Profesion",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Profesion",
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
     *                  ref="#/definitions/Profesion"
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
        /** @var Profesion $profesion */
        $profesion = $this->profesionRepository->find($id);

        if (empty($profesion)) {
            return $this->sendError('Profesion not found');
        }

        return $this->sendResponse($profesion->toArray(), 'Profesion retrieved successfully');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @OA\Put(
     *      path="/profesions/{id}",
     *      summary="updateProfesion",
     *      tags={"Profesion"},
     *      description="Update Profesion",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Profesion",
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
     *                  ref="#/definitions/Profesion"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateProfesionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Profesion $profesion */
        $profesion = $this->profesionRepository->find($id);

        if (empty($profesion)) {
            return $this->sendError('Profesion not found');
        }

        $profesion = $this->profesionRepository->update($input, $id);

        return $this->sendResponse($profesion->toArray(), 'Profesion updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/profesions/{id}",
     *      summary="deleteProfesion",
     *      tags={"Profesion"},
     *      description="Delete Profesion",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Profesion",
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
        /** @var Profesion $profesion */
        $profesion = $this->profesionRepository->find($id);

        if (empty($profesion)) {
            return $this->sendError('Profesion not found');
        }

        $profesion->delete();

        return $this->sendSuccess('Profesion deleted successfully');
    }
}
