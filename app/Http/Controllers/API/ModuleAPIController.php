<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateModuleAPIRequest;
use App\Http\Requests\API\UpdateModuleAPIRequest;
use App\Models\Module;
use App\Repositories\ModuleRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ModuleController
 * @package App\Http\Controllers\API
 */

class ModuleAPIController extends AppBaseController
{
    /** @var  ModuleRepository */
    private $moduleRepository;

    public function __construct(ModuleRepository $moduleRepo)
    {
        $this->moduleRepository = $moduleRepo;
    }

    /**
     * Display a listing of the Module.
     * GET|HEAD /modules
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $modules = $this->moduleRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($modules->toArray(), 'Modules retrieved successfully');
    }

    /**
     * Store a newly created Module in storage.
     * POST /modules
     *
     * @param CreateModuleAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateModuleAPIRequest $request)
    {
        $input = $request->all();

        $module = $this->moduleRepository->create($input);

        return $this->sendResponse($module->toArray(), 'Module saved successfully');
    }

    /**
     * Display the specified Module.
     * GET|HEAD /modules/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Module $module */
        $module = $this->moduleRepository->find($id);

        if (empty($module)) {
            return $this->sendError('Module not found');
        }

        return $this->sendResponse($module->toArray(), 'Module retrieved successfully');
    }

    /**
     * Update the specified Module in storage.
     * PUT/PATCH /modules/{id}
     *
     * @param int $id
     * @param UpdateModuleAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateModuleAPIRequest $request)
    {
        $input = $request->all();

        /** @var Module $module */
        $module = $this->moduleRepository->find($id);

        if (empty($module)) {
            return $this->sendError('Module not found');
        }

        $module = $this->moduleRepository->update($input, $id);

        return $this->sendResponse($module->toArray(), 'Module updated successfully');
    }

    /**
     * Remove the specified Module from storage.
     * DELETE /modules/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Module $module */
        $module = $this->moduleRepository->find($id);

        if (empty($module)) {
            return $this->sendError('Module not found');
        }

        $module->delete();

        return $this->sendSuccess('Module deleted successfully');
    }
}
