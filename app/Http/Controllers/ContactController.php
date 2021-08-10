<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactMessageCreateRequest;
use App\Managers\ContactManager;
use App\Managers\UserManager;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __construct(
        private ContactManager $contactManager,
        private UserManager $userManager,
    )
    {
    }

    public function index(Request $request)
    {
        $search = $request->get('search');

        $messages = $this->contactManager->getAllMessages();

        if ($search) {
            $messages = $this->contactManager->search($search);
        }

        return view('admin.messages.index',['messages' => $messages, 'search' => $search]);
    }

    public function newMessages()
    {
        $messages = $this->contactManager->getNewMessages();
        return view('admin.messages.new',['messages' => $messages]);
    }


    public function create(Request $request)
    {
        $userName = $request->get('name');
        $users = $this->userManager->getAllUsers(User::class)->sortBy('name');
        return view('admin.messages.create', ['users' => $users, 'userName' => $userName]);
    }

    public function store(ContactMessageCreateRequest $request)
    {
        $this->contactManager->store($request);

        return redirect()->back()->with('success_message', 'Your message was send successfully');
    }


    public function show(Contact $contact)
    {
        return view('admin.messages.show', ['message' => $contact]);
    }

    public function update(Contact $contact)
    {
        $contact->status()->transitionTo('read');
        return redirect()->back()->with('success_message', 'Message status updated successfully');
    }

    public function replyForm(Contact $contact)
    {
        return view('admin.messages.reply', ['message' => $contact]);
    }

    public function sendMessage(ContactMessageCreateRequest $request)
    {
        $this->contactManager->sendMessage($request->all());
        return redirect()->back()->with('success_message', 'Message sent successfully');
    }

    public function sendReply(Request $request, Contact $contact)
    {
        $contact->update(['reply' => $request->get('reply')]);
        $this->contactManager->sendReply($contact, $request->all());
        $contact->status()->transitionTo('replied');
        return redirect()->route('message.index')->with('success_message', 'Message sent successfully');
    }

}
