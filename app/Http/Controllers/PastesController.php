<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasteRequest;
use Illuminate\Support\Facades\Auth;
use Highlight\Highlighter;
use App\Models\Paste;
use App\Services\Abstracts\PasteServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class PastesController extends Controller
{
    public PasteServiceInterface $service;

    public function __construct(PasteServiceInterface $service)
    {
        $this->service = $service;
    }

    public function post(PasteRequest $request)
    {
        $paste = paste::createNew($request);
        return redirect()->route('show', $paste->hash);
    }

    public function show($hash)
    {
        $publicPastes = $this->service->getPublicPastes();
        $privatePastes = $this->service->getPrivatePastes(Auth::id());
        try {
            $paste = $this->service->getPaste($hash, Auth::id());
        } catch (ModelNotFoundException) {
            return view('home', ['publicPaste'=>$publicPastes, 'privatePaste'=>$privatePastes])->withErrors(['Данная паста либо была удалена, либо не существует']);
        } catch (AccessDeniedException) {
            return view('home', ['publicPaste'=>$publicPastes, 'privatePaste'=>$privatePastes])->withErrors(['Паста на которую вы пытались зайти приватная']);
        }

        if ($paste->language != "")
        {
            $highlighter = new highlighter();
            $highlighted = $highlighter->highlight($paste->language, $paste->code);
            $paste->code = "";
        }

        if ($paste->language != "") {
            return view('show', ['hcode'=>$highlighted, 'data'=>$paste, 'publicPaste'=>$publicPastes, 'privatePaste'=>$privatePastes]);
        }
        else return view('show', ['hcode'=>$paste, 'data'=>$paste, 'publicPaste'=>$publicPastes, 'privatePaste'=>$privatePastes]);
        
    }

    public function myPastes() {
        $publicPaste = Paste::where('permission', '=' , 'public')->latest()->take(10)->get();

        $paste = Paste::where('author_id', '=' , Auth::id())->latest()->paginate(10);
        return view('mypastes', ['paste'=>$paste, 'publicPaste'=>$publicPaste]);
    }

    public function homePastes() {
        $publicPaste = Paste::where('permission', '=' , 'public')->latest()->take(10)->get();
        $privatePastes = Paste::where('author_id', '=' , Auth::id())->latest()->take(10)->get();
        return view('home', ['publicPaste'=>$publicPaste, 'privatePaste'=>$privatePastes]);
    }

}
