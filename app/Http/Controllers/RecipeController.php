<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Inertia\Inertia;
use Inertia\Response;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        //        $paints = Paint::where('user_id', Auth::user()->id)
        //            ->latest()->paginate(5)
        //            ->through(function ($item) {
        //                return [
        //                    'id' => $item->id,
        //                    'user_id' => $item->user_id,
        //                    'brand' => $item->brand,
        //                    'range' => $item->range,
        //                    'color_hex' => $item->color_hex,
        //                    'paint_name' => $item->paint_name,
        //                    'thumbnail' => $item->thumbnail,
        //                ];
        //            }); // //Creator of Inertia.js here.https://stackoverflow.com/questions/66846136/laravel-inertia-vuejs-pagination
        //
        //        $image = storage_path('/app/private/interface.json);

        $json_path = File::get(storage_path('/app/private/interface.json'));

        return Inertia::render('Recipes/Index', [
            'instance' => json_decode($json_path, true),
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
