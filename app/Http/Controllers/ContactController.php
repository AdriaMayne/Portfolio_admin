<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use Illuminate\Http\Response;
use Illuminate\Database\QueryException;
use App\Clases\Utilitat;

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

    public function storeApi(Request $request) {
        $contact = new Contact();

        $contact->subject = $request->input('subject');
        $contact->name = $request->input('name');
        $contact->email = $request->input('email');
        $contact->message = $request->input('message');
        $contact->date = Carbon::now()->timezone('Europe/Madrid');

        try {
            $contact->save();

            $respuesta = response()
                            ->setStatusCode(201, 'Mensaje enviado correctamente.');
        } catch (QueryException $e) {
            $mensaje = Utilitat::errorMessage($e);
            $respuesta = response()
                            ->json(['error' => $mensaje], 400);
        }
        return $respuesta;
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
