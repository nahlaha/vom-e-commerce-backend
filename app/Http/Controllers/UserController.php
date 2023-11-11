<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Dtos\User\AuthDto;
use App\Dtos\User\CreateUserDto;
use App\Dtos\User\GetUsersDto;
use App\Dtos\User\UpdateUserDto;
use App\Http\Requests\BaseRequest;
use App\Http\Requests\User\AuthRequest;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\DeleteUserRequest;
use App\Http\Requests\User\GetUsersRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\User\AuthenticatedUserResource;
use App\Http\Resources\User\AuthResource;
use App\Http\Resources\User\UserResource;
use App\Services\ResponseService;
use App\Services\Interfaces\IAuthService;
use App\Services\Interfaces\IUserService;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class UserController extends BaseController
{

    public function __construct(
        private ResponseService $responseService,
        private IAuthService $authenticationService,
        private IUserService $userService
    ) {
    }

    /**
     * @param AuthRequest $request
     * @return \App\Services\Illuminate\Http\Response
     * @throws \App\Exceptions\ApplicationException
     * @throws \App\Exceptions\TechnicalException
     */
    public function authenticateUser(AuthRequest $request)
    {
        $token = $this->authenticationService->authenticateUser(new AuthDto(
            $request->input('email'),
            $request->input('password')
        ));
        return $this->responseService->getSuccessResponse(new AuthResource($token));
    }

    /**
     * Create user
     *
     * @param CreateUserRequest $request
     * @return \App\Services\Illuminate\Http\Response
     * @throws \App\Exceptions\ApplicationException
     */
    public function createUser(CreateUserRequest $request)
    {
        $user = $this->userService->createUser(new CreateUserDto($request));
        return $this->responseService->getSuccessResponse(new UserResource($user));
    }

    /**
     * Gets the current authenticated user
     *
     * @param BaseRequest $request
     * @return \App\Services\Illuminate\Http\Response
     * @throws \App\Exceptions\ApplicationException
     */
    public function getLoggedInUser(BaseRequest $request)
    {
        return $this->responseService->getSuccessResponse(new AuthenticatedUserResource(Auth::user()));
    }

    /**
     * update user
     *
     * @param UpdateUserRequest $request
     * @return \App\Services\Illuminate\Http\Response
     * @throws \App\Exceptions\ApplicationException
     */
    public function updateUser(UpdateUserRequest $request, int $id)
    {
        $user = $this->userService->updateUser(new UpdateUserDto($request, $id));
        return $this->responseService->getSuccessResponse(new UserResource($user));
    }

    /**
     * delete user
     *
     * @param DeleteUserRequest $request
     * @return \App\Services\Illuminate\Http\Response
     * @throws \App\Exceptions\ApplicationException
     */
    public function deleteUser(DeleteUserRequest $request, int $id)
    {
        return $this->responseService->getSuccessResponse($this->userService->deleteUser($id));
    }


    /**
     * get all users
     *
     * @param GetUsersRequest $request
     * @return \App\Services\Illuminate\Http\Response
     * @throws \App\Exceptions\ApplicationException
     */
    public function getAllUsers(GetUsersRequest $request, int $id)
    {
        return $this->responseService->getSuccessResponse($this->userService->getUsers(new GetUsersDto()));
    }
}
