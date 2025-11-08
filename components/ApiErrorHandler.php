<?php

namespace app\components;

use app\exceptions\UserAlreadyHasApprovedRequestException;
use yii\web\ErrorHandler;
use Yii;
use Symfony\Component\HttpFoundation\Response;

class ApiErrorHandler extends ErrorHandler
{
    protected function renderException($exception): void
    {
        if ($exception instanceof UserAlreadyHasApprovedRequestException) {
            $response = Yii::$app->getResponse();
            $response->setStatusCode(Response::HTTP_BAD_REQUEST);
            $response->data = ['result' => false];

            $response->send();
        } else {
            parent::renderException($exception);
        }
    }
}