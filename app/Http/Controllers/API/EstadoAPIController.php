<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateEstadoAPIRequest;
use App\Http\Requests\API\UpdateEstadoAPIRequest;
use App\Models\Estado;
use App\Repositories\EstadoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class EstadoController
 * @package App\Http\Controllers\API
 */

class EstadoAPIController extends AppBaseController
{
    /** @var  EstadoRepository */
    private $estadoRepository;

    public function __construct(EstadoRepository $estadoRepo)
    {
        $this->estadoRepository = $estadoRepo;
    }

    /**
     * Display a listing of the Estado.
     * GET|HEAD /estados
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $estados = $this->estadoRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($estados->toArray(), 'Estados retrieved successfully');
    }

    /**
     * Store a newly created Estado in storage.
     * POST /estados
     *
     * @param CreateEstadoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateEstadoAPIRequest $request)
    {
        $input = $request->all();

        $estado = $this->estadoRepository->create($input);

        return $this->sendResponse($estado->toArray(), 'Estado saved successfully');
    }

    /**
     * Display the specified Estado.
     * GET|HEAD /estados/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Estado $estado */
        $estado = $this->estadoRepository->find($id);

        if (empty($estado)) {
            return $this->sendError('Estado not found');
        }

        return $this->sendResponse($estado->toArray(), 'Estado retrieved successfully');
    }

    /**
     * Update the specified Estado in storage.
     * PUT/PATCH /estados/{id}
     *
     * @param int $id
     * @param UpdateEstadoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEstadoAPIRequest $request)
    {
        $input = $request->all();

        /** @var Estado $estado */
        $estado = $this->estadoRepository->find($id);

        if (empty($estado)) {
            return $this->sendError('Estado not found');
        }

        $estado = $this->estadoRepository->update($input, $id);

        return $this->sendResponse($estado->toArray(), 'Estado updated successfully');
    }

    /**
     * Remove the specified Estado from storage.
     * DELETE /estados/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Estado $estado */
        $estado = $this->estadoRepository->find($id);

        if (empty($estado)) {
            return $this->sendError('Estado not found');
        }

        $estado->delete();

        return $this->sendSuccess('Estado deleted successfully');
    }
}
