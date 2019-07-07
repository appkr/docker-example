<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\ListUsersRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Service\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function createUser(CreateUserRequest $req)
    {
        $dto = $req->toUserDto();
        $this->userService->createUser($dto);

        return new JsonResponse(null, Response::HTTP_CREATED);
    }

    public function listUsers(ListUsersRequest $req)
    {
        $param = $req->toUserSearchParam();
        $users = $this->userService->findUsers($param);

        return new JsonResponse($users);
    }

    public function updateUser(int $userId, UpdateUserRequest $req)
    {
        $dto = $req->toUserDto();
        $this->userService->updateUser($userId, $dto);

        return new JsonResponse(null, Response::HTTP_CREATED);
    }
}
