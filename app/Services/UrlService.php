<?php

namespace App\Services;

use App\Models\ShortUrl;
use Illuminate\Http\Request;

class UrlService
{

    public function list(Request $request)
    {
        $query = ShortUrl::query()->orderBy('id', 'desc');
        $perPage = $request->input('perPage') ?? 20;
        return $perPage
            ? $query->paginate($perPage)
            : $query->get();
    }


    public function create(array $data)
    {
        $data['short_code'] = ShortUrl::generateUniqueShortCode();
        $url = ShortUrl::create($data);
        return $url;
    }
    public function update(ShortUrl $url, array $data)
    {

        $url->update($data);

        return $url;
    }

    public function delete(ShortUrl $url)
    {

        $url->delete();

        return $url;
    }

    public function getUrlById(int $id)
    {
        // Will throw ModelNotFoundException if not found
        return ShortUrl::findOrFail($id);
    }

    public function getUrlByCode(string $code)
    {
        // Will throw ModelNotFoundException if not found
        return ShortUrl::where('short_code', $code)->firstOrFail();
    }

}
