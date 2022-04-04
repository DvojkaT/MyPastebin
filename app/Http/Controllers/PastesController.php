<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasteRequest;
use Illuminate\Support\Facades\Auth;
use Redirect;
use App\Models\paste;
use DB;

class PastesController extends Controller
{
    public function post(PasteRequest $request)
    {
        $paste = paste::createNew($request);
        return redirect()->route('show', $paste->hash);
    }

    public function show($hash)
    {
        $paste = new paste;
        $paste->code = DB::table('pastes')->where('hash', '=', $hash)->value('code');
        $paste->name = DB::table('pastes')->where('hash', '=', $hash)->value('name');
        $paste->author_id = DB::table('pastes')->where('hash', '=', $hash)->value('author_id');
        $publicPaste = paste::where('permission', '=' , 'public')->latest()->paginate(5);
        $privatePaste = paste::where('author_id', '=' , Auth::id())->latest()->paginate(5);
        return view('show', ['data'=>$paste, 'publicPaste'=>$publicPaste, 'privatePaste'=>$privatePaste]);
    }

    public function myPastes()
    {
        $publicPaste = paste::where('permission', '=' , 'public')->latest()->paginate(5);
        $paste = paste::where('author_id', '=' , Auth::id())->latest()->paginate(5);
        $privatePaste = paste::where('author_id', '=' , Auth::id())->latest()->paginate(5);
        return view('mypastes', ['paste'=>$paste, 'publicPaste'=>$publicPaste, 'privatePaste'=>$privatePaste]);
    }

    public function publicPastes()
    {
        $publicPaste = paste::where('permission', '=' , 'public')->latest()->paginate(5);
        $privatePaste = paste::where('author_id', '=' , Auth::id())->latest()->paginate(5);
        return view('home', ['publicPaste'=>$publicPaste, 'privatePaste'=>$privatePaste]);
    }
    public function privatePastes()
    {
        $privatePaste = paste::where('author_id', '=' , Auth::id())->latest()->paginate(5);
        return view('home', compact('privatePaste'));
    }

}
