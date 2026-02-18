<?php

namespace App\Http\Services;

use App\Models\ShortUrl;
use Illuminate\Http\Request;

class UrlService
{

    public function list(Request $request)
    {
        $query = ShortUrl::query();
        $perPage = $request->input('perPage') ?? 20;
        $Page = $request->input('Page');
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
        $data['short_url'] = ShortUrl::generateUniqueShortCode();
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
