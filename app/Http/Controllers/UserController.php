<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\ListUsersRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Jobs\CreateUserJob;
use App\Service\UserService;
use App\Support\ToSnakeCaseArray;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class UserController extends Controller
{
    private $userService;
    private $jobDispatcher;

    public function __construct(UserService $userService, Dispatcher $jobDispatcher)
    {
        $this->userService = $userService;
        $this->jobDispatcher = $jobDispatcher;
    }

    public function createUser(CreateUserRequest $req)
    {
        $dto = $req->toDto();
        $userDto = $this->userService->createUser($dto);

        return new JsonResponse(null, Response::HTTP_CREATED, [
            'Location' => "{$req->getSchemeAndHttpHost()}/api/users/{$userDto->getId()}"
        ]);
    }

    public function createUserAsync(CreateUserRequest $req)
    {
        $dto = $req->toDto();
        $this->jobDispatcher->dispatch(new CreateUserJob($dto));

        return new JsonResponse(null, Response::HTTP_ACCEPTED);
    }

    public function listUsers(ListUsersRequest $req)
    {
        $param = $req->toUserSearchParam();
        $dto = $this->userService->findUsers($param);

        return new JsonResponse(ToSnakeCaseArray::run($dto));
    }

    public function updateUser(int $userId, UpdateUserRequest $req)
    {
        $dto = $req->toDto();
        $this->userService->updateUser($userId, $dto);

        return new JsonResponse(null, Response::HTTP_CREATED);
    }
}
