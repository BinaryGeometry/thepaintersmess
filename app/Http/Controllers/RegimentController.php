<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegimentRequest;
use App\Http\Resources\RegimentResource;
use App\Models\Regiment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class RegimentController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Regiment::class);

        return RegimentResource::collection(Regiment::all());
    }

    public function store(RegimentRequest $request)
    {
        $this->authorize('create', Regiment::class);

        return new RegimentResource(Regiment::create($request->validated()));
    }

    public function show(Regiment $regiment)
    {
        $this->authorize('view', $regiment);

        return new RegimentResource($regiment);
    }

    public function update(RegimentRequest $request, Regiment $regiment)
    {
        $this->authorize('update', $regiment);

        $regiment->update($request->validated());

        return new RegimentResource($regiment);
    }

    public function destroy(Regiment $regiment)
    {
        $this->authorize('delete', $regiment);

        $regiment->delete();

        return response()->json();
    }
}
