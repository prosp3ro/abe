<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreBugBountyRequest;
use App\Http\Requests\Api\UpdateBugBountyRequest;
use App\Models\BugBounty;
use Symfony\Component\HttpFoundation\Response;

final class BugBountyController extends Controller
{
    public function index()
    {
        $bounties = BugBounty::paginate(20);

        return $this->respondSuccess([
            "items" => $bounties->items(),
            "meta" => [
                "total" => $bounties->total(),
                "per_page" => $bounties->perPage(),
                "current_page" => $bounties->currentPage(),
                "last_page" => $bounties->lastPage(),
            ],
        ], status: Response::HTTP_OK);
    }

    public function store(StoreBugBountyRequest $request)
    {
        $bounty = BugBounty::create($request->validated());

        return $this->respondSuccess($bounty, status: Response::HTTP_CREATED);
    }

    public function show(int $id)
    {
        $bounty = BugBounty::findOrFail($id);

        return $this->respondSuccess($bounty, status: Response::HTTP_OK);
    }

    public function update(UpdateBugBountyRequest $request, int $id)
    {
        $bounty = BugBounty::findOrFail($id);
        $bounty->update($request->validated());

        return $this->respondSuccess($bounty, status: Response::HTTP_OK);
    }

    public function destroy(int $id)
    {
        BugBounty::findOrFail($id)->delete();

        return response()->noContent();
    }
}
