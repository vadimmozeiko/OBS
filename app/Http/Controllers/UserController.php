<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordResetRequest;
use App\Http\Requests\PasswordUpdateRequest;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Order;
use App\Models\User;
use App\Repositories\OrderRepository;
use App\Repositories\StatusRepository;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class UserController extends Controller
{
    private OrderRepository $orderRepository;
    private StatusRepository $statusRepository;

    public function __construct()
    {
        $this->orderRepository = new OrderRepository();
        $this->statusRepository = new StatusRepository();
    }

    public function index(): View
    {
        $user = auth()->user();
        return view('user.index', ['user' => $user]);
    }

    public function create(): View
    {
        return view('admin.users.create_user');
    }


    public function store(UserCreateRequest $request)
    {

        $user = User::create($request->validated());

        $user->notify(new VerifyEmail);

        $this->passReset($user);

        return redirect()->back()->with('success_message', 'User created successfully');
    }


    public function orders(User $user, Request $request): View
    {
        $orderStatus = 0;
        $userOrders = $this->orderRepository->getByUser(Order::class, auth()->user()->id);
        $statuses = $this->statusRepository->getOrderStatuses();

        if ($request->order_status) {
            $orderStatus = $request->order_status;
            $userOrders = $this->orderRepository->getOrdersByIdByStatus(auth()->user()->id, $orderStatus);

        }

        return view('user.orders', ['user' => $user, 'userOrders' => $userOrders,
            'statuses' => $statuses, 'orderStatus' => $orderStatus]);
    }

    public function edit(User $user): View|RedirectResponse
    {
        if (auth()->user()->id == $user->id) {
            return view('user.edit', ['user' => $user]);
        }
        return redirect()->back()->with('info_message', 'Whoops, looks like something went wrong');
    }


    public function update(UserUpdateRequest $request, User $user): RedirectResponse
    {
        $user->update($request->validated());

        return redirect()->route('user.index')->with('success_message', 'Changes saved successfully');
    }

    public function destroy(User $user, Request $request)
    {
        $currentPass = auth()->user()->getAuthPassword();
        $inputCurrentPass = $request->current_password;

        if (Hash::check($inputCurrentPass, $currentPass)) {
            $user->status_id = '3';
            $user->email = 'del:' . auth()->user()->id . $user->email;
            $user->save();
            Auth::logout();
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
        auth()->user()->update(['password' => Hash::make($request->new_password)]);
        return redirect()->route('user.index')->with('success_message', 'Password changed successfully');
    }

    // TODO REFACTOR | repeating function with same job
    public function passFirstReset(PasswordResetRequest $request)
    {
        auth()->user()->update([
            'password' => Hash::make($request->password),
            'status_id' => 2
        ]);
        return redirect()->route('index')->with('success_message', 'Password changed successfully');
    }

    public function passReset(User $user)
    {
        if ($user->status_id != 3) {
            $token = Password::getRepository()->create($user);
            $user->sendPasswordResetNotification($token);
            return redirect()->back()->with('success_message', 'Password reset link send successfully');
        }
        return redirect()->back()->with('info_message', 'Whoops, looks like something went wrong');
    }
}
