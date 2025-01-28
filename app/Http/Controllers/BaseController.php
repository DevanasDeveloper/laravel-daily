<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function sendSuccess($data = [], $message = "Operation Success", $code = 200)
    {
        return response()->json([
            "success" => true,
            "message" => $message,
            "data" => $data,
        ], $code);
    }

    public function sendError($message = "Operation Failed", $errors = [], $code = 200)
    {
        return response()->json([
            "success" => false,
            "message" => $message,
            "errors" => $errors
        ], $code);
    }

    protected function sendPaginated($query, $perPage = 15, $message = 'Data retrieved successfully')
    {
        $paginated = $query->paginate($perPage);
        return $this->sendSuccess([
            'data' => $paginated->items(),
            'pagination' => [
                'total' => $paginated->total(),
                'per_page' => $paginated->perPage(),
                'current_page' => $paginated->currentPage(),
                'last_page' => $paginated->lastPage(),
            ],
        ], $message);
    }
}
