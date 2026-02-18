<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUrlRequest;
use App\Http\Resources\UrlResource;
use App\Http\Services\UrlService;
use Illuminate\Http\Request;

class UrlController extends ApiController
{

    public function __construct(private readonly UrlService $urlService)
    {
    }

    /**
     * 📄 لیست کاربران
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
    public function show(int $id)
    {
        $urls = $this->urlService->show($id);
        return $this->responseSuccess('get data successfully', new UrlResource($urls));
    }

    public function store(CreateUrlRequest $request)
    {
        $data = $request->validated();
        $data['original_url'] = $data['url'];
        unset($data['url']);

        $user = $this->urlService->create($data);

        return $this->responseCreated('item successfully created', new UrlResource($user));
    }
    public function delete(int $id)
    {
        $url = $this->urlService->delete($id);
        return $this->responseSuccess('item successfully deleted');
    }




}