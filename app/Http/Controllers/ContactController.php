<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:100',
            'phone'   => 'required|string|max:30',
            'email'   => 'required|email|max:100',
            'address' => 'nullable|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        Contact::create($request->only('name', 'phone', 'email', 'address', 'message'));

        return redirect('/#contact')->with('contact_success', 'Thank you! We\'ll be in touch soon.');
    }

    // Admin: list all contacts
    public function index()
    {
        $contacts = Contact::latest()->paginate(15);
        return view('admin.contacts.index', compact('contacts'));
    }

    // Admin: mark as read
    public function markRead(Contact $contact)
    {
        $contact->update(['is_read' => true]);
        return back()->with('success', 'Marked as read.');
    }

    // Admin: delete
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return back()->with('success', 'Contact deleted.');
    }
}
