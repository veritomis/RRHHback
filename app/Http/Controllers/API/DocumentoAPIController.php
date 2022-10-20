<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateDocumentoAPIRequest;
use App\Http\Requests\API\UpdateDocumentoAPIRequest;
use App\Models\Documento;
use App\Repositories\DocumentoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class DocumentoController
 * @package App\Http\Controllers\API
 */

class DocumentoAPIController extends AppBaseController
{
    /** @var  DocumentoRepository */
    private $documentoRepository;

    public function __construct(DocumentoRepository $documentoRepo)
    {
        $this->documentoRepository = $documentoRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *      path="/documentos",
     *      summary="getDocumentoList",
     *      tags={"Documento"},
     *      description="Get all Documentos",
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
     *                  @OA\Items(ref="#/definitions/Documento")
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
        $documentos = $this->documentoRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($documentos->toArray(), 'Documentos retrieved successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="/documentos",
     *      summary="createDocumento",
     *      tags={"Documento"},
     *      description="Create Documento",
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
     *                  ref="#/definitions/Documento"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateDocumentoAPIRequest $request)
    {
        $input = $request->all();

        $documento = $this->documentoRepository->create($input);

        return $this->sendResponse($documento->toArray(), 'Documento saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/documentos/{id}",
     *      summary="getDocumentoItem",
     *      tags={"Documento"},
     *      description="Get Documento",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Documento",
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
     *                  ref="#/definitions/Documento"
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
        /** @var Documento $documento */
        $documento = $this->documentoRepository->find($id);

        if (empty($documento)) {
            return $this->sendError('Documento not found');
        }

        return $this->sendResponse($documento->toArray(), 'Documento retrieved successfully');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @OA\Put(
     *      path="/documentos/{id}",
     *      summary="updateDocumento",
     *      tags={"Documento"},
     *      description="Update Documento",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Documento",
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
     *                  ref="#/definitions/Documento"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateDocumentoAPIRequest $request)
    {
        $input = $request->all();

        /** @var Documento $documento */
        $documento = $this->documentoRepository->find($id);

        if (empty($documento)) {
            return $this->sendError('Documento not found');
        }

        $documento = $this->documentoRepository->update($input, $id);

        return $this->sendResponse($documento->toArray(), 'Documento updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/documentos/{id}",
     *      summary="deleteDocumento",
     *      tags={"Documento"},
     *      description="Delete Documento",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Documento",
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
        /** @var Documento $documento */
        $documento = $this->documentoRepository->find($id);

        if (empty($documento)) {
            return $this->sendError('Documento not found');
        }

        $documento->delete();

        return $this->sendSuccess('Documento deleted successfully');
    }
}
