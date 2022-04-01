<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasteRequest;
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
        return view('show', ['data'=>$paste]);
    }
}
