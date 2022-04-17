<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasteRequest;
use Illuminate\Support\Facades\Auth;
use Highlight\Highlighter;
use Redirect;
use App\Models\Paste;
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
        $publicPaste = Paste::where('permission', '=' , 'public')->latest()->take(10)->get();
        $privatePaste = Paste::where('author_id', '=' , Auth::id())->latest()->take(10)->get();

        if(!$paste = Paste::query()->where('hash', '=', $hash)->first(['language', 'code', 'name', 'author_id', 'permission']))
        return view('home', ['publicPaste'=>$publicPaste, 'privatePaste'=>$privatePaste])->withErrors(['Данная паста либо была удалена, либо не существует']);

        if($paste->language != "")
        {
            $highlighter = new highlighter();
            $highlighted = $highlighter->highlight($paste->language, $paste->code);
            $paste->code = "";
        }

        if($paste->permission == "private" && $paste->author_id != Auth::id()){
            return view('home', ['publicPaste'=>$publicPaste, 'privatePaste'=>$privatePaste])->withErrors(['Паста на которую вы пытались зайти приватная']);
        }
        if($paste->language != ""){ return view('show', ['hcode'=>$highlighted, 'data'=>$paste, 'publicPaste'=>$publicPaste, 'privatePaste'=>$privatePaste]);}
        else return view('show', ['hcode'=>$paste, 'data'=>$paste, 'publicPaste'=>$publicPaste, 'privatePaste'=>$privatePaste]);
        
    }

    public function myPastes()
    {
        $publicPaste = Paste::where('permission', '=' , 'public')->latest()->take(10)->get();

        $paste = Paste::where('author_id', '=' , Auth::id())->latest()->paginate(10);
        return view('mypastes', ['paste'=>$paste, 'publicPaste'=>$publicPaste]);
    }

    public function homePastes()
    {
        $publicPaste = Paste::where('permission', '=' , 'public')->latest()->take(10)->get();
        $privatePaste = Paste::where('author_id', '=' , Auth::id())->latest()->take(10)->get();
        return view('home', ['publicPaste'=>$publicPaste, 'privatePaste'=>$privatePaste]);
    }

}
