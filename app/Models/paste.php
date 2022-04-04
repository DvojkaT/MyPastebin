<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;


class paste extends Model
{
    use HasFactory, Prunable;

    public static function createNew(Request $request)
    {
        $paste = new paste;
        $paste->code = $request->get('code');
        $paste->name = $request->get('pastename');
        $paste->hash = Uuid::uuid4()->toString();
        $paste->author_id = Auth::id();
        $paste->permission = $request->get('permission');
        $paste->expiration_date = Carbon::now()->addMinutes($request->get('expiration_date'));

        $paste->save();

        return $paste;
    }
    public function prunable()
    {
        return static::where('expiration_date', '<=', now());
    }

}
