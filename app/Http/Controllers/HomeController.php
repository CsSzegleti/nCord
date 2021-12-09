<?php

namespace App\Http\Controllers;

use App\Models\Torrent;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $torrents = Torrent::orderBy('created_at', 'desc')->paginate(10);

        return view('home')->with(compact('torrents'));
    } 
}
