<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

use App\Classes\Utilitat;
use Illuminate\Database\QueryException;

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
        // $testimonial->image =  $request->input('name'); -- Necesario
        $testimonial->image = "default";
        $testimonial->order =  $request->input('order');
        // $testimonial->visible =  $request->input('visible');

        try {
            $testimonial->save();

            $success = "Testimonial creado correctamente";
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

        return view('admin.testimonials.update', $datos);
    }

    public function update(Request $request, Testimonial $testimonial) {
        $testimonial->title =  $request->input('title');
        $testimonial->message =  $request->input('message');
        $testimonial->name =  $request->input('name');
        $testimonial->url =  $request->input('url');
        // $testimonial->image =  $request->input('name');
        $testimonial->order =  $request->input('order');
        // $testimonial->visible =  $request->input('visible');

        try {
            $testimonial->save();

            $success = "Testimonial editado correctamente";
            $request->session()->flash('success', $success);
        } catch (QueryException $e) {
            $error= Utilitat::errorMessage($e);
            $request->session()->flash('error', $error);

            return redirect()->action('TestimonialController@edit')->withInput();
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
