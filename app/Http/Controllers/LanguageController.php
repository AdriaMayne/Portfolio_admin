<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;

use App\Classes\Utilitat;
use Illuminate\Database\QueryException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use App\Http\Resources\LanguageResource;

class LanguageController extends Controller {
    public function index(Request $request) {
        if($request->has('search')) {
            $search = $request->input('search');
            $languages = Language::where('name', 'like', '%' . $search . '%')
                                    ->orderBy('name')
                                    ->paginate(10);
        } else {
            $languages = Language::orderBy('name')
                                    ->paginate(10);
            $search = "";
        }
        $datos['languages'] = $languages;
        $datos['search'] = $search;

        return view('admin.languages.index', $datos);
    }

    public function indexApi() {
        $languages = Language::All();

        return LanguageResource::collection($languages);
    }

    public function create() {
        return view('admin.languages.new');
    }

    public function store(Request $request) {
        $language = new Language;
        $language->name = $request->input('name');
        $language->percentage = $request->input('percentage');
        $language->category = $request->input('category');
        $language->image = "";

        if ($request->has('visible')) {
            $language->visible =  1;
        } else {
            $language->visible =  0;
        }

        $fichero = $request->file('image');

        try {
            $language->save();

            if($fichero) {
                $imagen_path = 'Lenguaje_' . $language->id . "." . $fichero->getClientOriginalExtension();

                Storage::disk('public')->putFileAs('languages/', $fichero, $imagen_path);
                $language->image =  'storage/languages/' . $imagen_path;
            }

            $language->save();

            $success = "Lenguaje creado correctamente.";
            $request->session()->flash('success', $success);
        } catch (QueryException $e) {
            $error= Utilitat::errorMessage($e);
            $request->session()->flash('error', $error);

            return redirect()->action('LanguageController@create')->withInput();
        }
        return redirect()->action('LanguageController@index')->withInput();
    }

    public function edit(Language $language) {
        $datos['language'] = $language;
        $datos['original_image'] = "media/img/default_image.png";

        if ($language->image != "") {
            $datos['original_image'] = $language->image;
        }

        return view('admin.languages.update', $datos);
    }

    public function update(Request $request, Language $language) {
        $language->name = $request->input('name');
        $language->percentage = $request->input('percentage');
        $language->category = $request->input('category');

        if ($request->has('visible')) {
            $language->visible =  1;
        } else {
            $language->visible =  0;
        }

        $fichero = $request->file('image');

        try {
            if($fichero) {
                if( Storage::disk('public')->exists($language->image)){
                    Storage::disk('public')->delete($language->image);
                }

                $imagen_path = 'Language_' . $language->id . "." . $fichero->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('languages/', $fichero, $imagen_path);
                $language->image =  'storage/languages/' . $imagen_path;
            }

            $language->save();

            $success = "Lenguaje editado correctamente.";
            $request->session()->flash('success', $success);
        } catch (QueryException $e) {
            $error= Utilitat::errorMessage($e);
            $request->session()->flash('error', $error);

            return redirect()->action('LanguageController@edit', [$language->id])->withInput();
        }
        return redirect()->action('LanguageController@index')->withInput();
    }

    public function destroy(Language $language) {
        try {
            $language->delete();
        } catch (QueryException $e) {
            $error = Utilitat::errorMessage($e);
            $request->session()->flash('error', $error);
        }
        return redirect()->action('LanguageController@index');
    }
}
