<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Services\UrlService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(private readonly UrlService $urlService)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $urls = $this->urlService->list($request);
        return view('home', compact('urls'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'original_url' => 'required|url',
        ]);

        $url = $this->urlService->create($request->all());

        return redirect()->route('urlpanel.show', $url->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        try {
            $url = $this->urlService->getUrlById($id);

            return view('show', compact('url'));
        } catch (ModelNotFoundException $e) {
            abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $url = $this->urlService->getUrlById($id);
            $this->urlService->delete($url);

            return redirect('home');
        } catch (ModelNotFoundException $e) {
            abort(404);

        }
    }
}
