<?php

namespace App\Http\Controllers;

use App\Models\Regiment;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class RegimentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        //        $regiments = Regiment::where('user_id', Auth::user()->id)
        $regiments = DB::table('regiments')
            ->where('regiments.user_id', '=', Auth::user()->id)
            ->join('item as game', 'game.id', '=', 'regiments.game_id')
            ->leftJoin('item as faction', 'faction.id', '=', 'regiments.faction_id')
            ->leftJoin('item as detachment', 'detachment.id', '=', 'regiments.detachment_id')
            ->latest()->paginate(5, [
                'regiments.*',
                'game.name as game_name',
                'faction.name as faction_name',
                'detachment.name as detachment_name',
            ])
            ->through(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'game_name' => $item->game_name,
                    'game_id' => $item->game_id,
                    'faction_id' => $item->faction_id,
                    'faction_name' => $item->faction_name,
                    'detachment_id' => $item->detachment_id,
                    'detachment_name' => $item->detachment_name,
                    'unit_id' => $item->unit_id,
                    'meta' => $item->meta,
                    'user_id' => $item->user_id,
                ];
            });

        return Inertia::render('Regiments/Index', [
            'regiments' => $regiments,
        ]);

    }

    public function image(Regiment $regiment)
    {
        // get the image named $slug from storage and display it

        // Something like (not sure)
        //        Paint::with('user:id,name')->latest()->get(),
        $image = storage_path('/app/private/'.$regiment->thumbnail);
        //        dd($paint->thumbnail);

        return response()->download($image);
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
        $paintPath = ''; // https:// stackoverflow.com/questions/77211977/cannot-upload-images-on-update-method-laravel-vue-inertia
        $imagePath = null;
        if ($request->hasFile('thumbnail')) {
            $imagePath = $request->file('thumbnail')->store('paints'); // http://www.netzgesta.de/mapper/
        }

        $formData = $request->request->all();

        $laptop = Regiment::create([
            'id' => $formData['id'],
            'slug' => $formData['slug'], // e.g. Citadel, Army Painter, Vallejo
            'game_id' => $formData['game_id'], // e.g Layer, Color Primer, Model Air
            'faction_id' => $formData['faction_id'], // e.g Admiistratum Grey, Ash Grey,  Brown Grey
            'detachment_id' => $formData['detachment_id'], // e.g NULL, NULL, RAL7050
            'unit_id' => $formData['unit_id'], // Grey, Blue, Brown Grey
            'meta' => $formData['meta'], // Grey, Blue, Brown Grey
            'user_id' => $formData['user_id'],
            //            'thumbnail' => $imagePath,
        ])->id;

        $validated = $request->validate([
            'brand' => 'required|string|max:255',
        ]);

        //        $request->user()->paints()->create($validated);

        return redirect(route('regiments.index'));
    }

    /**
     * Display the specified resource.
     */
    //    public function show(Paint $paint) {}

    /**
     * Show the form for editing the specified resource.
     */
    //    public function edit(Paint $paint) {}

    /**
     * Update the specified resource in storage.
     */
    //    public function update(Request $request, Paint $paint): RedirectResponse
    //    {
    //        Gate::authorize('update', $paint);
    //        $validated = $request->validate([
    //            'brand' => 'required|string|max:255',
    //        ]);
    //        $paint->update($validated);
    //
    //        return redirect(route('paints.index'));
    //    }

    /**
     * Remove the specified resource from storage.
     */
    //    public function destroy(Paint $paint): RedirectResponse
    //    {
    //        Gate::authorize('delete', $paint);
    //        $paint->delete();
    //
    //        return redirect(route('paints.index'));
    //    }
}
