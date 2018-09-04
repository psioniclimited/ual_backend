<?php

namespace Modules\Sampling\Http\Controllers;

use Modules\Sampling\Entities\Artwork;
use Modules\Sampling\Entities\Position;
use Modules\Sampling\Http\Requests\CreateArtworkRequest;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class ArtworkController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('sampling::index');
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
//            if (!isN($artwork_detail['position'])) {
            $position = $artwork->positions()->create(['name' => $artwork_detail['position']]);
            $artwork_detail['a'] === '' ? $position->combos()->create(['name' => $artwork_detail['a']]) : '';
            $artwork_detail['b'] === '' ? $position->combos()->create(['name' => $artwork_detail['b']]) : '';
            $artwork_detail['c'] === '' ? $position->combos()->create(['name' => $artwork_detail['c']]) : '';
            $artwork_detail['d'] === '' ? $position->combos()->create(['name' => $artwork_detail['d']]) : '';
            $artwork_detail['e'] === '' ? $position->combos()->create(['name' => $artwork_detail['e']]) : '';
//            }
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
