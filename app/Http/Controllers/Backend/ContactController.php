<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function list()
    {
        $leads = Contact::orderBy('created_at', 'desc')->paginate(20);
        return view('backend.pages.contact-us-leads', compact('leads'));
    }

    public function delete(Request $request)
    {
        $lead = Contact::find($request->id);
        if ($lead) {
            $lead->delete();
            return response()->json([
                'success' => true,
                'message' => 'Contact lead deleted successfully.'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Contact lead not found.'
            ], 404);
        }
    }
}
