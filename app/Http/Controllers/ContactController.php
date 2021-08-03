<?php

namespace App\Http\Controllers;

use App\Managers\ContactManager;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __construct(
        private ContactManager $contactManager,
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


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Contact $contact)
    {
        return view('admin.messages.show', ['message' => $contact]);
    }


    public function edit(Contact $contact)
    {
        //
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

    public function sendReply(Request $request, Contact $contact)
    {
        $contact->update(['reply' => $request->get('reply')]);
        $this->contactManager->sendReply($contact, $request);
        $contact->status()->transitionTo('replied');
        return redirect()->route('message.index')->with('success_message', 'Message sent successfully');
    }




    public function destroy(Contact $contact)
    {
        //
    }
}
