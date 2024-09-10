<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\FormSubmission;

class FormController extends Controller
{

    public function store(Request $request)
    {

      //   dd('test');

  /*
        $validated = $request->validate([
        'firstname' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'nullable|string|max:20',
        'dropdown' => 'nullable|string',
        'description' => 'nullable|string',
        'keep-updated' => 'nullable|accepted',
        ]);
    */
        // Send the email
        // Mail::to('paulo.bernardesl@portugalhomes.com')->send(new FormSubmission($validated));

        $emails = ['paulo.bernardes@portugalhomes.com', 'antonio.lima@portugalhomes.com'];

        $maildata = [
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'phone' => $request->phone,
            'enquiry_subject' => $request->enquiry_subject,
            'description' => $request->description,
            'keep-updated' => $request->keepupdated,
        ];



        // Notify the admin
        Mail::to($emails)
            ->send(new \App\Mail\FormSubmission($maildata));

        return response()->json(['message' => 'Form submitted successfully!']);

    }
}
