<?php

namespace app\services;

use app\enums\request\StatusEnum;
use app\models\Request;
use app\repositories\RequestRepository;
use app\repositories\UserRepository;
use Exception;
use Yii;

class ProcessorService
{
    public function __construct(
        protected RequestRepository $requestRepository,
        protected UserRepository $userRepository,
    ) {
    }

    public function processRequests(int $delay): void
    {
        foreach ($this->userRepository->each() as $user) {
            foreach ($this->requestRepository->eachPendingByUserId($user->id) as $request) {
                $this->processSingleRequest($request, $delay);
            }
        }
    }

    protected function processSingleRequest(Request $request, int $delay): void
    {
        if ($delay > 0) {
            sleep($delay);
        }

        $transaction = Yii::$app->db->beginTransaction();

        try {
            $approvedRequest = $this->requestRepository->findApprovedByUserIdLock($request['user_id']);

            if (!is_null($approvedRequest)) {
                $newStatus = StatusEnum::Declined;
            } else {
                $randomNumber = mt_rand(1, 100);

                $newStatus = ($randomNumber <= 10) ? StatusEnum::Approved : StatusEnum::Declined;
            }

            $this->requestRepository->update(['id' => $request->id], ['status' => $newStatus]);

            $transaction->commit();
        } catch (Exception $exception) {
            $transaction->rollBack();

            Yii::error("Failed to process request with id {$request->id}: {$exception->getMessage()}");

            throw $exception;
        }
    }
}