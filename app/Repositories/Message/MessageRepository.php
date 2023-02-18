<?php

namespace App\Repositories\Message;

use App\Models\Message;
use Prettus\Repository\Eloquent\BaseRepository;

class MessageRepository extends BaseRepository implements MessageRepositoryInterface
{

    public function model(): string
    {
        return Message::class;
    }
}
