<?php

// app/Http/Controllers/ContactController.php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::query();

        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('email', 'LIKE', '%' . $request->search . '%');
            });
        }

        if ($request->has('sort_by') && $request->has('sort_order')) {
            $query->orderBy($request->sort_by, $request->sort_order);
        }

        $contacts = $query->get();

        if ($request->ajax()) {
            return response()->json(['html' => view('contacts.table', compact('contacts'))->render()]);
        }

        return view('contacts.index', compact('contacts'));
    }


    public function create()
    {
        return view('contacts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:contacts',
            'phone' => 'nullable',
            'address' => 'nullable',
        ]);

        Contact::create($validated);

        return response()->json(['message' => 'Contact created successfully']);
    }

    public function show(Contact $contact)
    {
        return view('contacts.show', compact('contact'));
    }

    public function edit(Contact $contact)
    {
        return view('contacts.edit', compact('contact'));
    }

    public function update(Request $request, Contact $contact)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:contacts,email,' . $contact->id,
            'phone' => 'nullable',
            'address' => 'nullable',
        ]);

        $contact->update($validated);

        return response()->json(['message' => 'Contact updated successfully']);
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return response()->json(['message' => 'Contact deleted successfully']);
    }
}
