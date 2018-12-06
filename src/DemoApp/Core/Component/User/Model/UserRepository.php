<?php

namespace DemoApp\Core\Component\User\Model;

interface UserRepository
{
    public function add(User $user): int;

    public function get(int $id): User;
}