<?php

namespace Modules\Sampling\Http\Controllers;

use Modules\Sampling\Entities\Artwork;
use Modules\Sampling\Entities\Combo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Filters\ComboFilter;

class ArtworkController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(ComboFilter $filter)
    {
        $artwork = Combo::with('position.artwork.artwork_images')
            ->filter($filter)
            ->paginate(10);
        return response()->json($artwork);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('sampling::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $artwork = Artwork::create($request->except(['positions']));
        foreach ($request->positions as $position) {
            $newPosition = $artwork->positions()->create([
                'name' => $position['name']
            ]);
            foreach ($position['combos'] as $combo) {
                !is_null($combo['color']) ? $newPosition->combos()->create($combo) : '';
            }
        }
        return response()->json($artwork->id);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show($id)
    {
        $artwork = Artwork::with('positions.combos')->where('id', '=', $id)->first();
        return response()->json($artwork);
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('sampling::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    {

        $artwork = Artwork::find($id);
        $artwork->update(['reference_number' => $request->reference_number,
            'client_name' => $request->client_name,
            'division' => $request->division,
            'date' => $request->date,
            'description' => $request->description,
            'note' => $request->note]);
        $artwork->combos()->delete();
        $artwork->positions()->delete();

        foreach ($request->positions as $position) {
            $newPosition = $artwork->positions()->create([
                'name' => $position['name']
            ]);
            foreach ($position['combos'] as $combo) {
                !is_null($combo['color']) ? $newPosition->combos()->create($combo) : '';
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
