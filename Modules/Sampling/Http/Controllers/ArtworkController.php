<?php

namespace Modules\Sampling\Http\Controllers;

use Modules\Sampling\Entities\Artwork;
use Modules\Sampling\Entities\Combo;
use Modules\Sampling\Entities\Position;
use Modules\Sampling\Http\Requests\CreateArtworkRequest;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use App\Filters\ArtworkFilter;

class ArtworkController extends Controller
{
    private $position;

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request, ArtworkFilter $filter)
    {

        $artwork = Combo::with('position.artwork.artwork_images')
            ->paginate(10);

//        $artwork = DB::table('combos')
//            ->join('positions','combos.position_id','=','positions.id')
//            ->join('artworks','positions.artwork_id','=','artworks.id')
//            ->paginate($request->per_page);

//        dd($artwork);
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
