@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-6 mt-3">
            <a href="{{ url('/project/create') }}">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <i class="fas fa-code"></i>
                            </div>
                            <div class="col-9">
                                <h2 class="mt-md-3 display-4">{{ __('landing.add_project') }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-6 mt-3">
            <a href="{{ url('/blog/create') }}">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <i class="fas fa-rss"></i>
                            </div>
                            <div class="col-9">
                                <h2 class="mt-md-3 display-4">{{ __('landing.add_blog') }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-6 mt-3">
            <a href="{{ url('/tag/create') }}">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <i class="fas fa-tags"></i>
                            </div>
                            <div class="col-9">
                                <h2 class="mt-md-3 display-4">{{ __('landing.add_tag') }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-6 mt-3">
            <a href="{{ url('/stats') }}">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <i class="fas fa-chart-pie"></i>
                            </div>
                            <div class="col-9">
                                <h2 class="mt-md-3 display-4">{{ __('landing.stats') }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
