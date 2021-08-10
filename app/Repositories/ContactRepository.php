<?php

namespace App\Repositories;

use App\Http\Requests\ContactMessageCreateRequest;
use App\Models\Contact;

class ContactRepository extends BaseRepository
{
    public function getAllMessages()
    {
        return Contact::sortable()->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
    }

    public function store(ContactMessageCreateRequest $request)
    {
        Contact::create($request->validated());
    }

    public function getNewMessages()
    {
       return Contact::where('status', Contact::STATUS_NEW)
           ->Orwhere('status', Contact::STATUS_READ)
           ->sortable()
           ->orderBy('created_at')
           ->paginate(10)->withQueryString();
    }

    public function search(string $search)
    {
        return Contact::where('name', 'like', "%$search%")
            ->orWhere('email', 'like', "%$search%")
            ->orWhere('status', 'like', "%$search%")
            ->orWhere('created_at', 'like', "%$search%")
            ->orderBy('created_at')
            ->paginate(10)
            ->withQueryString();
    }

}
