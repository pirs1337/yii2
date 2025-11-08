<?php

namespace app\models;

use yii\base\Model;

class RequestForm extends Model
{
    public $user_id;
    public $amount;
    public $term;

    public function rules(): array
    {
        return [
            [['user_id', 'amount', 'term'], 'required'],
            ['user_id', 'integer'],
            ['term', 'integer', 'min' => 1],
            ['amount', 'number', 'min' => 1],
            [
                'user_id',
                'exist',
                'targetClass' => User::class,
                'targetAttribute' => ['user_id' => 'id'],
            ],
        ];
    }
}
