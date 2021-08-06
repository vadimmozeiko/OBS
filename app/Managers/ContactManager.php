<?php

namespace App\Managers;

use App\Http\Requests\ContactMessageCreateRequest;
use App\Models\Contact;
use App\Repositories\ContactRepository;
use App\Services\MailService;
use Illuminate\Http\Request;

class ContactManager
{
    public function __construct(
        private ContactRepository $contactRepository,
        private MailService $mailService
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
        $this->mailService->sendReply($contact, $request);
    }

    public function getNewMessages()
    {
        return $this->contactRepository->getNewMessages();
    }

    public function search(string $search)
    {
        return $this->contactRepository->search($search);
    }

    public function sendMessage(Request $request)
    {
        $this->mailService->sendMessage($request);
    }

}
