<?php

namespace DemoApp\Core\Component\User\Service;

class GetUserRequest
{
    /**
     * @var int
     */
    protected $userId;

    /**
     * @param int $userId
     */
    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }
}