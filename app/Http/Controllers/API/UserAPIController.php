<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateUserAPIRequest;
use App\Http\Requests\API\UpdateUserAPIRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class UserController
 * @package App\Http\Controllers\API
 */

class UserAPIController extends AppBaseController
{
    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $postRepo)
    {
        $this->userRepository = $postRepo;
    }

    /**
     * Display a listing of the User.
     * GET|HEAD /posts
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $posts = $this->userRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        $users =$posts->load('roles');

        return $this->sendResponse($users->toArray(), 'Usuarios listados con éxito');
    }

    /**
     * Store a newly created User in storage.
     * POST /posts
     *
     * @param CreateUserAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateUserAPIRequest $request)
    {
        $input = $request->all();

        $post = $this->userRepository->create($input);

        return $this->sendResponse($post->toArray(), 'Usuario creado con éxito');
    }

    /**
     * Display the specified User.
     * GET|HEAD /posts/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var User $post */
        $post = $this->userRepository->find($id);

        if (empty($post)) {
            return $this->sendError('Usuario no encontrado');
        }

        $user =$post->load('roles');

        return $this->sendResponse($user->toArray(), 'Usuario recuperado con éxito');
    }

    /**
     * Update the specified User in storage.
     * PUT/PATCH /posts/{id}
     *
     * @param int $id
     * @param UpdateUserAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserAPIRequest $request)
    {
        $input = $request->all();

        /** @var User $post */
        $post = $this->userRepository->find($id);

        if (empty($post)) {
            return $this->sendError('Usuario no encontrado');
        }

        $post = $this->userRepository->update($input, $id);

        return $this->sendResponse($post->toArray(), 'Usuario actualizado con éxito');
    }

    /**
     * Remove the specified User from storage.
     * DELETE /posts/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var User $post */
        $post = $this->userRepository->find($id);

        if (empty($post)) {
            return $this->sendError('Usuario no encontrado');
        }

        $post->forcedelete();

        return $this->sendSuccess('Usuario borrado con éxito');
    }
}
