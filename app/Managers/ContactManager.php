<?php

namespace App\Managers;

use App\Http\Controllers\MailController;
use App\Http\Requests\ContactMessageCreateRequest;
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


    public function store(ContactMessageCreateRequest $request)
    {
        $this->contactRepository->store($request);
    }

    public function sendReply(Contact $contact, Request $request)
    {
        $this->mailController->sendReply($contact, $request);
    }

    public function getNewMessages()
    {
        return $this->contactRepository->getNewMessages();
    }

    public function search(string $search)
    {
        return $this->contactRepository->search($search);
    }

}
