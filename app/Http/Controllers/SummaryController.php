<?php

namespace App\Http\Controllers;

use App\Models\Summary;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\SummaryRequest;

class SummaryController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $summaries = Summary::all();

        return response()->json($summaries, JsonResponse::HTTP_OK);
    }

    /**
     * @param SummaryRequest $request
     * @return JsonResponse
     */
    public function store(SummaryRequest $request): JsonResponse
    {
        $summary = Summary::create($request->all());

        return response()->json($summary, JsonResponse::HTTP_CREATED);
    }

    /**
     * @param Summary $summary
     * @return JsonResponse
     */
    public function show(Summary $summary): JsonResponse
    {
        return response()->json($summary, JsonResponse::HTTP_OK);
    }

    /**
     * @param SummaryRequest $request
     * @param Summary $summary
     * @return JsonResponse
     */
    public function update(SummaryRequest $request, Summary $summary): JsonResponse
    {
        $summary->update($request->all());

        return response()->json($summary, JsonResponse::HTTP_OK);
    }

    /**
     * @param Summary $summary
     * @return JsonResponse
     */
    public function destroy(Summary $summary): JsonResponse
    {
        $summary->delete();

        return response()->json(null, JsonResponse::HTTP_NO_CONTENT);
    }
}
