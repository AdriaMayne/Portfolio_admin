<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

use App\Classes\Utilitat;
use Illuminate\Database\QueryException;

class TagController extends Controller {

    public function index(Request $request) {
        if($request->has('search')) {
            $search = $request->input('search');
            $tags = Tag::where('title', 'like', '%' . $search . '%')
                            ->orderBy('title')
                            ->paginate(10);
        } else {
            $tags = Tag::orderBy('title')
                            ->paginate(10);
            $search = "";
        }
        $datos['tags'] = $tags;
        $datos['search'] = $search;

        return view('admin.tags.index', $datos);
    }

    public function store(Request $request) {
        $tag = new Tag;
        $tag->title =  $request->input('title');

        try {
            $tag->save();

            $success = "Tag creado correctamente.";
            $request->session()->flash('success', $success);
        } catch (QueryException $e) {
            $error= Utilitat::errorMessage($e);
            $request->session()->flash('error', $error);
        }
        return redirect()->action('TagController@index')->withInput();
    }

    public function destroy(Tag $tag, Request $request) {
        try {
            $tag->delete();

            $success = "Tag eliminado correctamente.";
            $request->session()->flash('success', $success);
        } catch (QueryException $e) {
            $error = Utilitat::errorMessage($e);
            $request->session()->flash('error', $error);
        }
        return redirect()->action('TagController@index');
    }
}
