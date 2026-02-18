<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Requests\CreateUrlRequest;
use App\Http\Resources\UrlResource;
use App\Services\UrlService;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Url",
 *     description="Endpoints for managing Url"
 * ),
 */
class UrlController extends ApiController
{

    public function __construct(private readonly UrlService $urlService)
    {
    }

    /**
     * @OA\Get(
     *      path="/url",
     *      operationId="urllist",
     *      tags={"Url"},
     *      summary="Get all urls",
     *      description="Retrieves all urls.",
     *      @OA\Parameter(
     *          name="page",
     *          in="query",
     *          required=true,
     *          description="page of the urls list",
     *          @OA\Schema(type="integer", format="int64")
     *      ),
     *     @OA\Parameter(
     *          name="perPage",
     *          in="query",
     *          required=true,
     *          description="PerPage of the urls list",
     *          @OA\Schema(type="integer", format="int64")
     *      ),   
     *      @OA\Response(
     *          response=200,
     *          description="urls retrieved successfully",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="urls are retrieved successfully or No urls found!"),
     *              @OA\Property(property="data", type="array",
     *                  @OA\Items(
     *                      @OA\Property(property="id", type="integer", example=1),
     *                      @OA\Property(property="status", type="string", example="active"),
     *                      @OA\Property(property="url", type="string", example="https://panel.sheltertm.com/ip/1b552f7268428a1"),
     *                      @OA\Property(property="short_url", type="string", example="abcd"),
     *                      @OA\Property(property="click", type="integer", example="10"),
     *                  ),
     *              ),
     *          ),
     *      ),
     * )
     */

    public function index(Request $request)
    {
        $urls = $this->urlService->list($request);
        $response = UrlResource::collection($urls)
            ->response()
            ->getData(true);

        unset($response['links']);
        return $this->responseSuccess('get data successfully', $response);
    }
    /**
     * @OA\Get(
     *      path="/url/{id}",
     *      operationId="urlshow",
     *      tags={"Url"},
     *      summary="Get a specific urls ",
     *      description="Retrieves a specific urls  by its ID.",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the urls ",
     *          @OA\Schema(type="integer", format="int64")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="urls retrieved successfully",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="urls are retrieved successfully or No urls found!"),
     *              @OA\Property(property="data", type="array",
     *                  @OA\Items(
     *                      @OA\Property(property="id", type="integer", example=1),
     *                      @OA\Property(property="status", type="string", example="active"),
     *                      @OA\Property(property="url", type="string", example="https://panel.sheltertm.com/ip/1b552f7268428a1"),
     *                      @OA\Property(property="short_url", type="string", example="abcd"),
     *                      @OA\Property(property="click", type="integer", example="10"),
     *                  ),
     *              ),
     *          ),
     *      ),
     * )
     */
    public function show(int $id)
    {
        $urls = $this->urlService->show($id);
        return $this->responseSuccess('get data successfully', new UrlResource($urls));
    }
    /**
     * @OA\Post(
     *      path="/url",
     *      operationId="urlstore",
     *      tags={"Url"},
     *      summary="store urls",
     *      description="stroe urls.",
     *        @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  required={"url"},
     *                  @OA\Property(property="url", type="string",example="https://panel.sheltertm.com/ip/1b552f7268428a1"),
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="urls retrieved successfully",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="urls are retrieved successfully or No urls found!"),
     *              @OA\Property(property="data", type="array",
     *                  @OA\Items(
     *                      @OA\Property(property="id", type="integer", example=1),
     *                      @OA\Property(property="status", type="string", example="active"),
     *                      @OA\Property(property="url", type="string", example="https://panel.sheltertm.com/ip/1b552f7268428a1"),
     *                      @OA\Property(property="short_url", type="string", example="abcd"),
     *                      @OA\Property(property="click", type="integer", example="10"),
     *                  ),
     *              ),
     *          ),
     *      ),
     * )
     */
    public function store(CreateUrlRequest $request)
    {
        $data = $request->validated();
        $data['original_url'] = $data['url'];
        unset($data['url']);

        $user = $this->urlService->create($data);

        return $this->responseCreated('item successfully created', new UrlResource($user));
    }


    /**
     * @OA\Delete(
     *      path="/url/{id}",
     *      operationId="urldestroy",
     *      tags={"Url"},
     *      summary="Delete a specific urls",
     *      description="Deletes a specific urls by its ID.",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the urls",
     *          @OA\Schema(type="integer", format="int64")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="urls update response",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="urls are retrieved successfully or No urls found!"),
     *          ),
     *      ),
     * )
     */
    public function delete(int $id)
    {
        $url = $this->urlService->delete($id);
        return $this->responseSuccess('item successfully deleted');
    }




}