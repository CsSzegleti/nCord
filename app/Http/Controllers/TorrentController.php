<?php

namespace App\Http\Controllers;

use App\Models\Torrent;
use App\Http\Requests\TorrentRequest;
use App\Models\Category;
use Image;
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
        
        $file = $request->file('filename');
        $torrent = Auth::user()
            ->uploads()
            ->create([
                'uploader_id' => Auth::user()->id,
                'category_id' =>$request->category_id,
                'name' => $request->name,
                'description' => $request->description,
                'filename' => $file->getClientOriginalName(),
            ]);

        $destinationPath = 'storage';
        $file->move($destinationPath, $file->getClientOriginalName());

        return redirect()
            ->route('torrent.details', $torrent)
            ->with('success', __('Torrent uploaded'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Torrent  $torrent
     * @return \Illuminate\Http\Response
     */
    public function show(Torrent $torrent)
    {
        $avgRating = $torrent->getAvgRating();
        // $avgRating = 5; // because it is not working


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
        $torrent->update($request->all());

        return redirect()->route('torrent.edit', $torrent)
        ->with('success', __('Successful update'));
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
        $rating->message = $request->message;
        $rating->rating = $request->rating;

        $torrent->ratings()->save($rating);

        // $torrent->ratings()->attach(Auth::user()->id, ['rating' => $request->rating]);
        return back()
            ->with('success', __('Thank you for your feedback'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $torrents = Torrent::query()
            ->where('name', 'like', "%{$search}%")
            ->orWhere('description', 'LIKE', "%{$search}%")
            ->get();
        
        return view('torrents.search', compact('torrents'));
    }

    public function uploadImage(Request $request, Torrent $torrent)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $image = $request->file('image');
        $fileID = uniqid();
        $filename = "images/{$fileID}.{$image->extension()}";

        Image::make($image)->save(public_path("/storage/{$filename}"));

        $torrent->image = $filename;
        $torrent->save();

        return response()->json(['image' => $torrent->image ]);
    }
}
