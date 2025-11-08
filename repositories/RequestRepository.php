<?php

namespace app\repositories;

use app\models\Request;
use yii\db\BatchQueryResult;
use app\enums\request\StatusEnum;

class RequestRepository
{
    public function create(array $data): Request
    {
        $model = new Request();

        foreach ($data as $field => $value) {
            $model->setAttribute($field, $value);
        }

        $model->save(false);

        return $model;
    }

    public function exists(array $where): bool
    {
        return Request::find()->where($where)->exists();
    }

    public function existsApprovedByUserId(int $userId): bool
    {
        return $this->exists(['user_id' => $userId, 'status' => StatusEnum::Approved]);
    }

    public function findApprovedByUserIdLock(int $userId): ?Request
    {
        $sql = "
            SELECT * FROM requests 
            WHERE [[user_id]] = :userId AND [[status]] = 'approved' 
            LIMIT 1 
            FOR UPDATE
        ";

        return Request::findBySql($sql, [':userId' => $userId])->one();
    }

    public function each(array $where): BatchQueryResult
    {
        return Request::find()
            ->where($where)
            ->each();
    }

    public function eachPendingByUserId(int $userId): BatchQueryResult
    {
        return $this->each(['user_id' => $userId, 'status' => StatusEnum::Pending]);
    }

    public function update(array $where, array $data): bool
    {
        $query = Request::findOne($where);

        foreach ($data as $field => $value) {
            $query->setAttribute($field, $value);
        }

        return $query->save(false);
    }
}
