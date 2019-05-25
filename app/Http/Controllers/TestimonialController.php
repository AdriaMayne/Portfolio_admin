<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

use App\Classes\Utilitat;
use Illuminate\Database\QueryException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use App\Http\Resources\TestimonialResource;

class TestimonialController extends Controller {
    public function index(Request $request) {
        if($request->has('search')) {
            $search = $request->input('search');
            $testimonials = Testimonial::where('name', 'like', '%' . $search . '%')
                                        ->orWhere('title', 'like', '%' . $search . '%')
                                        ->orderBy('name')
                                        ->paginate(10);
        } else {
            $testimonials = Testimonial::orderBy('order')
                                        ->paginate(10);
            $search = "";
        }
        $datos['testimonials'] = $testimonials;
        $datos['search'] = $search;

        return view('admin.testimonials.index', $datos);
    }

    public function indexApi() {
        $testimonials = Testimonial::orderBy('order')
                                    ->get();

        return TestimonialResource::collection($testimonials);
    }

    public function create() {
        $testCount = Testimonial::count() + 1;
        $datos['orderNumbers'] = [];

        for ($i = 0; $i < $testCount; $i++) {
            array_push($datos['orderNumbers'], ($i + 1));
        }
        $datos['lastNum'] = end($datos['orderNumbers']);

        return view('admin.testimonials.new', $datos);
    }

    public function store(Request $request) {
        $testimonial = new Testimonial;
        $testimonial->title =  $request->input('title');
        $testimonial->message =  $request->input('message');
        $testimonial->name =  $request->input('name');
        $testimonial->url =  $request->input('url');
        $testimonial->image = "";

        if ($request->has('visible')) {
            $testimonial->visible =  1;
        } else {
            $testimonial->visible =  0;
        }

        $fichero = $request->file('image');

        try {
            $testimonial->save();

            $newOrder =  $request->input('order');
            $testCount = Testimonial::count() + 1;

            if ($testCount != $newOrder) {
                $testimonials = Testimonial::where('order', '>=', $newOrder)
                                                ->get();

                foreach ($testimonials as $currentTestimonial) {
                    $currentTestimonial->order = $currentTestimonial->order + 1;
                    $currentTestimonial->save();
                }

                $testimonial->order =  $newOrder;
            }

            if($fichero) {
                $imagen_path = 'Testimonial_' . $testimonial->id . "." . $fichero->getClientOriginalExtension();

                Storage::disk('public')->putFileAs('testimonials/', $fichero, $imagen_path);
                $testimonial->image =  'storage/testimonials/' . $imagen_path;
            }

            $testimonial->save();

            $success = "Testimonial creado correctamente.";
            $request->session()->flash('success', $success);
        } catch (QueryException $e) {
            $error= Utilitat::errorMessage($e);
            $request->session()->flash('error', $error);

            return redirect()->action('TestimonialController@create')->withInput();
        }
        return redirect()->action('TestimonialController@index')->withInput();
    }

    public function show(Testimonial $testimonial) {
        //
    }

    public function edit(Testimonial $testimonial) {
        $datos['testimonial'] = $testimonial;
        $testCount = Testimonial::count();
        $datos['orderNumbers'] = [];

        for ($i = 0; $i < $testCount; $i++) {
            array_push($datos['orderNumbers'], ($i + 1));
        }
        $datos['original_image'] = "media/img/default_image.png";

        if ($testimonial->image != "") {
            $datos['original_image'] = $testimonial->image;
        }

        return view('admin.testimonials.update', $datos);
    }

    public function update(Request $request, Testimonial $testimonial) {
        $testimonial->title =  $request->input('title');
        $testimonial->message =  $request->input('message');
        $testimonial->name =  $request->input('name');
        $testimonial->url =  $request->input('url');
        $newOrder =  $request->input('order');

        if ($testimonial->order != $newOrder) {
            $testimonials = Testimonial::where('order', '>=', min($newOrder, $testimonial->order))
                                            ->where('order', '<=', max($newOrder, $testimonial->order))
                                            ->get();

            foreach ($testimonials as $currentTestimonial) {
                if (($currentTestimonial->order <= $newOrder) && ($currentTestimonial->order > $testimonial->order)) {
                    $currentTestimonial->order = $currentTestimonial->order - 1;
                } else if (($currentTestimonial->order >= $newOrder) && ($currentTestimonial->order < $testimonial->order)) {
                    $currentTestimonial->order = $currentTestimonial->order + 1;
                }

                $currentTestimonial->save();
            }

            $testimonial->order =  $newOrder;
        }


        if ($request->has('visible')) {
            $testimonial->visible =  1;
        } else {
            $testimonial->visible =  0;
        }

        $fichero = $request->file('image');

        try {
            if($fichero) {
                if( Storage::disk('public')->exists($testimonial->image)){
                    Storage::disk('public')->delete($testimonial->image);
                }

                $imagen_path = 'Testimonial_' . $testimonial->id . "." . $fichero->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('testimonials/', $fichero, $imagen_path);
                $testimonial->image =  'storage/testimonials/' . $imagen_path;
            }

            $testimonial->save();

            $success = "Testimonial editado correctamente.";
            $request->session()->flash('success', $success);
        } catch (QueryException $e) {
            $error= Utilitat::errorMessage($e);
            $request->session()->flash('error', $error);

            return redirect()->action('TestimonialController@edit', [$testimonial->id])->withInput();
        }
        return redirect()->action('TestimonialController@index')->withInput();
    }

    public function destroy(Testimonial $testimonial) {
        try {
            $testimonial->delete();
        } catch (QueryException $e) {
            $error = Utilitat::errorMessage($e);
            $request->session()->flash('error', $error);
        }
        return redirect()->action('TestimonialController@index');
    }
}
