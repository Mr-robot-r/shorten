<?php

namespace App\Http\Controllers;

use Essa\APIToolKit\Api\ApiResponse;
use Illuminate\Routing\Controller as BaseController;


class ApiController extends BaseController
{
    use ApiResponse;

    /**
     * @OA\Info(
     *    title="Shorten URL API",
     *    version="1.0.0",
     *    description="API documentation for shorten url"
     * )
     */


}
