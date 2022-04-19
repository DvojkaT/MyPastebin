<?php

namespace App\Repositories;

use App\Models\Paste;
use App\Repositories\Abstracts\PasteRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;

class PasteRepositoryEloquent extends BaseRepository implements PasteRepository
{
    public function model()
    {
        return Paste::class;
    }

    public function filter(?int $user_id = null, ?string $permission = null, ?bool $pagination = false): LengthAwarePaginator | Collection
    {
        /** @var Builder $builder */
        $builder = $this->model;

        if ($user_id) {
            $builder = $builder->where('author_id', '=', $user_id);
        }
        if ($permission) {
            $builder = $builder->where('permission', '=', $permission);
        }

        $builder = $builder->orderBy("created_at", 'desc');

        if ($pagination) {
            return $builder->paginate(10);
        }
        else {
            return $builder->take(10)->get();
        }
    }
}
