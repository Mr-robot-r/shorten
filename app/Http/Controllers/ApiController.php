<?php

namespace App\Http\Controllers;

use Essa\APIToolKit\Api\ApiResponse;
use OpenApi\Attributes as OA;

#[OA\Info(
    version: "1.0.0",
    title: "Shorten API"
)]
class ApiController extends Controller
{
    use ApiResponse;
}