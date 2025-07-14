<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreResearcherRequest;
use App\Http\Requests\Api\UpdateResearcherRequest;
use App\Models\Researcher;
use Symfony\Component\HttpFoundation\Response;

final class ResearcherController extends Controller
{
    public function index()
    {
        $researchers = Researcher::paginate(20);

        return $this->respondSuccess([
            "items" => $researchers->items(),
            "meta" => [
                "total" => $researchers->total(),
                "per_page" => $researchers->perPage(),
                "current_page" => $researchers->currentPage(),
                "last_page" => $researchers->lastPage(),
            ],
        ], status: Response::HTTP_OK);
    }

    public function store(StoreResearcherRequest $request)
    {
        $researcher = Researcher::create($request->validated());

        return $this->respondSuccess($researcher, status: Response::HTTP_CREATED);
    }

    public function show(int $id)
    {
        $researcher = Researcher::findOrFail($id);

        return $this->respondSuccess($researcher, status: Response::HTTP_OK);
    }

    public function update(UpdateResearcherRequest $request, int $id)
    {
        $researcher = Researcher::findOrFail($id);
        $researcher->update($request->validated());

        return $this->respondSuccess($researcher, status: Response::HTTP_OK);
    }

    public function destroy(int $id)
    {
        Researcher::findOrFail($id)->delete();

        return response()->noContent();
    }
}
