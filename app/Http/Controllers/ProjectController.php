<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

use App\Classes\Utilitat;
use Illuminate\Database\QueryException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class ProjectController extends Controller {
    public function index(Request $request) {
        if($request->has('search')) {
            $search = $request->input('search');
            $projects = Project::where('title', 'like', '%' . $search . '%')
                                    ->orderBy('title')
                                    ->paginate(10);
        } else {
            $projects = Project::orderBy('title')
                                    ->paginate(10);
            $search = "";
        }
        $datos['projects'] = $projects;
        $datos['search'] = $search;

        return view('admin.projects.index', $datos);
    }

    public function create() {
        return view('admin.projects.new');
    }

    public function store(Request $request) {
        $project = new Project;
        $project->title =  $request->input('title');
        $project->url =  $request->input('url');
        $project->image = "";

        if ($request->has('visible')) {
            $project->visible =  1;
        } else {
            $project->visible =  0;
        }

        $fichero = $request->file('image');

        try {
            $project->save();

            if($fichero) {
                $imagen_path = 'Project_' . $project->id . "." . $fichero->getClientOriginalExtension();

                Storage::disk('public')->putFileAs('projects/', $fichero, $imagen_path);
                $project->image =  'storage/projects/' . $imagen_path;
            }

            $project->save();

            $success = "Proyecto creado correctamente.";
            $request->session()->flash('success', $success);
        } catch (QueryException $e) {
            $error= Utilitat::errorMessage($e);
            $request->session()->flash('error', $error);

            return redirect()->action('ProjectController@create')->withInput();
        }
        return redirect()->action('ProjectController@index')->withInput();
    }

    public function show(Project $project) {
        //
    }

    public function edit(Project $project) {
        $datos['project'] = $project;
        $datos['original_image'] = "media/img/default_image.png";

        if ($project->image != "") {
            $datos['original_image'] = $project->image;
        }

        return view('admin.projects.update', $datos);
    }

    public function update(Request $request, Project $project) {
        $project->title =  $request->input('title');
        $project->url =  $request->input('url');
        $project->image = "";

        if ($request->has('visible')) {
            $project->visible =  1;
        } else {
            $project->visible =  0;
        }

        $fichero = $request->file('image');

        try {
            if($fichero) {
                if( Storage::disk('public')->exists($project->image)){
                    Storage::disk('public')->delete($project->image);
                }

                $imagen_path = 'Project_' . $project->id . "." . $fichero->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('projects/', $fichero, $imagen_path);
                $project->image =  'storage/projects/' . $imagen_path;
            }

            $project->save();

            $success = "Proyecto editado correctamente.";
            $request->session()->flash('success', $success);
        } catch (QueryException $e) {
            $error= Utilitat::errorMessage($e);
            $request->session()->flash('error', $error);

            return redirect()->action('ProjectController@edit', [$project->id])->withInput();
        }
        return redirect()->action('ProjectController@index')->withInput();
    }

    public function destroy(Project $project) {
        try {
            $project->delete();
        } catch (QueryException $e) {
            $error = Utilitat::errorMessage($e);
            $request->session()->flash('error', $error);
        }
        return redirect()->action('ProjectController@index');
    }
}
