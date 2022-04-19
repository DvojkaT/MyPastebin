<?php

namespace App\Repositories\Abstracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Prettus\Repository\Contracts\RepositoryInterface;

interface PasteRepository extends RepositoryInterface
{
    public function filter(?int $user_id = null, ?string $permission = null, ?bool $pagination = false): LengthAwarePaginator | Collection;
}
