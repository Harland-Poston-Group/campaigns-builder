<?php
namespace Themes\Demo\Blocks\CallToAction;

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


        Mail::raw("
            Name: $request->firstname .''.$request->lasttname
            Email: $request->email
            Phone: $request->phone
            Interested In: $request->enquiry_subject
            Description: $request->description
            Keep Updated: " . (isset($request->keepupdated) ? 'Yes' : 'No'), function ($message) {
            $message->to('recipient@example.com')
                ->subject('New Form Submission');
        });



        /*
                echo '<div class="container">';
                echo 'Name: '. $request->firstname . " " . $request->lastname . "<br>";
                echo 'Email: '. $request->email. "<br>";
                echo 'Phone: '. $request->phone. "<br>";
                echo 'Subject: '. $request->enquiry_subject. "<br>";
                echo 'Message: '. $request->description. "<br>";
                echo 'Keep Updated: '. $reque->keepupdated. "<br>";
                echo '</div>';
                /*
                          // Validate the request data
                        $validated = $request->validate([
                            'firstname' => 'required|string|max:255',
                            'lastname' => 'required|string|max:255',
                            'email' => 'required|email|max:255',
                            'phone' => 'nullable|string|max:255',
                            'enquiry_subject' => 'required|string|max:255',
                            'description' => 'nullable|stri',
                            'keepupdated' => 'nullable|string'
                        ]);
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
                            $message->to('paulo.bernardes@portugalhomes.com')
                                ->subject('New Form Submission');
                        }
                        );
                */
                  // Redirect to the thank you page or return a response
                 //  return redirect('/thank-you');
                // return response()->json(['message' => 'Email sent successfully!']);

    }

}
