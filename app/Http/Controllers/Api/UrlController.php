<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Requests\CreateUrlRequest;
use App\Http\Resources\UrlResource;
use App\Services\UrlService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

#[OA\Tag(
    name: "Url",
    description: "Endpoints for managing Url"
)]
class UrlController extends ApiController
{
    public function __construct(
        private readonly UrlService $urlService
    ) {
    }

    #[OA\Get(
        path: "/api/v1/url",
        operationId: "urlList",
        tags: ["Url"],
        summary: "Get all urls",
        description: "Retrieves paginated list of urls",
        parameters: [
            new OA\Parameter(
                name: "page",
                in: "query",
                required: true,
                description: "Page number",
                schema: new OA\Schema(type: "integer", example: 1)
            ),
            new OA\Parameter(
                name: "perPage",
                in: "query",
                required: true,
                description: "Items per page",
                schema: new OA\Schema(type: "integer", example: 10)
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Urls retrieved successfully",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "get data successfully"),
                        new OA\Property(
                            property: "data",
                            type: "array",
                            items: new OA\Items(
                                properties: [
                                    new OA\Property(property: "id", type: "integer", example: 1),
                                    new OA\Property(property: "status", type: "string", example: "active"),
                                    new OA\Property(property: "url", type: "string", example: "https://example.com"),
                                    new OA\Property(property: "short_url", type: "string", example: "abcd"),
                                    new OA\Property(property: "click", type: "integer", example: 10),
                                ]
                            )
                        )
                    ]
                )
            )
        ]
    )]
    public function index(Request $request)
    {
        $urls = $this->urlService->list($request);

        $response = UrlResource::collection($urls)
            ->response()
            ->getData(true);

        unset($response['links']);

        return $this->responseSuccess('get data successfully', $response);
    }

    #[OA\Get(
        path: "/api/v1/url/{id}",
        operationId: "urlShow",
        tags: ["Url"],
        summary: "Get specific url",
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                description: "Url ID",
                schema: new OA\Schema(type: "integer", example: 1)
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Url retrieved successfully"
            ),
            new OA\Response(
                response: 404,
                description: "Url not found"
            )
        ]
    )]
    public function show(int $id)
    {
        try {
            $url = $this->urlService->getUrlById($id);
            return $this->responseSuccess(
                'get data successfully',
                new UrlResource($url)
            );
        } catch (ModelNotFoundException) {
            return $this->responseNotFound('Url Not found', "Not Found");
        }
    }

    #[OA\Post(
        path: "/api/v1/url",
        operationId: "urlStore",
        tags: ["Url"],
        summary: "Create new url",
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ["url"],
                properties: [
                    new OA\Property(
                        property: "url",
                        type: "string",
                        example: "https://example.com"
                    )
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: "Url created successfully"
            ),
            new OA\Response(
                response: 422,
                description: "Validation error"
            )
        ]
    )]
    public function store(CreateUrlRequest $request)
    {
        $data = $request->validated();
        $data['original_url'] = $data['url'];
        unset($data['url']);

        $url = $this->urlService->create($data);

        $res['short_url'] = url('/') . "/" . $url['short_code'];

        return $this->responseCreated('item successfully created', $res);
    }

    #[OA\Delete(
        path: "/api/v1/url/{id}",
        operationId: "urlDestroy",
        tags: ["Url"],
        summary: "Delete specific url",
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                description: "Url ID",
                schema: new OA\Schema(type: "integer", example: 1)
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Url deleted successfully"
            ),
            new OA\Response(
                response: 404,
                description: "Url not found"
            )
        ]
    )]
    public function destroy(int $id)
    {
        try {
            $url = $this->urlService->getUrlById($id);
            $this->urlService->delete($url);

            return $this->responseSuccess('item successfully deleted');
        } catch (ModelNotFoundException) {
            return $this->responseNotFound('Url Not found', "Not Found");
        }
    }
}