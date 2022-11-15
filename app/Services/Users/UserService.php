<?php

namespace App\Services\Users;

use App\Models\User;

class UserService
{
    /**
     * @var \App\Models\User
     */
    protected $model;

    /**
     * set limit per page
     */
    CONST LIMIT = 10;

    /**
     * UserService constructor.
     * @param \App\Models\User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * @return mixed
     */
    public function getAllUserWithPagination()
    {
        return $this->model->paginate(self::LIMIT);
    }
}
