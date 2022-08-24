<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UserBalanceRequest;
use App\Http\Resources\User\UserCollection;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UsersController extends ApiController
{
    /**
     * @var UserService
     */
    private UserService $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @return UserCollection
     */
    public function index(): UserCollection
    {
        return $this->userService->getList();
    }

    /**
     * @param UserBalanceRequest $request
     * @return mixed
     */
    public function addBalance(UserBalanceRequest $request): mixed
    {
        return $this->userService->updateUserBalance($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
