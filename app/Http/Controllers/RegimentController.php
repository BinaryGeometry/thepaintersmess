<?php

namespace App\Http\Controllers;

use App\Models\Regiment;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class RegimentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        $regiments = DB::table('regiments')
            ->whereNull('regiments.unit_id')
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

        $choices = DB::select('
            select
                i.slug,
                i.id as ancestor_id,
                i_game.name as text,
                i_game.id as value
            from item i
            join item i_game on i.id = i_game.parent_id
            where i.parent_id IS NULL
        '); // where active = ?', [1]);

        return Inertia::render('Regiments/Index', [
            'regiments' => $regiments,
            'choices' => $choices,
        ]);

    }

    /**
     * Get the image named $slug from storage and display it
     */
    public function image(Regiment $regiment)
    {

        $image = storage_path('/app/private/'.$regiment->thumbnail);

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
            $imagePath = $request->file('thumbnail')->store('regiments'); // http://www.netzgesta.de/mapper/
        }

        $formData = $request->request->all();

        $storeData = [
            'name' => $formData['name'],
            'game_id' => (int) $formData['game_id'], // e.g Layer, Color Primer, Model Air
            'faction_id' => (int) $formData['faction_id'], // e.g Admiistratum Grey, Ash Grey,  Brown Grey
            'detachment_id' => (int) $formData['detachment_id'], // e.g NULL, NULL, RAL7050
            //            'unit_id' => $formData['unit_id'] || '', // Grey, Blue, Brown Grey
            'user_id' => Auth::user()->id,
            'thumbnail' => $imagePath,
        ];

        $laptop = Regiment::create($storeData)->id;

        return redirect(route('regiments.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Regiment $regiment) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Regiment $regiment) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Regiment $regiment): RedirectResponse
    {
        Gate::authorize('update', $regiment);

        $imagePath = null;
        if ($request->hasFile('thumbnail')) {
            $imagePath = $request->file('thumbnail')->store('regiments'); // http://www.netzgesta.de/mapper/
        }

        $formData = $request->request->all();

        $updateData = [
            //            'slug' => $formData['slug'], // e.g. Citadel, Army Painter, Vallejo
            'game_id' => $formData['game_id'], // e.g Layer, Color Primer, Model Air
            'faction_id' => $formData['faction_id'], // e.g Admiistratum Grey, Ash Grey,  Brown Grey
            'detachment_id' => $formData['detachment_id'], // e.g NULL, NULL, RAL7050
            //            'unit_id' => $formData['unit_id'], // Grey, Blue, Brown Grey
            //            'meta' => $formData['meta'], // Grey, Blue, Brown Grey
            'name' => $formData['name'],
            'thumbnail' => $imagePath,
        ];

        $regiment->update($updateData);

        //        $validated = $request->validate([
        //            'brand' => 'required|string|max:255',
        //        ]);
        //        $paint->update($validated);

        return redirect(route('regiments.index'));
    }

    /**
     * Display a listing of the resource.
     */
    public function units(Request $request, Regiment $regiment): JsonResponse
    {
        // https://dev.to/bradisrad83/proper-json-responses-for-laravel-api-2jfo
        $units = DB::table('regiments')
            ->where('regiments.unit_id', '=', $regiment->id)->get();

        return response()->json($units);
    }

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
