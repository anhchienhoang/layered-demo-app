<?php

namespace DemoApp\Core\Component\User\Service;

use DemoApp\Core\Component\User\Dto\UserView;
use DemoApp\Core\Component\User\Model\User;
use DemoApp\Core\Component\User\Model\UserRepository;

class UserService
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @var UserView
     */
    protected $userView;

    /**
     * @param UserRepository $userRepository
     * @param UserView       $userView
     */
    public function __construct(UserRepository $userRepository, UserView $userView)
    {
        $this->userRepository = $userRepository;
        $this->userView = $userView;
    }

    /**
     * @param CreateUserRequest $request
     *
     * @return bool
     */
    public function createUser(CreateUserRequest $request): int
    {
        $user = User::create(
            $request->getFirstName(),
            $request->getLastName(),
            $request->getEmail(),
            $request->getAddress()
        );

        return $this->userRepository->add($user);
    }

    /**
     * @param GetUserRequest $request
     *
     * @return UserView
     */
    public function getUser(GetUserRequest $request): UserView
    {
        $user = $this->userRepository->get($request->getUserId());

        $this->userView->write($user);

        return $this->userView;
    }
}