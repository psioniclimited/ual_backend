<?php

namespace Modules\Sampling\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Sampling\Entities\Artwork;
use File;
use Modules\Sampling\Entities\ArtworkImage;

class ArtworkImageController extends Controller
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
     * @param Artwork $artwork
     * @return Response
     */
    public function store($artwork, Request $request)
    {
        $artwork = Artwork::find($artwork);
        $images = $request->file('artwork_images');
        foreach ($images as $key=>$image) {
            $filename = Carbon::now() . '_' . $key . '_' . $image->getClientOriginalName();
            $destination_path = storage_path('/images');
            $image->move($destination_path, $filename);
            $artwork->artwork_images()->create(['filepath' => $filename]);
        }
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show($id)
    {
        $path = storage_path('images/' . (ArtworkImage::find($id))->filepath);

        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
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
