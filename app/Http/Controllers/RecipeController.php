<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Auth;
use DB;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($gameId, $factionId, $armyId, $unitId, Request $request): Response
    {
        //        dd($gameId, $factionId, $armyId, $unitId);

        $units =
            DB::table('regiments')->whereNotNull('first_name')
                ->where('regiments.user_id', '=', Auth::user()->id)
                ->whereNotNull('regiments.user_id')
                ->select('regiments.id',
                    'regiments.name',
                    'regiments.thumbnail',
                    'regiments.unit_id as army_id',
                    'army.name as army_name',
                    'game.name as game_name',
                    'game.id as game_id',
                    'faction.id as faction_id',
                    'faction.name  AS faction_name')
                ->join('regiments as army', 'army.id', '=', 'regiments.unit_id')
                ->join('item as game', 'game.id', '=', 'army.game_id')
                ->join('item AS faction', 'faction.id', '=', 'army.faction_id')
                ->get()
                ->toArray();

        $games = [];
        $gameIds = [];
        foreach ($units as $unit) {
            if (! in_array($unit->game_id, $gameIds)) {
                $games[] = [
                    'id' => $unit->game_id,
                    'name' => $unit->game_name,
                    'factions' => [],
                ];
                $gameIds[] = $unit->game_id;
            }
        }

        $factions = [];
        $factionIds = [];
        foreach ($units as $unit) {
            if (! in_array($unit->faction_id, $factionIds)) {
                $factions[] = [
                    'id' => $unit->faction_id,
                    'name' => $unit->faction_name,
                    'game_id' => $unit->game_id,
                    'armys' => [],
                ];
                $factionIds[] = $unit->faction_id;
            }
        }

        $armys = [];
        $armyIds = [];
        foreach ($units as $unit) {
            if (! in_array($unit->army_id, $armyIds)) {
                $armys[] = [
                    'id' => $unit->army_id,
                    'name' => $unit->army_name,
                    'faction' => $unit->faction_name,
                    'faction_id' => $unit->faction_id,
                    'game' => $unit->game_name,
                    'game_id' => $unit->game_id,
                    'units' => [$unit],
                ];
                $armyIds[] = $unit->army_id;
            }
        }

        foreach ($armys as $key => $army) {
            $armyUnits = array_filter($units, function ($unit) use ($army) {
                return $army['id'] == $unit->army_id;
            });
            $armys[$key]['units'] = $armyUnits;
        }

        foreach ($factions as $key => $faction) {
            $factionArmys = array_filter($armys, function ($army) use ($faction) {
                return $faction['id'] == $army['faction_id'];
            });
            $factions[$key]['armys'] = $factionArmys;
        }

        foreach ($games as $key => $game) {
            $gameFactions = array_filter($factions, function ($faction) use ($game) {
                return $game['id'] == $faction['game_id'];
            });
            $games[$key]['factions'] = $gameFactions;
        }
        //        $json_path = File::get(storage_path('/app/private/interface.json'));

        return Inertia::render('Recipes/Index', [
            //            'units' => $units,
            //            'armys' => $armys,
            'games' => $games, // https://vuejs.org/guide/best-practices/accessibility.html#skip-link
            'state' => [ // https://stackoverflow.com/questions/74103939/inertia-get-request-does-not-update-page-props
                'gameId' => $gameId,
                'armyId' => $armyId,
                'factionId' => $factionId,
                'unitId' => $unitId,
            ],
            //            'instance' => json_decode($json_path, true),
        ]);
    }

    /**
     * Get the image named $slug from storage and display it
     */
    public function image(Recipe $recipe)
    {

        $image = storage_path('/app/private/'.$recipe->thumbnail);

        return response()->download($image);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //  // https://github.com/inertiajs/inertia/discussions/1174
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Recipe $recipe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recipe $recipe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Recipe $recipe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipe $recipe)
    {
        //
    }
}
