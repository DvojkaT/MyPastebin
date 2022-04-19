<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;

class Paste extends Model
{
    use HasFactory, Prunable;

    protected $guarded = [];

    public function prunable()
    {
        return static::where('expiration_date', '<=', now());
    }
}
