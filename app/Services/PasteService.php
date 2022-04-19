<?php

namespace App\Services;

use App\Models\Paste;
use App\Repositories\Abstracts\PasteRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Services\Abstracts\PasteServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Ramsey\Uuid\Uuid;
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

    public function createPaste(array $fields, int $user_id): Paste
    {
        return $this->repository->create([
            'code' => $fields['code'],
            'name' => $fields['pastename'],
            'hash' => Uuid::uuid4()->toString(),
            'author_id' => $user_id,
            'permission' => $fields['permission'],
            'expiration_date' => Carbon::now()->addMinutes($fields['expiration_date']),
            'language' => $fields['language'],
        ]);















    }
}
