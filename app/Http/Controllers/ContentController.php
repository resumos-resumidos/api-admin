<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ContentRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ContentController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $contents = Content::all()->sortBy('title')->values();

        foreach ($contents as $content) {
            $content->discipline;
        }

        return response()->json($contents, JsonResponse::HTTP_OK);
    }

    /**
     * @param ContentRequest $request
     * @return JsonResponse
     */
    public function store(ContentRequest $request): JsonResponse
    {
        $content = Content::create($request->all());

        return response()->json($content, JsonResponse::HTTP_CREATED);
    }

    /**
     * @param Content $content
     * @return JsonResponse
     */
    public function show(Content $content): JsonResponse
    {
        return response()->json($content, JsonResponse::HTTP_OK);
    }

    /**
     * @param ContentRequest $request
     * @param Content $content
     * @return JsonResponse
     */
    public function update(ContentRequest $request, Content $content): JsonResponse
    {
        $content->update($request->all());

        return response()->json($content, JsonResponse::HTTP_OK);
    }

    /**
     * @param Content $content
     * @return JsonResponse
     */
    public function destroy(Content $content): JsonResponse
    {
        if ($content->summaries()->count() > 0) {
            throw new HttpResponseException(
                response()->json(
                    'Não é possível excluir esse conteúdo pois possuem resumos cadastrados para ele',
                    JsonResponse::HTTP_UNPROCESSABLE_ENTITY
                )
            );
        }

        $content->delete();

        return response()->json(null, JsonResponse::HTTP_NO_CONTENT);
    }
}
