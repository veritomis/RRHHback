<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateVinculacionLaboralAPIRequest;
use App\Http\Requests\API\UpdateVinculacionLaboralAPIRequest;
use App\Models\VinculacionLaboral;
use App\Repositories\VinculacionLaboralRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class VinculacionLaboralController
 * @package App\Http\Controllers\API
 */

class VinculacionLaboralAPIController extends AppBaseController
{
    /** @var  VinculacionLaboralRepository */
    private $vinculacionLaboralRepository;

    public function __construct(VinculacionLaboralRepository $vinculacionLaboralRepo)
    {
        $this->vinculacionLaboralRepository = $vinculacionLaboralRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *      path="/api/vinculaciones-laborales",
     *      summary="getVinculacionLaboralList",
     *      tags={"VinculacionLaboral"},
     *      description="Get all VinculacionLaborals",
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
     *                  @OA\Items(ref="#/definitions/VinculacionLaboral")
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
        $vinculacionLaborals = $this->vinculacionLaboralRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($vinculacionLaborals->toArray(), 'Vinculacion Laborals retrieved successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="/api/vinculaciones-laborales",
     *      summary="createVinculacionLaboral",
     *      tags={"VinculacionLaboral"},
     *      description="Create VinculacionLaboral",
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
     *                  ref="#/definitions/VinculacionLaboral"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateVinculacionLaboralAPIRequest $request)
    {
        $input = $request->all();

        $vinculacionLaboral = $this->vinculacionLaboralRepository->create($input);

        return $this->sendResponse($vinculacionLaboral->toArray(), 'Vinculacion Laboral saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/api/vinculaciones-laborales/{id}",
     *      summary="getVinculacionLaboralItem",
     *      tags={"VinculacionLaboral"},
     *      description="Get VinculacionLaboral",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of VinculacionLaboral",
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
     *                  ref="#/definitions/VinculacionLaboral"
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
        /** @var VinculacionLaboral $vinculacionLaboral */
        $vinculacionLaboral = $this->vinculacionLaboralRepository->find($id);

        if (empty($vinculacionLaboral)) {
            return $this->sendError('Vinculacion Laboral not found');
        }

        return $this->sendResponse($vinculacionLaboral->toArray(), 'Vinculacion Laboral retrieved successfully');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @OA\Put(
     *      path="/api/vinculaciones-laborales/{id}",
     *      summary="updateVinculacionLaboral",
     *      tags={"VinculacionLaboral"},
     *      description="Update VinculacionLaboral",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of VinculacionLaboral",
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
     *                  ref="#/definitions/VinculacionLaboral"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateVinculacionLaboralAPIRequest $request)
    {
        $input = $request->all();

        /** @var VinculacionLaboral $vinculacionLaboral */
        $vinculacionLaboral = $this->vinculacionLaboralRepository->find($id);

        if (empty($vinculacionLaboral)) {
            return $this->sendError('Vinculacion Laboral not found');
        }

        $vinculacionLaboral = $this->vinculacionLaboralRepository->update($input, $id);

        return $this->sendResponse($vinculacionLaboral->toArray(), 'VinculacionLaboral updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/api/vinculaciones-laborales/{id}",
     *      summary="deleteVinculacionLaboral",
     *      tags={"VinculacionLaboral"},
     *      description="Delete VinculacionLaboral",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of VinculacionLaboral",
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
        /** @var VinculacionLaboral $vinculacionLaboral */
        $vinculacionLaboral = $this->vinculacionLaboralRepository->find($id);

        if (empty($vinculacionLaboral)) {
            return $this->sendError('Vinculacion Laboral not found');
        }

        $vinculacionLaboral->delete();

        return $this->sendSuccess('Vinculacion Laboral deleted successfully');
    }
}
