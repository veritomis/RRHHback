<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSuplementoAPIRequest;
use App\Http\Requests\API\UpdateSuplementoAPIRequest;
use App\Models\Suplemento;
use App\Repositories\SuplementoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class SuplementoController
 * @package App\Http\Controllers\API
 */

class SuplementoAPIController extends AppBaseController
{
    /** @var  SuplementoRepository */
    private $suplementoRepository;

    public function __construct(SuplementoRepository $suplementoRepo)
    {
        $this->suplementoRepository = $suplementoRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *      path="/api/suplementos",
     *      summary="getSuplementoList",
     *      tags={"Suplementos"},
     *      security={ {"sanctum": {} }},
     *      description="Get all Suplementos",
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
     *                  @OA\Items(ref="#/definitions/Suplemento")
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
        $suplementos = $this->suplementoRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($suplementos->toArray(), 'Suplementos retrieved successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="/api/suplementos",
     *      summary="createSuplemento",
     *      tags={"Suplementos"},
     *      security={ {"sanctum": {} }},
     *      description="Create Suplemento",
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
     *                  ref="#/definitions/Suplemento"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSuplementoAPIRequest $request)
    {
        $input = $request->all();

        $suplemento = $this->suplementoRepository->create($input);

        return $this->sendResponse($suplemento->toArray(), 'Suplemento saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/api/suplementos/{id}",
     *      summary="getSuplementoItem",
     *      tags={"Suplementos"},
     *      security={ {"sanctum": {} }},
     *      description="Get Suplemento",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Suplemento",
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
     *                  ref="#/definitions/Suplemento"
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
        /** @var Suplemento $suplemento */
        $suplemento = $this->suplementoRepository->find($id);

        if (empty($suplemento)) {
            return $this->sendError('Suplemento not found');
        }

        return $this->sendResponse($suplemento->toArray(), 'Suplemento retrieved successfully');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @OA\Put(
     *      path="/api/suplementos/{id}",
     *      summary="updateSuplemento",
     *      tags={"Suplementos"},
     *      security={ {"sanctum": {} }},
     *      description="Update Suplemento",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Suplemento",
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
     *                  ref="#/definitions/Suplemento"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateSuplementoAPIRequest $request)
    {
        $input = $request->all();

        /** @var Suplemento $suplemento */
        $suplemento = $this->suplementoRepository->find($id);

        if (empty($suplemento)) {
            return $this->sendError('Suplemento not found');
        }

        $suplemento = $this->suplementoRepository->update($input, $id);

        return $this->sendResponse($suplemento->toArray(), 'Suplemento updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/api/suplementos/{id}",
     *      summary="deleteSuplemento",
     *      tags={"Suplementos"},
     *      security={ {"sanctum": {} }},
     *      description="Delete Suplemento",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Suplemento",
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
        /** @var Suplemento $suplemento */
        $suplemento = $this->suplementoRepository->find($id);

        if (empty($suplemento)) {
            return $this->sendError('Suplemento not found');
        }

        $suplemento->delete();

        return $this->sendSuccess('Suplemento deleted successfully');
    }
}
