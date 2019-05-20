<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

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
        //
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
        //
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
