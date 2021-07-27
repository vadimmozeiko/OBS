<?php


namespace App\Repositories;


use App\Http\Requests\PasswordResetRequest;
use App\Http\Requests\PasswordUpdateRequest;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository
{
    public function getAllOrderName()
    {
        return User::where('isAdmin', 0)->orderBy('name')->paginate(10)->withQueryString();
    }

    public function getAllUsers($model)
    {
        return $model::all();
    }

    public function getByStatusOrderName(string $status)
    {
        return User::where('status', $status)->orderBy('name')->paginate(10)->withQueryString();
    }

    public function search(string $search)
    {
        return User::where('name', 'like', "%$search%")
            ->orWhere('email', 'like', "%$search%")
            ->orderBy('id')
            ->paginate(10)
            ->withQueryString();
    }

    public function getAuthUser()
    {
      return auth()->user();
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $user->update($request->validated());
    }

    public function store(UserCreateRequest $request)
    {
        return User::create($request->validated());
    }

    public function delete(User $user)
    {
        $user->status = User::STATUS_DELETED;
        $user->email = 'del#' . $user->id . $user->email;
        $user->save();
        Auth::logout();
    }

    public function updatePass(Authenticatable $authUser, PasswordUpdateRequest $request)
    {
        $authUser->update(['password' => Hash::make($request->new_password)]);
    }

    public function resetPass(Authenticatable $authUser, PasswordResetRequest $request)
    {
        $authUser->update([
            'password' => Hash::make($request->password),
            'status' => User::STATUS_ACTIVE,
        ]);
    }
}
