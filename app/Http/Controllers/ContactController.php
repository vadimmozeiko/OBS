<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactMessageUpdateRequest;
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

    public function index()
    {
        $messages = $this->contactManager->getAllMessages();
        return view('admin.messages.index',['messages' => $messages]);
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


    public function update(ContactMessageUpdateRequest $request, Contact $contact)
    {
        $this->contactManager->update($request, $contact);
        return redirect()->back()->with('success_message', 'Message status updated successfully');
    }

    public function replyForm(Contact $contact)
    {
        return view('admin.messages.reply', ['message' => $contact]);
    }

    public function sendReply(ContactMessageUpdateRequest $request, Contact $contact)
    {
        $this->contactManager->sendReply($contact, $request);
        $this->contactManager->update($request, $contact);
        return redirect()->route('message.index')->with('success_message', 'Message sent successfully');
    }




    public function destroy(Contact $contact)
    {
        //
    }
}
