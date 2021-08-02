<?php

namespace App\Managers;

use App\Http\Requests\ContactMessageCreateRequest;
use App\Http\Requests\ContactMessageUpdateRequest;
use App\Models\Contact;
use App\Repositories\ContactRepository;

class ContactManager
{
    public function __construct(
        private ContactRepository $contactRepository
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

}
