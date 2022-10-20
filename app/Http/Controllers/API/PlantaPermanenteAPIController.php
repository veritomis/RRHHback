<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePlantaPermanenteAPIRequest;
use App\Http\Requests\API\UpdatePlantaPermanenteAPIRequest;
use App\Models\PlantaPermanente;
use App\Repositories\PlantaPermanenteRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Traits\VerificationRol;
use Response;

/**
 * Class PlantaPermanenteController
 * @package App\Http\Controllers\API
 */

class PlantaPermanenteAPIController extends AppBaseController
{
    use VerificationRol;

    /** @var  PlantaPermanenteRepository */
    private $plantaPermanenteRepository;

    public function __construct(PlantaPermanenteRepository $plantaPermanenteRepo)
    {
        $this->plantaPermanenteRepository = $plantaPermanenteRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *      path="/api/planta-permanentes",
     *      summary="getPlantaPermanenteList",
     *      tags={"PlantaPermanente"},
     *      description="Get all PlantaPermanentes",
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
     *                  @OA\Items(ref="#/definitions/PlantaPermanente")
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
        if (!$this->verifiedPermissions('consultar-planta-permanentes')) {
            return $this->sendError('Usuario no autorizado');
        }

        $plantaPermanentes = $this->plantaPermanenteRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );


        return $this->sendResponse($plantaPermanentes->toArray(), 'Planta Permanentes retrieved successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="/api/planta-permanentes",
     *      summary="createPlantaPermanente",
     *      tags={"PlantaPermanente"},
     *      description="Create PlantaPermanente",
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
     *                  ref="#/definitions/PlantaPermanente"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePlantaPermanenteAPIRequest $request)
    {
        if (!$this->verifiedPermissions('crear-planta-permanentes')) {
            return $this->sendError('Usuario no autorizado');
        }

        $input = $request->all();
        
        $plantaPermanente = $this->plantaPermanenteRepository->create($input);

        return $this->sendResponse($plantaPermanente->toArray(), 'Planta Permanente saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/api/planta-permanentes/{id}",
     *      summary="getPlantaPermanenteItem",
     *      tags={"PlantaPermanente"},
     *      description="Get PlantaPermanente",
     *      security={ {"sanctum": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="id of PlantaPermanente",
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
     *                  ref="#/definitions/PlantaPermanente"
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
        // if (!$this->verifiedPermissions('consultar-planta-permanentes')) {
        //     return $this->sendError('Usuario no autorizado');
        // }

        /** @var PlantaPermanente $plantaPermanente */
        $plantaPermanente = $this->plantaPermanenteRepository->find($id);

        if (empty($plantaPermanente)) {
            return $this->sendError('Planta Permanente not found');
        }

        return $this->sendResponse($plantaPermanente->toArray(), 'Planta Permanente retrieved successfully');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @OA\Put(
     *      path="/api/planta-permanentes/{id}",
     *      summary="updatePlantaPermanente",
     *      tags={"PlantaPermanente"},
     *      description="Update PlantaPermanente",
     *      security={ {"sanctum": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="id of PlantaPermanente",
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
     *                  ref="#/definitions/PlantaPermanente"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePlantaPermanenteAPIRequest $request)
    {
        // if (!$this->verifiedPermissions('consultar-planta-permanentes')) {
        //     return $this->sendError('Usuario no autorizado');
        // }
        
        $input = $request->all();

        /** @var PlantaPermanente $plantaPermanente */
        $plantaPermanente = $this->plantaPermanenteRepository->find($id);

        if (empty($plantaPermanente)) {
            return $this->sendError('Planta Permanente not found');
        }

        $plantaPermanente = $this->plantaPermanenteRepository->update($input, $id);

        return $this->sendResponse($plantaPermanente->toArray(), 'PlantaPermanente updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/api/planta-permanentes/{id}",
     *      summary="deletePlantaPermanente",
     *      tags={"PlantaPermanente"},
     *      description="Delete PlantaPermanente",
     *      security={ {"sanctum": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="id of PlantaPermanente",
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
        // if (!$this->verifiedPermissions('borrar-planta-permanentes')) {
        //     return $this->sendError('Usuario no autorizado');
        // }

        /** @var PlantaPermanente $plantaPermanente */
        $plantaPermanente = $this->plantaPermanenteRepository->find($id);

        if (empty($plantaPermanente)) {
            return $this->sendError('Planta Permanente not found');
        }

        $plantaPermanente->delete();

        return $this->sendSuccess('Planta Permanente deleted successfully');
    }
}
