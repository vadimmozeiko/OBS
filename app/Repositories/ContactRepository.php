<?php

namespace App\Repositories;

use App\Http\Requests\ContactMessageCreateRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

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

}
