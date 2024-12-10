<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        // Fetch all contacts
        $contacts = Contact::all();

        // Return contacts as JSON
        return response()->json([
            'message' => 'Contacts retrieved successfully!',
            'contacts' => $contacts,
        ]);
    }
    public function store(Request $request)
    {
        // Validate incoming data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'nullable|string|max:15',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        // Create a new contact entry
        $contact = Contact::create($validatedData);

        // Return a success response
        return response()->json([
            'message' => 'Contact information saved successfully!',
            'contact' => $contact,
        ], 201);
    }

    //
}
