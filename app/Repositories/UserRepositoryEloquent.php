<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Abstracts\UserRepository;
use Prettus\Repository\Eloquent\BaseRepository;

class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    public function model()
    {
        return User::class;
    }
}
