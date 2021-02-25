<?php

namespace App\Http\Controllers;

use App\Models\Discipline;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\DisciplineRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

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
        $discipline->contents;

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
        if ($discipline->contents->count() > 0) {
            throw new HttpResponseException(
                response()->json(
                    'Não é possível excluir essa disciplina pois possuem conteúdos cadastrados para ela',
                    JsonResponse::HTTP_UNPROCESSABLE_ENTITY
                )
            );
        }

        $discipline->delete();

        return response()->json(null, JsonResponse::HTTP_NO_CONTENT);
    }
}
