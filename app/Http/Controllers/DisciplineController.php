<?php

namespace App\Http\Controllers;

use App\Models\Discipline;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\DisciplineRequest;

class DisciplineController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $disciplines = Discipline::all();

        return response()->json($disciplines, JsonResponse::HTTP_OK);
    }

    /**
     * @param DisciplineRequest $request
     * @return JsonResponse
     */
    public function store(DisciplineRequest $request): JsonResponse
    {
        $discipline = Discipline::create($request->all());

        return response()->json($discipline, JsonResponse::HTTP_CREATED);
    }

    /**
     * @param Discipline $discipline
     * @return JsonResponse
     */
    public function show(Discipline $discipline): JsonResponse
    {
        return response()->json($discipline, JsonResponse::HTTP_OK);
    }

    /**
     * @param DisciplineRequest $request
     * @param Discipline $discipline
     * @return JsonResponse
     */
    public function update(DisciplineRequest $request, Discipline $discipline): JsonResponse
    {
        $discipline->update($request->all());

        return response()->json($discipline, JsonResponse::HTTP_OK);
    }

    /**
     * @param Discipline $discipline
     * @return JsonResponse
     */
    public function destroy(Discipline $discipline): JsonResponse
    {
        $discipline->delete();

        return response()->json(null, JsonResponse::HTTP_NO_CONTENT);
    }
}
