<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasteRequest;
use Illuminate\Support\Facades\Auth;
use Highlight\Highlighter;
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
        $paste->language = DB::table('pastes')->where('hash', '=', $hash)->value('language');
        if($paste->language <> "")
        {
            $highlighter = new highlighter();
            $paste->code = DB::table('pastes')->where('hash', '=', $hash)->value('code');
            $highlighted = $highlighter->highlight($paste->language, $paste->code);
            $paste->code = "";
        }
        else
        {
            $paste->code = DB::table('pastes')->where('hash', '=', $hash)->value('code');
        }
        $paste->name = DB::table('pastes')->where('hash', '=', $hash)->value('name');
        $paste->author_id = DB::table('pastes')->where('hash', '=', $hash)->value('author_id');
        $publicPaste = paste::where('permission', '=' , 'public')->latest()->paginate(5);
        $privatePaste = paste::where('author_id', '=' , Auth::id())->latest()->paginate(5);

        if(!DB::table('pastes')->where('hash', '=', $hash)->exists())
        {
            return view('home', ['publicPaste'=>$publicPaste, 'privatePaste'=>$privatePaste])->withErrors(['Данная паста либо была удалена, либо не существует']);
        }

        $pastePrivacyCheck = DB::table('pastes')->where('hash', '=', $hash)->value('permission');
        if($pastePrivacyCheck == "private" && $paste->author_id <> Auth::id()){
            return view('home', ['publicPaste'=>$publicPaste, 'privatePaste'=>$privatePaste])->withErrors(['Паста на которую вы пытались зайти приватная']);
        }
        if($paste->language <> ""){ return view('show', ['hcode'=>$highlighted, 'data'=>$paste, 'publicPaste'=>$publicPaste, 'privatePaste'=>$privatePaste]);}
        else return view('show', ['hcode'=>$paste, 'data'=>$paste, 'publicPaste'=>$publicPaste, 'privatePaste'=>$privatePaste]);
        
    }

    public function myPastes()
    {
        $privatePaste = paste::where('author_id', '=' , Auth::id())->latest()->paginate(5);
        $publicPaste = paste::where('permission', '=' , 'public')->latest()->paginate(5);

        $paste = paste::where('author_id', '=' , Auth::id())->latest()->paginate(5);
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
