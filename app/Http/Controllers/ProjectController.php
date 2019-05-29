<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

use App\Models\Tag;
use App\Classes\Utilitat;
use Illuminate\Database\QueryException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use App\Http\Resources\ProjectResource;

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

    public function indexApi() {
        $projects = Project::All();

        return ProjectResource::collection($projects);
    }

    public function create() {
        $tags = Tag::All();
        $datos['tags'] = $tags;

        return view('admin.projects.new', $datos);
    }

    public function store(Request $request) {
        $project = new Project;
        $project->title =  $request->input('title');
        $project->description =  $request->input('description');
        $tags =  $request->input('tags');
        $project->logo = "";
        $project->mockup = "";

        if ($request->has('visible')) {
            $project->visible =  1;
        } else {
            $project->visible =  0;
        }

        $fichero_logo = $request->file('logo');
        $fichero_mockup = $request->file('mockup');

        try {
            $project->save();
            $project->tags()->attach($tags);

            if($fichero_logo && $fichero_mockup) {
                $imagen_path_logo = 'Project_' . $project->id . "." . $fichero_logo->getClientOriginalExtension();
                $imagen_path_mockup = 'Project_' . $project->id . "_mockup." . $fichero_mockup->getClientOriginalExtension();

                Storage::disk('public')->putFileAs('projects/', $fichero_logo, $imagen_path_logo);
                Storage::disk('public')->putFileAs('projects/', $fichero_mockup, $imagen_path_mockup);

                $project->logo =  'storage/projects/' . $imagen_path_logo;
                $project->mockup =  'storage/projects/' . $imagen_path_mockup;
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
        $tags = Tag::All();
        $datos['tags'] = $tags;
        $datos['project'] = $project;

        $datos['original_logo'] = "media/img/default_image.png";
        $datos['original_mockup'] = "media/img/default_image.png";

        if ($project->logo != "") {
            $datos['original_logo'] = $project->logo;
        }

        if ($project->mockup != "") {
            $datos['original_mockup'] = $project->mockup;
        }

        return view('admin.projects.update', $datos);
    }

    public function update(Request $request, Project $project) {
        $project->title =  $request->input('title');
        $project->description =  $request->input('description');
        $tags =  $request->input('tags');

        if ($request->has('visible')) {
            $project->visible =  1;
        } else {
            $project->visible =  0;
        }

        $fichero_logo = $request->file('logo');
        $fichero_mockup = $request->file('mockup');

        try {
            if($fichero_logo) {
                if( Storage::disk('public')->exists($project->logo)){
                    Storage::disk('public')->delete($project->logo);
                }

                $imagen_path_logo = 'Project_' . $project->id . "." . $fichero_logo->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('projects/', $fichero_logo, $imagen_path_logo);
                $project->logo =  'storage/projects/' . $imagen_path_logo;
            }

            if($fichero_mockup) {
                if( Storage::disk('public')->exists($project->mockup)){
                    Storage::disk('public')->delete($project->mockup);
                }

                $imagen_path_mockup = 'Project_' . $project->id . "_mockup." . $fichero_mockup->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('projects/', $fichero_mockup, $imagen_path_mockup);
                $project->mockup =  'storage/projects/' . $imagen_path_mockup;
            }

            $project->tags()->detach();
            $project->tags()->attach($tags);
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

    public function destroy(Request $request, Project $project) {
        try {
            $project->tags()->detach();

            if( Storage::disk('public')->exists($project->logo)){
                Storage::disk('public')->delete($project->logo);
            }

            if( Storage::disk('public')->exists($project->mockup)){
                Storage::disk('public')->delete($project->mockup);
            }

            $project->delete();

            $success = "Proyecto eliminado correctamente.";
            $request->session()->flash('success', $success);
        } catch (QueryException $e) {
            $error = Utilitat::errorMessage($e);
            $request->session()->flash('error', $error);
        }
        return redirect()->action('ProjectController@index');
    }
}
