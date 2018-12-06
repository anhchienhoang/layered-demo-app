<?php

namespace DemoApp\Infrastructure\Framework\Symfony\Controller;

use DemoApp\Core\Component\User\Service\CreateUserRequest;
use DemoApp\Core\Component\User\Service\GetUserRequest;
use DemoApp\Core\Component\User\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends AbstractController
{
    public function index()
    {
        return new JsonResponse('Hello World!');
    }

    /**
     * @param Request     $request
     * @param UserService $userService
     *
     * @return JsonResponse
     */
    public function createUser(Request $request, UserService $userService)
    {
        $data = json_decode($request->getContent(), true);

        $createUserRequest = new CreateUserRequest(
            $data['firstName'],
            $data['lastName'],
            $data['email'],
            $data['address']
        );

        $id = $userService->createUser($createUserRequest);

        return new JsonResponse(
            [
                'status' => 'success',
                'id' => $id,
            ]
        );
    }

    /**
     * @param int         $id
     * @param UserService $userService
     *
     * @return mixed|JsonResponse
     */
    public function getUserData(int $id, UserService $userService)
    {
        $getUserRequest = new GetUserRequest($id);
        $userDto = $userService->getUser($getUserRequest);

        return new JsonResponse(
            [
                'status' => 'success',
                'data' => $userDto->read(),
            ]
        );
    }
}