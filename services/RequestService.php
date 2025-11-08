<?php

namespace app\services;

use app\models\Request;
use app\repositories\RequestRepository;
use app\exceptions\UserAlreadyHasApprovedRequestException;

class RequestService
{
    public function __construct(
        protected RequestRepository $requestRepository,
    ) {
    }

    public function create(array $data): Request
    {
        if ($this->requestRepository->existsApprovedByUserId($data['user_id'])) {
            throw new UserAlreadyHasApprovedRequestException();
        }

        return $this->requestRepository->create($data);
    }
}
