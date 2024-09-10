<?php
namespace Themes\Demo\Blocks\Form;

use PHPageBuilder\Modules\GrapesJS\Block\BaseController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;


class Controller extends BaseController
{
    /**
     * Handle the current request.
     */
    public function handleRequest()
    {

        // handle form submit
        $request = request();

        print_r($request->firstname);



        /*
          // Validate the request data
          $validated = $request->validate([
              'firstname' => 'required|string|max:255',
              'lastname' => 'required|string|max:255',
              'email' => 'required|email|max:255',
              'phone' => 'nullable|string|max:255',
              'enquiry_subject' => 'required|string|max:255',
              'description' => 'nullable|string',
              'keepupdated' => 'nullable|stri      ]);
          /*
                  // Send the email
                  Mail::raw("
                      First Name: {$validated['firstname']}
                      Last Name: {$validated['lastname']}
                      Email: {$validated['email']}
                      Phone: {$validated['phone']}
                      Interested In: {$validated['enquiry_subject']}
                      Description: {$validated['description']}
                      Keep Updated: " . (isset($validated['keepupdated']) ? 'Yes' : 'No'), function ($message) {
                      $message->to('recipient@examp.com')
                          ->subject('New Form Submission');
                  }
                  );
          /*
                  // Redirect to the thank you page or return a response
                 //  return redirect('/thank-you');
                 // return response()->json(['message' => 'Email sent successfully!']);
                  */
    }

}
