<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Discipline;
use App\Models\Summary;
use Illuminate\Http\JsonResponse;

class HomeController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(
            [
                'contentsCount' => Content::all()->count(),
                'disciplinesCount' => Discipline::all()->count(),
                'summariesCount' => Summary::all()->count()
            ],
            JsonResponse::HTTP_OK
        );
    }
}
