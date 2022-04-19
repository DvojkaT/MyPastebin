<?php

namespace App\Services;

use App\Models\Paste;
use App\Repositories\Abstracts\PasteRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Services\Abstracts\PasteServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class PasteService implements PasteServiceInterface
{
    public PasteRepository $repository;

    public function __construct(PasteRepository $repository)
    {
        $this->repository = $repository;
    }


    public function getPaste(string $hash, ?int $user_id): Paste
    {
        $paste = $this->repository->findWhere([
            'hash' => $hash,
        ])->first();
        if (!$paste) {
            throw new ModelNotFoundException();
        }

        if ($paste->permission == "private" && $paste->author_id != $user_id) {
            throw new AccessDeniedException();
        }

        return $paste;
    }

    public function getPublicPastes(): Collection
    {
        return $this->repository->filter(null,'public');
    }

    public function getPrivatePastes(?int $user_id): Collection
    {
        return $this->repository->filter($user_id);
    }

    public function getMyPastes(int $user_id): LengthAwarePaginator
    {
        return $this->repository->filter($user_id,null, true);
    }
}
