<?php

namespace App\Http\Controllers;

use App\Models\Torrent;
use App\Http\Requests\TorrentRequest;
use App\Models\Category;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TorrentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('torrents.create')->with(compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TorrentRequest $request)
    {
        // dd($request);
        $file = $request->file('filename');
        
        // echo $file->getRealPath();
        $torrent = Auth::user()
            ->uploads()
            ->create($request->all());

        return redirect()
            ->route('torrent.details', $torrent);

        $destinationPath = 'storage';
        $file->move($destinationPath, $file->getClientOriginalName());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Torrent  $torrent
     * @return \Illuminate\Http\Response
     */
    public function show(Torrent $torrent)
    {
        $ratings = $torrent->ratings();
        $avgRating = $ratings->count() == 0 ? 0 : $ratings->avg();


        return view('torrents.show')->with(compact('torrent', 'avgRating'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Torrent  $torrent
     * @return \Illuminate\Http\Response
     */
    public function edit(Torrent $torrent)
    {
        // $rating = $torrent->ratings()->avg();
        $categories = Category::orderBy('name')->get();

        return view('torrents.edit')->with(compact('torrent', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Torrent  $torrent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Torrent $torrent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Torrent  $torrent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Torrent $torrent)
    {
        //
    }

    public function rate(Request $request, Torrent $torrent)
    {
        $request->validate([
            'rating' => 'required|min:1|max:5'
        ]);

        $rating = new Rating;
        $rating->user_id = Auth::user()->id;
        $rating->rating = $request->rating;
        $torrent->ratings()->save($rating);
    }
}
