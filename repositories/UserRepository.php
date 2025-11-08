<?php

namespace app\repositories;

use app\models\User;
use yii\db\BatchQueryResult;

class UserRepository
{
    public function each(array $where = []): BatchQueryResult
    {
        return User::find()
            ->where($where)
            ->each();
    }
}
