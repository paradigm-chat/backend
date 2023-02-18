<?php

namespace App\Repositories\Chat;

use App\Models\Chat;
use Prettus\Repository\Eloquent\BaseRepository;

class ChatRepository extends BaseRepository implements ChatRepositoryInterface
{

    public function model(): string
    {
        return Chat::class;
    }
}
