@extends('layouts.app')

@section('title', 'Collage')

@section('content')
    <div class="container-fluid bg-image">
        <div class="row">
            <div class="col-lg-2">
                @include('partials.siteBarImg')
            </div>
            <div class="col-lg-8">
                @include('partials.layoutCollage')
            </div>
            <div class="col-lg-2">
                @include('partials.siteBarCollage')
            </div>
        </div>
    </div>
@endsection