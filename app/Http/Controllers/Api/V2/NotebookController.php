<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NotebookController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $data = [
            'name' => 'Leo',
            'age' => 22
        ];
        return response()->json($data);
    }

    public function store(Request $request)
    {

    }

    public function delete(Request $request, int $id)
    {

    }
}
