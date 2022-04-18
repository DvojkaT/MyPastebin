<?php

namespace App\Repositories;

use App\Models\Paste;
use App\Repositories\Abstracts\PasteRepository;
use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;

class PasteRepositoryEloquent extends BaseRepository implements PasteRepository
{
    public function model()
    {
        return Paste::class;
    }
}