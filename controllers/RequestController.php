<?php

namespace app\controllers;

use app\models\RequestForm;
use app\services\RequestService;
use Yii;
use Symfony\Component\HttpFoundation\Response;
use yii\rest\Controller;

class RequestController extends Controller
{
    public function actionCreate(RequestService $service): array
    {
        $form = new RequestForm();

        $form->load(Yii::$app->getRequest()->post(), '');

        $response = Yii::$app->getResponse();

        if ($form->validate()) {
            $request = $service->create($form->getAttributes());

            $response->setStatusCode(Response::HTTP_CREATED);

            return [
                'result' => true,
                'id' => $request->id,
            ];
        }

        $response->setStatusCode(Response::HTTP_BAD_REQUEST);

        return ['result' => false];
    }
}
