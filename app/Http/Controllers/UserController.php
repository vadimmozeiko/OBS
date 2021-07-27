<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordResetRequest;
use App\Http\Requests\PasswordUpdateRequest;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Managers\OrderManager;
use App\Managers\UserManager;
use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(
        private OrderManager $orderManager,
        private UserManager $userManager)
    {
    }

    public function index(): View
    {
        $user = $this->userManager->getAuthUser();
        return view('user.index', ['user' => $user]);
    }

    public function create(): View
    {
        $tempPassword = bcrypt("tempPassword");
        return view('admin.users.create', ['tempPassword' => $tempPassword]);
    }


    public function store(UserCreateRequest $request)
    {
        $user = $this->userManager->store($request);
        $user->notify(new VerifyEmail);

        $this->orderManager->SendWelcome($user);

        return redirect()->back()->with('success_message', 'User created successfully');
    }


    public function orders(User $user, Request $request): View
    {
        $orderStatus = 0;
        $userOrders = $this->orderManager->getByUser(Order::class, $user->id);

        if ($request->order_status) {
            $orderStatus = $request->order_status;
            $userOrders = $this->orderManager->getOrdersByIdByStatus($user->id, $orderStatus);
        }
        return view('user.orders', ['user' => $user, 'userOrders' => $userOrders, 'orderStatus' => $orderStatus]);
    }

    public function edit(User $user): View|RedirectResponse
    {
        $authUser = $this->userManager->getAuthUser();
        if ($authUser->id == $user->id) {
            return view('user.edit', ['user' => $user]);
        }
        return redirect()->back()->with('info_message', 'Whoops, looks like something went wrong');
    }


    public function update(UserUpdateRequest $request, User $user): RedirectResponse
    {
        $this->userManager->update($request, $user);
        return redirect()->route('user.index')->with('success_message', 'Changes saved successfully');
    }

    public function destroy(User $user, Request $request)
    {
        $currentPass = $this->userManager->getAuthUser()->getAuthPassword();
        $inputCurrentPass = $request->current_password;

        $this->userManager->delete($user);
        $isValidPassword = $this->userManager->checkPass($currentPass, $inputCurrentPass);
        if ($isValidPassword) {
            return redirect()->route('index')->with('success_message', 'Account was deleted successfully');
        } else {
            return redirect()->back()->with('info_message', 'Password doesnt match our records');
        }
    }

    public function deleteConfirm(User $user)
    {
        return view('user.delete', ['user' => $user]);
    }


    public function passEdit(User $user)
    {
        return view('user.password', ['user' => $user]);
    }

    public function passUpdate(PasswordUpdateRequest $request)
    {
        $authUser = $this->userManager->getAuthUser();
        $this->userManager->updatePass($authUser, $request);
        return redirect()->route('user.index')->with('success_message', 'Password changed successfully');
    }

    public function passFirstReset(PasswordResetRequest $request)
    {
        $authUser = $this->userManager->getAuthUser();
        $this->userManager->resetPass($authUser, $request);
        return redirect()->route('index')->with('success_message', 'Password changed successfully');
    }

    public function passReset(User $user)
    {
        $isNotDeleted = $this->userManager->isNotDeleted($user);
        if ($isNotDeleted) {
            $this->userManager->sendResetEmail($user);
            return redirect()->back()->with('success_message', 'Password reset link send successfully');
        }
        return redirect()->back()->with('info_message', 'Whoops, looks like something went wrong');
    }
}
