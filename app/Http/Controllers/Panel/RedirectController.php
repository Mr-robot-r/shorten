<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Services\UrlService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function __construct(private readonly UrlService $urlService)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function redirect(string $short_code)
    {
        try {
            $urls = $this->urlService->getUrlByCode($short_code);

            return redirect($urls->original_url, 301);
        } catch (ModelNotFoundException $e) {
            return view(404);

        }

    }


}
