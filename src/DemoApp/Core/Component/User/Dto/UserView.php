<?php

namespace DemoApp\Core\Component\User\Dto;

use DemoApp\Core\Component\User\Model\User;

class UserView
{
    /**
     * @var User
     */
    protected $user;

    /**
     * @param User $user
     */
    public function write(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return array
     */
    public function read(): array
    {
        return [
            'id' => $this->user->getId(),
            'firstName' => $this->user->getFirstName(),
            'lastName' => $this->user->getLastName(),
            'email' => $this->user->getEmail(),
            'address' => $this->user->getAddress(),
        ];
    }
}