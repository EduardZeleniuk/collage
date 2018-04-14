@extends('layouts.app')

@section('title', 'Загрузка картинок')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2">
                <div class="side-bar">
                    {!! Form::open(array('route' => 'image.upload.post', 'id' => 'formImgUpload','files'=>true)) !!}
                    {!! Form::file('image', array('class' => 'form-control', 'multiple' => 'multiple', 'name' => 'images[]', 'id' => 'imgUpload')) !!}
                    <label for="imgUpload" class="btn btn-outline-success btn-block mb-1 fa fa-cloud-upload"> Загрузит фото</label>
                    <a href="{{ url('image-delete-all') }}" class="btn btn-outline-primary btn-block mb-3 fa fa-trash"> Очистить</a>

                    <button type="submit" class="btn-hidden">Upload</button>
                    {!! Form::close() !!}

                    <div class="sideBarImgWrap">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong>
                                <ul class="errorList">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if ($images)
                            @forelse($images as $image)
                                <div class="imgWrap">
                                    <button type="button" class="close" aria-label="Close">
                                        <a href="{{ url('image-delete/'.$image['id']) }}" class="fa fa-trash"></a>
                                    </button>
                                    <img class="imgSideBar" src="{{ url('storage/images/'. $image['image']) }}">
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-10">content</div>
        </div>
    </div>

@endsection