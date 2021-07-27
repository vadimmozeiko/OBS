<?php


namespace App\Managers;


use App\Http\Requests\PasswordResetRequest;
use App\Http\Requests\PasswordUpdateRequest;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

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

    public function getUserByStatus($model, string $status)
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

    public function getByStatusOrderName(string $userStatus)
    {
        return $this->userRepository->getByStatusOrderName($userStatus);
    }

    public function getAllUsers($model)
    {
        return $this->userRepository->getAllUsers($model);
    }

    public function getAll($model)
    {
        return $this->userRepository->getAll($model);
    }

    public function store(UserCreateRequest $request)
    {
       return $this->userRepository->store($request);
    }

    public function delete(User $user): void
    {
        $this->userRepository->delete($user);
    }

    public function checkPass(string $currentPass, string $inputCurrentPass): bool
    {
       return Hash::check($inputCurrentPass, $currentPass);
    }

    public function updatePass(Authenticatable $authUser, PasswordUpdateRequest $request): void
    {
        $this->userRepository->updatePass($authUser, $request);
    }

    public function resetPass(Authenticatable $authUser, PasswordResetRequest $request): void
    {
        $this->userRepository->resetPass($authUser, $request);
    }

    public function isNotDeleted(User $user): bool
    {
        return $user->status != User::STATUS_DELETED;
    }

    public function sendResetEmail(User $user): void
    {
        $token = Password::getRepository()->create($user);
        $user->sendPasswordResetNotification($token);
    }


}
