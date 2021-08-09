<?php

namespace App\Managers;

use App\Http\Requests\ContactMessageCreateRequest;
use App\Jobs\SendNewEmail;
use App\Jobs\SendReplyEmail;
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

    public function sendReply(Contact $contact, array $reply)
    {
        dispatch(new SendReplyEmail($contact, $reply))->delay(now()->addSeconds(30));
    }

    public function getNewMessages()
    {
        return $this->contactRepository->getNewMessages();
    }

    public function search(string $search)
    {
        return $this->contactRepository->search($search);
    }

    public function sendMessage(array $request)
    {
        dispatch(new SendNewEmail($request))->delay(now()->addSeconds(30));
    }

}
