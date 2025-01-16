<?php

namespace App\Http\Controllers;

use App\Models\Paint;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PaintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        return Inertia::render('Paints/Index', [

        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
        $validated = $request->validate([

            'message' => 'required|string|max:255',

        ]);

        $request->user()->paints()->create($validated);

        return redirect(route('paints.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Paint $paint)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Paint $paint)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Paint $paint)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paint $paint)
    {
        //
    }
}
