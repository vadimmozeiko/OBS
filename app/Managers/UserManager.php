<?php


namespace App\Managers;


use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Repositories\UserRepository;

class UserManager
{
    /**
     * UserManager constructor.
     */
    public function __construct(
        private UserRepository $userRepository
    )
    {
    }

    public function getUserByStatus($model, int $status)
    {
       return $this->userRepository->getByStatus($model,$status);
    }

    public function getAllOrderName()
    {
        return $this->userRepository->getAllOrderName();
    }

    public function search(string $search)
    {
        return $this->userRepository->search($search);
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $this->userRepository->update($request, $user);
    }

    public function getAuthUser()
    {
        return $this->userRepository->getAuthUser();
    }


}
