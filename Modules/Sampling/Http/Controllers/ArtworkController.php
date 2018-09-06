<?php

namespace Modules\Sampling\Http\Controllers;

use Modules\Sampling\Entities\Artwork;
use Modules\Sampling\Entities\Position;
use Modules\Sampling\Http\Requests\CreateArtworkRequest;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class ArtworkController extends Controller
{
    private $position;

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {

        $artwork = DB::table('artworks')
            ->join('positions', 'artworks.id', '=', 'positions.artwork_id')
            ->leftJoin('combos', 'positions.id', '=', 'combos.position_id')
            ->leftJoin('artwork_images', 'artworks.id', '=', 'artwork_images.artwork_id')
            ->select('artworks.*', 'artwork_images.filepath',
                'positions.name', 'combos.name as combo_name',
                'combos.color as combo_color')
            ->paginate(10);
        dd($artwork);
        return response()->json(Artwork::paginate(10));
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
        $artwork = Artwork::create($request->except(['artworkDetails']));
        $artwork_details = $request->only('artworkDetails');
        foreach ($artwork_details['artworkDetails'] as $artwork_detail) {
            foreach ($artwork_detail as $key => $value) {
                if ($key === 'position')
                    $this->position = $artwork->positions()->create(['name' => $value]);
                else
                    !is_null($value) ? $this->position->combos()->create(['name' => $key, 'color' => $value]) : '';
            }
        }
        return response()->json($artwork->id);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('sampling::show');
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
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
