<?php

namespace App\Http\Controllers;

use App\Models\Torrent;
use App\Models\Category;
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
    public function create(Request $request)
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
    public function store(Request $request)
    {
        $torrent = Auth::user()
            ->uploads()
            ->create($request->all());

        return redirect()
            ->route('post.details', $torrent);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Torrent  $torrent
     * @return \Illuminate\Http\Response
     */
    public function show(Torrent $torrent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Torrent  $torrent
     * @return \Illuminate\Http\Response
     */
    public function edit(Torrent $torrent)
    {
        //
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
}
