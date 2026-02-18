<?php

namespace App\Http\Services;

use App\Models\ShortUrl;
use Illuminate\Http\Client\Request;

class UrlService
{

    public function list(Request $request)
    {
        $query = ShortUrl::query();
        $perPage = $request->get('perPage');
        $Page = $request->get('Page');
        return $perPage
            ? $query->paginate($perPage)
            : $query->get();
    }

    public function show(int $id)
    {
        $url = ShortUrl::findOrFail($id);
        return $url;
    }

    public function create(array $data)
    {
        $url = ShortUrl::create($data);
        return $url;


    }
    public function update(array $data, int $id)
    {

        $url = ShortUrl::findOrFail($id);
        $url->update($data);

        return $url;
    }

    public function delete(int $id)
    {

        $url = ShortUrl::findOrFail($id);
        $url->delete();

        return $url;
    }

}
