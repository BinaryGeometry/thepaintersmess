<?php

namespace App\Http\Controllers;

use App\Models\Paint;
use Auth;
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
        $paints = Paint::where('user_id', Auth::user()->id)
            ->latest()->paginate(5)
            ->through(function ($item) {
                return [
                    'id' => $item->id,
                    'user_id' => $item->user_id,
                    'brand' => $item->brand,
                    'range' => $item->range,
                    'color_hex' => $item->color_hex,
                    'paint_name' => $item->paint_name,
                    'thumbnail' => $item->thumbnail,
                ];
            }); // //Creator of Inertia.js here.https://stackoverflow.com/questions/66846136/laravel-inertia-vuejs-pagination

        return Inertia::render('Paints/Index', [
            'paints' => $paints,
        ]);

    }

    public function image(Paint $paint)
    {
        // get the image named $slug from storage and display it

        // Something like (not sure)
        //        Paint::with('user:id,name')->latest()->get(),
        $image = storage_path('/app/private/'.$paint->thumbnail);
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

        $laptop = Paint::create([
            'user_id' => Auth::user()->id,
            'brand' => $formData['brand'], // e.g. Citadel, Army Painter, Vallejo
            'range' => $formData['range'], // e.g Layer, Color Primer, Model Air
            'paint_name' => $formData['paint_name'], // e.g Admiistratum Grey, Ash Grey,  Brown Grey
            'paint_ref' => $formData['paint_ref'], // e.g NULL, NULL, RAL7050
            'color_name' => $formData['color_name'], // Grey, Blue, Brown Grey
            'color_hex' => $formData['color_hex'], // Grey, Blue, Brown Grey
            'paint_type' => $formData['paint_type'],
            'thumbnail' => $imagePath,
        ])->id;

        //        $validated = $request->validate([
        //            'brand' => 'required|string|max:255',
        //        ]);

        //        $request->user()->paints()->create($validated);

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
        //        $validated = $request->validate([
        //            'brand' => 'required|string|max:255',
        //        ]);
        $imagePath = null;
        if ($request->hasFile('thumbnail')) {
            $imagePath = $request->file('thumbnail')->store('paints'); // http://www.netzgesta.de/mapper/
        }

        $formData = $request->request->all();

        $updateData = [
            'brand' => $formData['brand'], // e.g. Citadel, Army Painter, Vallejo
            'range' => $formData['range'], // e.g Layer, Color Primer, Model Air
            'paint_name' => $formData['paint_name'], // e.g Admiistratum Grey, Ash Grey,  Brown Grey
            'paint_ref' => $formData['paint_ref'], // e.g NULL, NULL, RAL7050
            'color_name' => $formData['color_name'], // Grey, Blue, Brown Grey
            'color_hex' => $formData['color_hex'], // Grey, Blue, Brown Grey
            'paint_type' => $formData['paint_type'],
            'thumbnail' => $imagePath,
        ];

        $paint->update($updateData);

        return redirect(route('paints.index')); // https://stackoverflow.com/questions/23505875/laravel-routeresource-vs-routecontroller // https://laracasts.com/discuss/channels/inertia/inertia-detect-api-request-303-in-nuxt-js-and-laravel
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
