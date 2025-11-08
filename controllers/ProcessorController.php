<?php

namespace app\controllers;

use app\services\ProcessorService;
use yii\rest\Controller;

class ProcessorController extends Controller
{
    public function actionProcessor(ProcessorService $service, int $delay = 0): array
    {
        $service->processRequests($delay);

        return ['result' => true];
    }
}
