<?php

namespace App\Repositories\User;

use App\Models\User;
use Prettus\Repository\Eloquent\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{

    public function model()
    {
        return User::class;
    }

    public function findByPhone(string $phone)
    {
        $this->applyCriteria();
        $this->applyScope();

        $this->applyConditions([
            'phone' => $phone,
        ]);

        $model = $this->model->first();

        $this->resetModel();

        return $this->parserResult($model);
    }
}
