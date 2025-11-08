<?php

namespace app\commands;

use app\models\User;
use yii\console\Controller;

class SeederController extends Controller
{
    public function actionInit(): void
    {
        $user = new User();
        $user->save();
    }
}
