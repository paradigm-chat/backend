<?php

namespace App\Exceptions;

use Exception;

class ModelNotFoundException extends Exception
{
    protected $model;

    public function render($request)
    {
        $name = (new $this->model)->getTable();
        return $request->expectsJson()
            ? apiResponse(false, ["$name.not_found"])
            : back()->withErrors([
                'msg' => "$name.not_found",
            ]);
    }

    /**
     * @param $model
     * @return ModelNotFoundException
     */
    public function setModel($model): self
    {
        $this->model = $model;
        return $this;
    }
}
