<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Symfony\Component\HttpFoundation\Response;

abstract class Controller
{
    // use AuthorizesRequests;
    // use DispatchesJobs;
    // use ValidatesRequests;

    public function respondSuccess($data, int $status = Response::HTTP_OK)
    {
        return response()->json([
            "success" => true,
            "data" => $data
        ], status: $status);
    }

    public function respondError($message, int $status = Response::HTTP_BAD_REQUEST)
    {
        return response()->json([
            "success" => false,
            "message" => $message
        ], status: $status);
    }

    // ...
}
