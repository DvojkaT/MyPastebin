<?php
namespace App\Services\Abstracts;

use App\Models\Paste;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface PasteServiceInterface
{
    public function getPaste(string $hash, int $user_id): Paste;

    public function getPublicPastes(): Collection;

    public function getPrivatePastes(int $user_id): Collection;

    public function getMyPastes(int $user_id): LengthAwarePaginator;
}
