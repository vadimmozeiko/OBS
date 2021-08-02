<?php

namespace App\Repositories;

use App\Http\Requests\ContactMessageCreateRequest;
use App\Http\Requests\ContactMessageUpdateRequest;
use App\Models\Contact;

class ContactRepository extends BaseRepository
{
    public function getAllMessages()
    {
        return Contact::orderBy('created_at', 'desc')->paginate(10)->withQueryString();
    }

    public function store(ContactMessageCreateRequest $request)
    {
        Contact::create($request->validated());
    }

    public function update(ContactMessageUpdateRequest $request, Contact $contact)
    {
        $contact->update($request->validated());
    }
}
