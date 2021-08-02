<?php

namespace App\Managers;

use App\Http\Controllers\MailController;
use App\Http\Requests\ContactMessageCreateRequest;
use App\Http\Requests\ContactMessageUpdateRequest;
use App\Models\Contact;
use App\Repositories\ContactRepository;
use Illuminate\Http\Request;

class ContactManager
{
    public function __construct(
        private ContactRepository $contactRepository,
        private MailController $mailController
    )
    {
    }

    public function getAllMessages()
    {
      return $this->contactRepository->getAllMessages();
    }

    public function update(ContactMessageUpdateRequest $request, Contact $contact)
    {
        $this->contactRepository->update($request, $contact);
    }

    public function store(ContactMessageCreateRequest $request)
    {
        $this->contactRepository->store($request);
    }

    public function sendReply(Contact $contact, Request $request)
    {
        $this->mailController->sendReply($contact, $request);
    }

}
