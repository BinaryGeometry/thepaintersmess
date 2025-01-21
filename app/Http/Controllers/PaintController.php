<?php

namespace App\Http\Controllers;

use App\Models\Paint;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
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
            'paints' => Paint::with('user:id,name')->latest()->get(),
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
        $image_path = '';

        https:// stackoverflow.com/questions/77211977/cannot-upload-images-on-update-method-laravel-vue-inertia

        if ($request->hasFile('thumbnail')) {
            dd('huzzah!');
            $image_path = $request->file('image')->store('image', 'public');
        }

        dd($request); //

        $validated = $request->validate([

            'brand' => 'required|string|max:255',

        ]);

        $request->user()->paints()->create($validated);

        return redirect(route('paints.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Paint $paint) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Paint $paint) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Paint $paint): RedirectResponse
    {
        Gate::authorize('update', $paint);
        $validated = $request->validate([
            'brand' => 'required|string|max:255',
        ]);
        $paint->update($validated);

        return redirect(route('paints.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paint $paint): RedirectResponse
    {
        Gate::authorize('delete', $paint);
        $paint->delete();

        return redirect(route('paints.index'));
    }
}
