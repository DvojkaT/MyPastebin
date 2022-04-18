<?php

namespace App\Services;

use App\Models\Paste;
use App\Repositories\Abstracts\PasteRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Services\Abstracts\PasteServiceInterface;
use Illuminate\Database\Eloquent\Collection;
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
        $publicPastes = $this->repository->orderBy("created_at", 'desc')->findWhere([
            'permission' => 'public'
        ])->take(10);
        return $publicPastes;
    }

    public function getPrivatePastes(?int $user_id): Collection
    {
        $privatePastes = $this->repository->orderBy("created_at", 'desc')->findWhere([
            'author_id' => $user_id
        ])->take(10);
        return $privatePastes;
    }
}
