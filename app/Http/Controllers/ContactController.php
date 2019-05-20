<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller {
    public function index(Request $request) {
        if($request->has('search')) {
            $search = $request->input('search');
            $contacts = Contact::where('subject', 'like', '%' . $search . '%')
                                    ->orWhere('name', 'like', '%' . $search . '%')
                                    ->orderBy('date')
                                    ->paginate(10);
        } else {
            $contacts = Contact::orderBy('date')
                                    ->paginate(10);
            $search = "";
        }
        $datos['contacts'] = $contacts;
        $datos['search'] = $search;

        return view('admin.contacts.index', $datos);
    }

    public function show(Contact $contact) {
        $datos['contact'] = $contact;

        return view('admin.contacts.view', $datos);
    }

    public function destroy(Contact $contact) {
        try {
            $contact->delete();
        } catch (QueryException $e) {
            $error = Utilitat::errorMessage($e);
            $request->session()->flash('error', $error);
        }
        return redirect()->action('ContactController@index');
    }
}
