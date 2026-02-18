<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UrlController extends ApiController
{

    public function __construct(private readonly UrlService $urlService)
    {
    }

    /**
     * 📄 لیست کاربران
     */
    public function index(Request $request, int $perPage = 20)
    {
        $users = $this->urlService->getAll($request, $perPage);
        $response = UrlResource::collection($users)
            ->response()
            ->getData(true);

        unset($response['links']);
        return $this->responseSuccess('get data successfully', $response);
    }
    public function show(int $id, Request $request)
    {
        $user = $this->urlService->find($id, $request);
        return $this->responseSuccess('get data successfully', new UserResource($user));
    }

    public function store(CreateUrlRequest $request, int $id)
    {
        $user = $this->urlService->create($id, $request->validated());

        $this->user_activity(
            'update Profile',
            'update Profile Successfully'
        );
        return $this->responseCreated('item successfully created', new UrlResource($user));
    }
    public function update(UpdateUrlRequest $request, int $id)
    {
        $user = $this->urlService->update($id, $request->validated());

        $this->user_activity(
            'update Profile',
            'update Profile Successfully'
        );
        return $this->responseCreated('item successfully updated', new UrlResource($user));
    }
    public function delete(int $id)
    {
        $user = $this->urlService->delete($id);

        $this->user_activity(
            'update Profile',
            'update Profile Successfully'
        );
        return $this->responseCreated(__('message.item successfully created'), new UrlResource($user));
    }




}