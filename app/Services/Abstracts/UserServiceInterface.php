<?php
namespace App\Services\Abstracts;

use App\Http\Requests\RegisterRequest;
use App\Models\User;

interface UserServiceInterface
{
    public function CreateUser(array $fields, int $user_id): User;
}
