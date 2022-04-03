<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;


class paste extends Model
{
    use HasFactory;

    public static function createNew(Request $request)
    {
        $paste = new paste;
        $paste->code = $request->get('code');
        $paste->name = $request->get('pastename');
        $paste->hash = Uuid::uuid4()->toString();
        $paste->author_id = Auth::id();
        $paste->permission = $request->get('permission');

        $paste->save();

        return $paste;
    }
}
